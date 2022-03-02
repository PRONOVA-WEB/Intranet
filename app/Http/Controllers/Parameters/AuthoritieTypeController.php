<?php

namespace App\Http\Controllers\Parameters;

use App\Models\AuthoritieType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthoritieTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authoritiestypes = AuthoritieType::All();
        //dd ($authoritiestypes);
        return view('parameters/authoritiestypes/index',compact('authoritiestypes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parameters.authoritiestypes.create');
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
        $authoritietype = new AuthoritieType($request->All());
        $authoritietype->save();

        return redirect()->route('parameters.authoritiestypes.index');
    }
    //15/02/2022 vr agrego boton crear

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuthoritieType  $authoritietype
     * @return \Illuminate\Http\Response
     */
    public function show(AuthoritieType $authoritietype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuthoritieType  $authoritietype
     * @return \Illuminate\Http\Response
     */
    public function edit(AuthoritieType $authoritietype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AuthoritieType  $authoritietype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AuthoritieType $authoritietype)
    {
        $authoritietype->fill($request->all());
        $authoritietype->save();

        session()->flash('success', 'El nombre del Tipo de Autoridad ha sido cambiado a: '.$authoritietype->name);

        return redirect()->route('parameters.authoritiestypes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuthoritieType  $authoritietype
     * @return \Illuminate\Http\Response
     */

    //14/02/2022 vr agrego boton eliminar
    public function destroy($id)
    {
        $authoritietype = AuthoritieType::find($id);
        $authoritietype->delete();
        return redirect()->back()->with('success', 'Cargo eliminado');
    }
    //14/02/2022 vr agrego boton eliminar
}
