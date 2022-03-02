<?php

namespace App\Http\Controllers\Rrhh;

use App\Rrhh\Authority;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Rrhh\OrganizationalUnit;
use Illuminate\Support\Facades\Auth;
 //vr 25-02-2022 carga datos desde tabla positions
use App\Models\Position;

class AuthorityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ouTopLevels = OrganizationalUnit::with('childs.childs.childs.childs')->where('level', 1)->where('establishment_id', Auth::user()->organizationalUnit->establishment->id)->get();
        if($request->date) {
            $today = new \DateTime($request->date);
        }
        else {
            $today = new \DateTime();
        }

        $authorities = null;
        $calendar = array();
        if($request->ou) {
            $ou = OrganizationalUnit::Find($request->ou);

            $begin = (clone $today)->modify('-13 days')->modify('-'.$today->format('w').' days');
            //print_r($begin);

            $end   = (clone $today)->modify('+13 days')->modify('+'.(8-$today->format('w')).' days');
            //print_r($end);

            $authorities = Authority::with('user', 'creator')
                            ->where('from', '<=', $end)
                            ->where('to','>=', $begin)
                            ->where('organizational_unit_id',$request->ou)
                            ->latest('id')
                            ->get();
            //return $authorities;

            for($i = $begin; $i <= $end; $i->modify('+1 day')){
                $calendar[] = [
                    'date' => $i->format("Y-m-d"),
                    'manager' => Authority::getAuthorityFromDate($request->ou, $i->format("Y-m-d"),'manager'),
                    'delegate' => Authority::getAuthorityFromDate($request->ou, $i->format("Y-m-d"),'delegate'),
                    'secretary' => Authority::getAuthorityFromDate($request->ou, $i->format("Y-m-d"),'secretary')
                ];
                // $calendar[$i->format("Y-m-d")] = Authority::getAuthorityFromDate($request->ou, $i->format("Y-m-d"),'manager');
                // echo $i->format("Y-m-d"). '
                // ';
            }
        } else {
            $ou = false;
        }


        // print_r($calendar);
        // die();
        // $period = CarbonPeriod::create('2018-12-01', '2018-12-20');
        //
        // // Iterate over the period
        // foreach ($period as $date) {
        //     $calendar[$date->format('Y-m-d')] = Authority::getAuthorityFromDate($date->format('Y-m-d'),'manager');
        //     //echo $date->format('Y-m-d');
        // }

        // get the current time
        //$current = Carbon::now();

        //$begin = $current->subDays(7);
        //$end = $current->addDays(7);

        //for($i = $begin; $i <= $end; $i->addDays(1)){
            //$calendar[$i->format("Y-m-d")] = Authority::getAuthorityFromDate($i->format("Y-m-d"),'manager');
            //echo $i->format("Y-m-d");
        //}
        //echo date('Y-m-d', strtotime($date . ' -7 days'))
        //$todayDate = date("Y-m-d");
        //$calendar[$todayDate] = Authority::getAuthorityFromDate($todayDate,'manager');
        //die($ou);

        return view('rrhh.authorities.index',compact('authorities','ouTopLevels','calendar','today','ou'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //public function create($establishment_id)
    public function create(Request $request)
    {
        if($request->establishment_id)
        {
            //$users = User::orderBy('name')->orderBy('fathers_family')->get();
            $ous = OrganizationalUnit::All();
            //$ouTopLevel = OrganizationalUnit::Find(1);
            $ouTopLevel = OrganizationalUnit::where('level', 1)->where('establishment_id', $request->establishment_id)->first();

            //vr 25-02-2022 carga datos desde table
            //dd($ouTopLevel);
            $positions = Position::orderBy('name')->get();
            return view('rrhh.authorities.create', compact('ous','ouTopLevel','positions'))->withOu($request->ou_id);
            //vr 25-02-2022 carga datos desde table
        }
        else
        {
            session()->flash('warning', 'Debe seleccionar primero una unidad organizacional');
            return redirect()->route('rrhh.authorities.index');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'organizational_unit_id' => 'required',
                'user_id'                => 'required',
                'from'                   => 'required',
                'to'                     => 'required',
                'position'               => 'required',
                'type'                   => 'required',
            ],
            [
                'organizational_unit_id.required' => 'Seleccione una unidad organizacional',
                'user_id.required'                => 'Selccione un funcionario dentro de los usuarios del sistema',
                'from.required'                   => 'El campo fecha desde es requerido',
                'to.required'                     => 'El campo fecha hasta es requerido',
                'position.required'               => 'El campo cargo es requerido',
                'type.required'                   => 'El campo tipo es requerido',
            ]
        );
        $authority = new Authority($request->all());
        $authority->creator()->associate(Auth::user());
        $authority->save();

        session()->flash('info', 'La autoridad '.$authority->position.' ha sido creada.');

        return redirect()->route('rrhh.authorities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rrhh\Authority  $authority
     * @return \Illuminate\Http\Response
     */
    public function show(Authority $authority)
    {
        $authority = Authority::where('start','<=',$q)->where('end','>=',$q)->get()->last();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rrhh\Authority  $authority
     * @return \Illuminate\Http\Response
     */
    public function edit(Authority $authority)
    {
        switch($authority->organizationalUnit->level) {
            case 4: $ouTopLevel = $authority->organizationalUnit->father->father->father; break;
            case 3: $ouTopLevel = $authority->organizationalUnit->father->father; break;
            case 2: $ouTopLevel = $authority->organizationalUnit->father; break;
            case 1: $ouTopLevel = $authority->organizationalUnit; break;
        }

        return view('rrhh.authorities.edit', compact('ouTopLevel','authority'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rrhh\Authority  $authority
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Authority $authority)
    {
        $request->validate(
            [
                'organizational_unit_id' => 'required',
                'user_id'                => 'required',
                'from'                   => 'required',
                'to'                     => 'required',
                'position'               => 'required',
                'type'                   => 'required',
            ],
            [
                'organizational_unit_id.required' => 'Seleccione una unidad organizacional',
                'user_id.required'                => 'Selccione un funcionario dentro de los usuarios del sistema',
                'from.required'                   => 'El campo fecha desde es requerido',
                'to.required'                     => 'El campo fecha hasta es requerido',
                'position.required'               => 'El campo cargo es requerido',
                'type.required'                   => 'El campo tipo es requerido',
            ]
        );
        $authority->fill($request->all());
        $authority->save();
        session()->flash('success', 'La autoridad '.$authority->user->fullName.' ha sido actualizada.');
        return redirect()->route('rrhh.authorities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rrhh\Authority  $authority
     * @return \Illuminate\Http\Response
     */
    public function destroy(Authority $authority)
    {
        $authority->delete();
        session()->flash('success', 'La autoridad '.$authority->user->fullName.' ha sido eliminada');
        return redirect()->route('rrhh.authorities.index');
    }
}
