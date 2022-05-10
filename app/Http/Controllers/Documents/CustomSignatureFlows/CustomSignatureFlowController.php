<?php

namespace App\Http\Controllers\Documents\CustomSignatureFlows;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Documents\CustomSignatureFlows\CustomSignatureFlow;
use App\Rrhh\OrganizationalUnit;

class CustomSignatureFlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customSignatureFlows = CustomSignatureFlow::all();//where('ou_id',Auth::user()->organizational_unit_id)->get();
        return view('parameters.custom_signature_flows.index', compact('customSignatureFlows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $organizationalUnit = OrganizationalUnit::all();
        return view('parameters.custom_signature_flows.create',compact('organizationalUnit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customSignatureFlow = new CustomSignatureFlow($request->All());
        // $customSignatureFlow->ou_id = Auth::user()->organizational_unit_id;
        $customSignatureFlow->creator_id = Auth::id();
        $customSignatureFlow->save();

        session()->flash('info', 'El flujo de firmas ha sido creado.');
        return redirect()->route('documents.custom_signature_flows.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomSignatureFlow $customSignatureFlow)
    {
        $organizationalUnit = OrganizationalUnit::all();
        return view('parameters.custom_signature_flows.edit', compact('organizationalUnit','customSignatureFlow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomSignatureFlow $customSignatureFlow)
    {
        $customSignatureFlow->fill($request->All());
        $customSignatureFlow->save();

        session()->flash('info', 'El flujo de firmas ha sido actualizado.');
        return redirect()->route('documents.custom_signature_flows.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomSignatureFlow $customSignatureFlow)
    {
        //
    }
}
