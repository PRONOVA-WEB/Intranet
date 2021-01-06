<?php

namespace App\Http\Controllers\Documents;

use App\Documents\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Mail\SendDocument;
use Illuminate\Support\Facades\Mail;
use App\Rrhh\OrganizationalUnit;
use App\User;
use App\Documents\Correlative;
//use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$users = User::Search($request->get('name'))->orderBy('name','Asc')->paginate(30);
        //$documents = Document::Search($request)->latest()->paginate(50);
        $childs = array(Auth()->user()->OrganizationalUnit->id);

        $childs = array_merge($childs, Auth()->user()->OrganizationalUnit->childs->pluck('id')->toArray());
        foreach(Auth()->user()->OrganizationalUnit->childs as $child) {
            $childs = array_merge($childs, $child->childs->pluck('id')->toArray());
        }

        $ownDocuments = Document::Search($request)->latest()
                    ->where('user_id', Auth()->user()->id)
                    //->whereIn('organizational_unit_id',$childs)
                    ->withTrashed()
                    ->paginate(100);

        $otherDocuments = Document::Search($request)->latest()
                    ->where('user_id', '<>', Auth()->user()->id)
                    ->where('type','<>','Reservado')
                    ->whereIn('organizational_unit_id',$childs)
                    ->withTrashed()
                    ->paginate(100);

        $users = User::orderBy('name')->orderBy('fathers_family')->withTrashed()->get();
        return view('documents.index', compact('ownDocuments','otherDocuments','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $document = new Document();
        return view('documents.create', compact('document'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $document = new Document($request->All());
        $document->user()->associate(Auth::user());
        $document->organizationalUnit()->associate(Auth::user()->organizationalUnit);
        /* Si no viene con número agrega uno desde el correlativo */
        if(!$request->number and $request->type != 'Ordinario') {
            $document->number = Correlative::getCorrelativeFromType($request->type);
        }
        $document->save();
        return redirect()->route('documents.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Documents\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        // $document->distribution =
        //
        // $phrase  = "You should eat fruits, vegetables, and fiber every day.";
        if($document->type == 'Acta de recepción') {
            return view('documents.reception')->withDocument($document);
        }
        else {
            return view('documents.show')->withDocument($document);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Documents\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        /* Si tiene número de parte entonces devuelve al index */
        if($document->file) {
            session()->flash('danger', 'Lo siento mi amor, el documento ya tiene un archivo adjunto');
            return redirect()->route('documents.index');
        }
        /* De lo contrario retornda para editar el documento */
        else {
            return view('documents.edit', compact('document'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Documents\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $document->fill($request->all());
        /* Si no viene con número agrega uno desde el correlativo */
        if(!$request->number and $request->type != 'Ordinario') {
            $document->number = Correlative::getCorrelativeFromType($request->type);
        }
        $document->save();

        session()->flash('info', 'El documento ha sido actualizado.
            <a href="'.route('documents.show', $document->id).'" target="_blank">
            Previsualizar</a>');

        return redirect()->route('documents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documents\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documents\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function deleteFile(Document $document)
    {
        Storage::delete($document->file);

        $document->file = null;
        $document->save();

        session()->flash('success', 'El archivo ha sido eliminado');
        return redirect()->route('documents.index');
    }

    public function addNumber()
    {
        return view('documents.add_number');
    }

    public function find(Request $request)
    {
        $document = Document::Find($request->id);
        return view('documents.add_number', compact('document'));
    }

    public function storeNumber(Request $request, Document $document)
    {
        $document->fill($request->all());
        if($request->hasFile('file')){
            $filename = $document->id . '-' .
                        $document->type . '_' .
                        $document->number . '.' .
                        $request->file->getClientOriginalExtension();
            $document->file = $request->file->storeAs('documentos',$filename);

        }
        $document->save();
        //unset($document->number);

        session()->flash('info', 'El documento ha sido actualizado.
            <a href="'.route('documents.show', $document->id).'" target="_blank">
            Previsualizar</a>');

        if($request->has('sendMail')) {
            /* Enviar a todos los email que aparecen en distribución */
            preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $document->distribution, $emails);
            //dd($emails[0]);
            Mail::to($emails[0])->send(new SendDocument($document));
        }

        return redirect()->route('documents.partes.outbox');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFromPrevious(Request $request)
    {
        $document = Document::findOrNew($request->document_id);
        $document->type = null;
        if( $document->user_id != Auth::id() ) {
            $document = new Document();
        }
        return view('documents.create', compact('document'));
    }

    public function download(Document $document)
    {
        $filename = $document->type . ' ' .
                    $document->number . '.' .
                    File::extension($document->file);
        //return Storage::download($document->file, $filename);
        return Storage::response($document->file, $filename);
    }

    public function report()
    {
        $users = User::orderBy('name')->has('documents')->with('documents')->get();
        $ct = Document::count();
        $ous = OrganizationalUnit::has('documents')->get();
        return view('documents.report', compact('users','ct','ous'));
    }

}
