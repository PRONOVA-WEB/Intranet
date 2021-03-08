<?php

namespace App\Http\Controllers\Indicators;

use App\Http\Controllers\Controller;
use App\Indicators\HealthGoal;
use App\Indicators\Indicator;
use App\Indicators\Rem;
use App\Indicators\Value;
use Illuminate\Http\Request;

class HealthGoalController extends Controller
{
    public function index($law)
    {
        return view('indicators.health_goals.index', compact('law'));
    }

    public function list($law, $year)
    {
        $healthGoals = HealthGoal::where('law', $law)->where('year', $year)->orderBy('number')->get();
        return view('indicators.health_goals.list', compact('healthGoals', 'law', 'year'));
    }

    public function show($law, $year, $health_goal)
    {
        $healthGoal = HealthGoal::where('law', $law)->where('year', $year)->where('number', $health_goal)->first();
        // Nos aseguramos que la meta sanitaria existe segun ley, año y numero.
        if($healthGoal == null) abort(404);
        $healthGoal->indicators()->with('values')->orderBy('number')->get();
        $this->loadValuesWithRemSource($year, $healthGoal);
        // return $indicators;
        return view('indicators.health_goals.show', compact('healthGoal'));
    }

    private function loadValuesWithRemSource($year, $healthGoal)
    {
        foreach($healthGoal->indicators as $indicator){
            foreach(array('numerador', 'denominador') as $factor){
                $factor_cods = $factor == 'numerador' ? $indicator->numerator_cods : $indicator->denominator_cods;
                $factor_cols = $factor == 'numerador' ? $indicator->numerator_cols : $indicator->denominator_cols;

                if($factor_cods != null && $factor_cols != null){
                    //procesamos los datos necesarios para las consultas rem
                    $cods = array_map('trim', explode(',', $factor_cods));
                    $cols = array_map('trim', explode(',', $factor_cols));
                    $raws = null;
                    foreach($cols as $col)
                        $raws .= next($cols) ? 'SUM(COALESCE('.$col.', 0)) + ' : 'SUM(COALESCE('.$col.', 0))';
                    $raws .= ' AS valor, Mes';

                    //Es rem P la consulta?
                    $isRemP = Rem::year($year-1)->select('Mes')
                                ->when($healthGoal->name == 'Hospital Dr. Ernesto Torres Galdames', function($query){
                                    return $query->whereHas('establecimiento',function($q){
                                        return $q->where('meta_san_18834_hosp', 1);
                                    });
                                })
                                ->when($healthGoal->name == 'Consultorio General Urbano Dr. Héctor Reyno Gutiérrez', function($query){
                                    return $query->where('IdEstablecimiento', 102307);
                                })
                                ->whereIn('CodigoPrestacion', $cods)->groupBy('Mes')->get()->count() == 2;
                    
                    if($isRemP){
                        $acum_last_year = Rem::year($year-1)
                        ->when($healthGoal->name == 'Hospital Dr. Ernesto Torres Galdames', function($query){
                            return $query->whereHas('establecimiento', function($q){
                            return $q->where('meta_san_18834_hosp', 1);
                            });
                        })
                        ->when($healthGoal->name == 'Consultorio General Urbano Dr. Héctor Reyno Gutiérrez', function($query){
                            return $query->where('IdEstablecimiento', 102307);
                        })
                        ->where('Mes', 12)->whereIn('CodigoPrestacion', $cods)->sum(reset($cols));

                        $factor == 'numerador' ? $indicator->numerator_acum_last_year = $acum_last_year : $indicator->denominator_acum_last_year = $acum_last_year;
                    }
    
                    $result = Rem::year($year)->selectRaw($raws)
                                ->when($healthGoal->name == 'Hospital Dr. Ernesto Torres Galdames', function($query){
                                    return $query->whereHas('establecimiento', function($q){
                                        return $q->where('meta_san_18834_hosp', 1);
                                    });
                                })
                                ->when($healthGoal->name == 'Consultorio General Urbano Dr. Héctor Reyno Gutiérrez', function($query){
                                    return $query->where('IdEstablecimiento', 102307);
                                })
                                ->when($isRemP, function($query){
                                    return $query->whereIn('Mes', [6,12]);
                                })
                                ->whereIn('CodigoPrestacion', $cods)->groupBy('Mes')->orderBy('Mes')->get();
    
                    foreach($result as $item)
                        $indicator->values->add(new Value(['month' => $item->Mes, 'factor' => $factor, 'value' => $item->valor]));
                }
            }
        }
    }

    public function editInd($law, $year, $health_goal, Indicator $indicator)
    {
        $indicator->load('values');
        // return $indicator;
        return view('indicators.health_goals.ind.edit', compact('indicator'))->with(['healthGoal' => $indicator->indicatorable]);
    }

    public function updateInd($law, $year, $health_goal, Indicator $indicator, Request $request)
    {
        // return $request;
        $indicator->number = $request->get('number');
        $indicator->name = $request->get('name');
        $indicator->goal = $request->get('goal');
        $indicator->weighting = $request->get('weighting');
        $indicator->numerator = $request->get('numerator');
        $indicator->numerator_source = $request->get('numerator_source');
        $indicator->numerator_cods = $request->has('numerator_cods') ? $request->get('numerator_cods') : null;
        $indicator->numerator_cols = $request->has('numerator_cols') ? $request->get('numerator_cols') : null;
        $indicator->denominator = $request->get('denominator');
        $indicator->denominator_source = $request->get('denominator_source');
        $indicator->denominator_cods = $request->has('denominator_cods') ? $request->get('denominator_cods') : null;
        $indicator->denominator_cols = $request->has('denominator_cols') ? $request->get('denominator_cols') : null;
        $indicator->save();

        // si existe previamente valores y cambiamos a fuente de datos REM, nos aseguramos de borrarlos.
        if($request->has('numerator_cods')) $indicator->values()->where('factor', 'numerador')->delete();
        if($request->has('denominator_cods')) $indicator->values()->where('factor', 'denominador')->delete();

        if($request->has('numerator_month')){
            foreach($request->get('numerator_month') as $index => $value)
                if($value != null)
                    $indicator->values()->updateOrCreate(
                        ['factor' => 'numerador', 'month' => $index + 1], 
                        ['value' => $value]
                    );
                else
                    $indicator->values()->where('factor', 'numerador')->where('month', $index + 1)->delete();
        }

        if($request->has('denominator_month')){
            foreach($request->get('denominator_month') as $index => $value)
                if($value != null)
                    $indicator->values()->updateOrCreate(
                        ['factor' => 'denominador', 'month' => $index + 1], 
                        ['value' => $value]
                    );
                else
                $indicator->values()->where('factor', 'denominador')->where('month', $index + 1)->delete();
        }

        //Regresamos a los indicadores con sus respectivos valores. Es lo mismo que hay en el método show salvo por el mensaje de confirmación.
        $healthGoal = $indicator->indicatorable;
        $indicators = $healthGoal->indicators()->with('values')->orderBy('number')->get();
        $this->loadValuesWithRemSource($year, $healthGoal, $indicators);

        return view('indicators.health_goals.show', compact('indicators', 'healthGoal'))->with('success', 'Registros actualizados satisfactoriamente');
    }
}