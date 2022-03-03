<?php

namespace App\Http\Controllers\Parameters;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::All();
        return view('parameters/positions/index',compact('positions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('parameters.positions.create');
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
        $position = new Position($request->All());
        $position->save();

        return redirect()->route('parameters.positions.index');
    }
    //15/02/2022 vr agrego boton crear

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $position->fill($request->all());
        $position->save();

        session()->flash('success', 'El nombre del cargo ha sido cambiado a: '.$position->name);

        return redirect()->route('parameters.positions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */

    //14/02/2022 vr agrego boton eliminar
    public function destroy($id)
    {
        $position = Position::find($id);
        $position->delete();
        return redirect()->back()->with('success', 'Cargo eliminado');
    }
    //14/02/2022 vr agrego boton eliminar
}
