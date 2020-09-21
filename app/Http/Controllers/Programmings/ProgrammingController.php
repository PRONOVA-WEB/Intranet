<?php

namespace App\Http\Controllers\Programmings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Programmings\Programming;
use App\Establishment;
use App\Commune;

class ProgrammingController extends Controller
{
    public function index()
    {
        $programmings = Programming::All()->SortBy('name');
        return view('programmings/programmings/index')->withProgrammings($programmings);
    }

    public function create()
    {
        $establishments = Establishment::where('type','CESFAM')->OrderBy('name')->get();
        $communes = Commune::All()->SortBy('name');
        return view('programmings/programmings/create')->withEstablishments($establishments)->withCommunes($communes);
    }

    public function store(Request $request)
    {
        //dd($request->All());
        $programming = new Programming($request->All());
        $programming->year = date('Y', strtotime($request->date));
        $programming->description = $request->description;
        $programming->establishment_id = $request->establishment;
        $programming->user_id = '16966444';
       
        $programming->save();

        session()->flash('info', 'Se ha iniciado una nueva Programación Operativa');

        return redirect()->back();
    }
}
