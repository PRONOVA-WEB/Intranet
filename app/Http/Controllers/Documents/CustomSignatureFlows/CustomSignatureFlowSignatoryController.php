<?php

namespace App\Http\Controllers\Documents\CustomSignatureFlows;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Documents\CustomSignatureFlows\CustomSignatureFlow;
use App\Models\Documents\CustomSignatureFlows\CustomSignatureFlowSignatory;

class CustomSignatureFlowSignatoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CustomSignatureFlow $customSignatureFlow)
    {
        return view('parameters.custom_signature_flows.signatories.create',compact('customSignatureFlow'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $customSignatureFlow = CustomSignatureFlow::find($request->doc_custom_signature_flow_id);

        // if($customSignatureFlow->signatories->where('order',$request->order)->count() > 0){
        //     session()->flash('warning', 'Ya existe un firmante con esa posición de firma.');
        //     return redirect()->route('documents.custom_signature_flows.edit', $customSignatureFlow);
        // }

        if($customSignatureFlow->signatories->where('signator_id',$request->signator_id)->count() > 0){
            session()->flash('warning', 'Ya existe el usuario como firmante.');
            return redirect()->route('documents.custom_signature_flows.edit', $customSignatureFlow);
        }

        $customSignatureFlowSignatory = new CustomSignatureFlowSignatory($request->All());
        if($customSignatureFlow->signatories->count() == 0){
            $customSignatureFlowSignatory->order = 1;
        }else{
            $customSignatureFlowSignatory->order = $customSignatureFlow->signatories->last()->order + 1;
        }
        $customSignatureFlowSignatory->save();

        session()->flash('success', 'El firmante ha sido agregado.');
        return redirect()->route('documents.custom_signature_flows.edit', $customSignatureFlow);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomSignatureFlowSignatory $customSignatureFlowSignatory)
    {
        $customSignatureFlow = $customSignatureFlowSignatory->custom_signature_flow;

        $flag = 0;
        foreach($customSignatureFlow->signatories->sortBy('order') as $signatory){
            if($signatory->order == $customSignatureFlowSignatory->order){
                $flag = 1;
            }
            if($flag == 1){
                $signatory->order = $signatory->order - 1;
                $signatory->save();
            }
        }
        $customSignatureFlowSignatory->delete();
        
        session()->flash('success', 'El firmante ha sido eliminado.');
        return redirect()->route('documents.custom_signature_flows.edit', $customSignatureFlow);
    }

    public function move_up(CustomSignatureFlowSignatory $customSignatureFlowSignatory){
        $customSignatureFlow = $customSignatureFlowSignatory->custom_signature_flow;

        $previous_id_customSignatureFlowSignatory = $customSignatureFlow->signatories->where('order','<', $customSignatureFlowSignatory->order)->max('id');
                                                
        $previous_customSignatureFlowSignatory = CustomSignatureFlowSignatory::find($previous_id_customSignatureFlowSignatory);
        $previous_customSignatureFlowSignatory->order = $previous_customSignatureFlowSignatory->order + 1;
        $previous_customSignatureFlowSignatory->save();
        
        $customSignatureFlowSignatory->order = $customSignatureFlowSignatory->order - 1;
        $customSignatureFlowSignatory->save();

        

        session()->flash('success', 'Se ha modificado el orden de los firmantes.');
        return redirect()->route('documents.custom_signature_flows.edit', $customSignatureFlow);
    }

    public function move_down(CustomSignatureFlowSignatory $customSignatureFlowSignatory){
        $customSignatureFlow = $customSignatureFlowSignatory->custom_signature_flow;
        $next_id_customSignatureFlowSignatory = $customSignatureFlow->signatories->where('order','>', $customSignatureFlowSignatory->order)->min('id');
        $next_customSignatureFlowSignatory = CustomSignatureFlowSignatory::find($next_id_customSignatureFlowSignatory);
        $next_customSignatureFlowSignatory->order = $next_customSignatureFlowSignatory->order - 1;
        $next_customSignatureFlowSignatory->save();
        
        $customSignatureFlowSignatory->order = $customSignatureFlowSignatory->order + 1;
        $customSignatureFlowSignatory->save();

        session()->flash('success', 'Se ha modificado el orden de los firmantes.');
        return redirect()->route('documents.custom_signature_flows.edit', $customSignatureFlow);
    }
}
