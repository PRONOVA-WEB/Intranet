<?php

namespace App\Http\Controllers\Documents;

use App\Documents\Document;
use App\Documents\Parte;
use App\Documents\ParteEvent;
use App\Documents\ParteFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Rrhh\OrganizationalUnit;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ParteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $partes = Parte::Search($request)
            ->with(['requirements','files','requirements.events','requirements.events.to_user'])
            ->latest()->paginate('100');
        //$d->events()->doesntHave('father')->get()
        // $partes = Parte::whereHas('events', function ($query) {
        //     $query->where('active', 1)
        //           ->where('user_id', Auth::id());
        // })->get();
        return view('documents.partes.index', compact('partes', 'request'));
    }

    public function outbox(Request $request)
    {
        $documents = Document::Search($request)
                             //->where('type',['Ordinario','Circular'])
                             ->latest()
                             ->paginate('100');
        $users = User::orderBy('name')->orderBy('fathers_family')->get();
        return view('documents.partes.outbox', compact('documents','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = date("Y-m-j\T00:00:00");
        return view('documents.partes.create', compact('today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "entered_at" => "required",
            "date" => "required",
            "type" => "required",
            "origin" => "required",
            "subject" => "required",
            "forfile.*"  => "required|max:5000|mimes:pdf,png,jpg,doc,docx,xls,xlsx"
        ],
        [
            'forfile.*.mimes' => 'El archivo a cargar debe ser tipo: pdf, png, jpg, doc, docx, xls, xlsx.',
            'forfile.*.size'  => 'El archivo a cargar no debe exeder los 5 MB',
            'entered_at.required'  => 'el campo fecha de ingreso es obligatorio',
            'date.required'  => 'el campo fecha de ingreso es obligatorio',
            'type.required'  => 'el campo tipo de ingreso es obligatorio',
            'origin.required'  => 'el campo origin de ingreso es obligatorio',
            'subject.required'  => 'el campo asunto de ingreso es obligatorio',
        ]);

        if ($validator->fails()) {
            return redirect()->route('documents.partes.create')
                    ->withErrors($validator);
        }

        $parte = new Parte($request->All());
        //dd($parte);
        $parte->save();

        //dd($parte);

        $evento = new ParteEvent();
        $evento->user()->associate(Auth::user());
        $evento->organizationalUnit()->associate(Auth::user()->organizationalUnit);

        if($request->hasFile('forfile')){
            foreach($request->file('forfile') as $file) {
                $filename = $file->getClientOriginalName();
                $fileModel = New ParteFile;
                $fileModel->file = $file->store('documents/partes',['disk' => 'gcs']);
                $fileModel->name = $filename;
                $fileModel->parte_id = $parte->id;
                $fileModel->save();
            }
        }

        $parte->events()->save($evento);

        session()->flash('info', 'El documento ha sido ingresado.');
        return redirect()->route('documents.partes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Documents\Parte  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Parte $parte)
    {
        $files = ParteFile::where('parte_id',$parte->id)->get();
        $ous = OrganizationalUnit::all()->sortBy('name');
        $organizationalUnit = OrganizationalUnit::Find(1);
        //$leafs = $parte->events()->doesntHave('childs')->get();
        return view('documents.partes.show', compact('parte','leafs','ous','organizationalUnit','files'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documents\Parte  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Parte $parte)
    {
        return view('documents.partes.edit', compact('parte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documents\Parte  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parte $parte)
    {
        $validator = Validator::make($request->all(), [
            "entered_at" => "required",
            "date" => "required",
            "type" => "required",
            "origin" => "required",
            "subject" => "required",
            "forfile.*" => "max:5000|mimes:pdf,png,jpg,doc,docx,xls,xlsx"
        ],
        [
            'forfile.*.mimes' => 'El archivo a cargar debe ser tipo: pdf, png, jpg, doc, docx, xls, xlsx.',
            'forfile.*.size'  => 'El archivo a cargar no debe exeder los 5 MB',
            'entered_at.required'  => 'el campo fecha de ingreso es obligatorio',
            'date.required'  => 'el campo fecha de ingreso es obligatorio',
            'type.required'  => 'el campo tipo es obligatorio',
            'origin.required'  => 'el campo origin es obligatorio',
            'subject.required'  => 'el campo asunto es obligatorio',
        ]);

        if ($validator->fails()) {
            return redirect()->route('documents.partes.edit', $parte->id)
                ->withErrors($validator);
        }

        $parte->fill($request->All());

        $parte->save();

        if($request->hasFile('forfile')){
            foreach($request->file('forfile') as $file) {
                $filename = $file->getClientOriginalName();
                $fileModel = New ParteFile;
                $fileModel->file = $file->store('documents/partes',['disk'=>'gcs']);
                $fileModel->name = $filename;
                $fileModel->parte_id = $parte->id;
                $fileModel->save();
            }
        }

        session()->flash('info', 'El documento ha sido actualizado.');
        return redirect()->route('documents.partes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documents\Parte  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parte $parte)
    {
        foreach($parte->events as $event) {
            $event->forceDelete();
        }
        foreach($parte->files as $file) {
            Storage::disk('gcs')->delete($file->file);
            //$file->delete();
            $file->forceDelete();
        }

        $parte->forceDelete();
        return redirect()->route('documents.partes.index');
    }

    public function inbox()
    {
        return view('documents.partes.inbox');
    }

    public function view(Parte $parte)
    {
        $parte->viewed_at = Carbon::now()->toDateTimeString();
        $parte->save();
        return back();
    }

    public function admin()
    {
        $ous = OrganizationalUnit::all()->sortBy('name');
        return view('documents.partes.admin')->withOus($ous);
    }

    public function download(ParteFile $file)
    {
        
        if(Storage::disk('gcs')->exists($file->file))
        {
            return Storage::disk('gcs')->response($file->file, mb_convert_encoding($file->name,'ASCII'));
        }
        else
        {
            logger('No se encontró el archivo '.$file->file);
            session()->flash('danger', 'No se encontró el archivo '.$file->file);
            return redirect()->route('documents.partes.index');
        }
    }
}
