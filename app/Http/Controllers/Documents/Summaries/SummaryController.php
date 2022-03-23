<?php

namespace App\Http\Controllers\Documents\Summaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Documents\Summaries\Summary;
use App\Models\Documents\Summaries\SummaryEvent;
use App\Models\Documents\Summaries\SummaryStatus;
use App\Models\Documents\Summaries\Fiscal;

class SummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $summaries = Summary::all();

          $open_summaries = Summary::whereHas("events", function ($subQuery) {
                                      $subQuery->latest()->where('status_id','!=', 6);
                                    })->get();

          $closed_summaries = Summary::whereHas("events", function ($subQuery) {
                                      $subQuery->latest()->where('status_id','==', 6);
                                    })->get();

          return view('documents.summaries.index',compact('open_summaries','closed_summaries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fiscals = Fiscal::all();
        return view('documents.summaries.create',compact('fiscals'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $summary = new Summary($request->All());
      $summary->creator_id =  Auth::user()->id;
      $summary->summary_date = Carbon::now();
      $summary->save();

      //obtiene estado Apertua
      $summaryStatus = SummaryStatus::find(1);

      $summaryEvent = new SummaryEvent();
      $summaryEvent->summary_id = $summary->id;
      $summaryEvent->status_id = $summaryStatus->id; //apertura
      $summaryEvent->granted_days = $summaryStatus->granted_days;
      $summaryEvent->creator_id =  Auth::user()->id;
      $summaryEvent->event_date = Carbon::now();
      $summaryEvent->save();

      session()->flash('success', 'El sumario ha sido creado.');
      return redirect()->route('documents.summaries.index');
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
    public function edit(Summary $summary)
    {
        $fiscals = Fiscal::all();
        return view('documents.summaries.edit',compact('summary','fiscals'));
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
    public function destroy($id)
    {
        //
    }
}
