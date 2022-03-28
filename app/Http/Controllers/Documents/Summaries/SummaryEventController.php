<?php

namespace App\Http\Controllers\Documents\Summaries;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Documents\Summaries\Summary;
use App\Models\Documents\Summaries\SummaryEvent;
use App\Models\Documents\Summaries\SummaryStatus;
use App\Models\Documents\Summaries\SummaryFile;
use App\Models\Documents\Summaries\Fiscal;

class SummaryEventController extends Controller
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
    public function create(Summary $summary)
    {
        $summaryStatus = SummaryStatus::where('id','!=',1)->get();
        return view('documents.summaries.events.create',compact('summary','summaryStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Summary $summary, Request $request)
    {
        $summaryEvent = new SummaryEvent($request->All());
        $summaryEvent->creator_id =  Auth::user()->id;
        $summaryEvent->event_date = Carbon::now();
        $summaryEvent->summary_id = $summary->id;
        $summaryEvent->save();

        //Registrar archivos en attached_files
        $now = Carbon::now()->format('Y_m_d_H_i_s');
        $files = ['resol_file' => 'Archivo de resolución'
                  // 'resol_adjudication_deserted_file' => 'Resolución de adjudicación/desierta',
                  // 'resol_contract_file' => 'Resolución de contrato',
                  // 'guarantee_ticket_file' => 'Boleta de garantía',
                  // 'taking_of_reason_file' => 'Resolución toma de razón'
                ];

        foreach($files as $key => $file){
            if($request->hasFile($key)){
                $archivo = $request->file($key);
                $file_name = $now.'_'.$key;
                $attachedFile = new SummaryFile();
                $attachedFile->file = $archivo->storeAs('/ionline/request_forms/attached_files', $file_name.'.'.$archivo->extension(), 'gcs');
                $attachedFile->document_type = $file;
                $attachedFile->summary_event_id = $summaryEvent->id;
                $attachedFile->save();
            }
        }

        $fiscals = Fiscal::all();

        session()->flash('success', 'El evento ha sido creado.');
        return view('documents.summaries.edit',compact('summary','fiscals'));

    }

    public function download(SummaryEvent $event)
    {
        return Storage::disk('gcs')->response($event->files->first()->file, $event->files->first()->document_type);
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
    public function destroy($id)
    {
        //
    }
}
