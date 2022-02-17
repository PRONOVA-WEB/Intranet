<?php

namespace App\Http\Controllers\Parameters;

use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communes = Commune::All();
        return view('parameters/communes/index')->withCommunes($communes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parameters.communes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //15/02/2022 vr agrego boton crear
     public function store(Request $request)
    {
        $commune = new Commune($request->All());
        $commune->save();

        return redirect()->route('parameters.communes.index');
    }
    //15/02/2022 vr agrego boton crear

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function show(Commune $commune)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function edit(Commune $commune)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commune $commune)
    {
        $commune->fill($request->all());
        $commune->save();

        session()->flash('success', 'El nombre de la comuna ha sido cambiado a: '.$commune->name);

        return redirect()->route('parameters.communes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */

    //14/02/2022 vr agrego boton eliminar
    public function destroy($id)
    {
        $commune = Commune::find($id);
        $commune->delete();
        return redirect()->back()->with('success', 'Comuna eliminada');
    }
    //14/02/2022 vr agrego boton eliminar
}
