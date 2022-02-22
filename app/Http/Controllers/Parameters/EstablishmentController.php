<?php

namespace App\Http\Controllers\Parameters;

use App\Establishment;
use App\Models\Commune;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstablishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $establishments = Establishment::All();
        return view('parameters/establishments/index')->withEstablishments($establishments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $communes = Commune::All();
        return view('parameters.establishments.create', compact('communes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //17/02/2022 vr agrego boton crear
    public function store(Request $request)
    {
        //dd ($request);
        $establishment = new Establishment($request->All());
        $establishment->save();

        session()->flash('info', 'El lugar '.$establishment->name.' ha sido creado.');

        return redirect()->route('parameters.establishments.index');
    }
    //17/02/2022 vr agrego boton crear

    /**
     * Display the specified resource.
     *
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function show(Establishment $establishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function edit(Establishment $establishment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Establishment $establishment)
    {
      $establishment->fill($request->all());
      $establishment->save();

      session()->flash('info', 'El establecimiento '.$establishment->name.' ha sido editado.');
      return redirect()->route('parameters.establishments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Establishment  $establishment
     * @return \Illuminate\Http\Response
     */

    //14/02/2022 vr agrego boton eliminar
    public function destroy($id)
    {
        $establishment = Establishment::find($id);
        $establishment->delete();
        return redirect()->back()->with('success', 'Establecimiento eliminado');
    }
    //14/02/2022 vr agrego boton eliminar

    // public function destroy(Establishment $establishment)
    // {
    //     //
    // }
}
