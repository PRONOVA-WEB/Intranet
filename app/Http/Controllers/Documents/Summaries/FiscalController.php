<?php

namespace App\Http\Controllers\Documents\Summaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

// use App\Models\Documents\Summaries\Summary;
// use App\Models\Documents\Summaries\SummaryEvent;
// use App\Models\Documents\Summaries\SummaryStatus;
use App\Models\Documents\Summaries\Fiscal;

class FiscalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $fiscals = Fiscal::all();

      return view('documents.summaries.fiscals.index',compact('fiscals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.summaries.fiscals.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Fiscal::where('user_id',$request->user_id)->count() > 0) {
          session()->flash('warning', 'El usuario ya se encuentra asignado como fiscal');
          return redirect()->route('documents.summaries.fiscals.index');
        }

        $fiscal = new Fiscal($request->All());
        $fiscal->save();

        session()->flash('success', 'El fiscal se ha asignado.');
        return redirect()->route('documents.summaries.fiscals.index');
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
    public function destroy(Fiscal $fiscal)
    {
        $fiscal->delete();
        session()->flash('success', 'El fiscal ha sido eliminado.');
        return redirect()->route('documents.summaries.fiscals.index');
    }
}
