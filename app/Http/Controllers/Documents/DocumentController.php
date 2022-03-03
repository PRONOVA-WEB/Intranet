<?php

namespace App\Http\Controllers\Documents;

use App\Documents\Document;
use App\Models\Documents\Signature;
use App\Models\Documents\SignaturesFile;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
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
use App\Models\Parameters\DocTemplate;
use Illuminate\Support\Facades\Validator;

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
        if (Auth()->user()->OrganizationalUnit) {
            $childs = array(Auth()->user()->OrganizationalUnit->id);

            $childs = array_merge($childs, Auth()->user()->OrganizationalUnit->childs->pluck('id')->toArray());
            foreach (Auth()->user()->OrganizationalUnit->childs as $child) {
                $childs = array_merge($childs, $child->childs->pluck('id')->toArray());
            }

            $ownDocuments = Document::Search($request)->latest()
                ->where('user_id', Auth()->user()->id)
                ->paginate(100);

            $otherDocuments = Document::Search($request)->latest()
                ->where('user_id', '<>', Auth()->user()->id)
                ->where('private', true)
                ->whereIn('organizational_unit_id', $childs)
                ->paginate(100);

            $users = User::orderBy('name')->orderBy('fathers_family')->withTrashed()->get();
            $docTemplates = DocTemplate::orderBy('type','asc')->get();
            return view('documents.index', compact('ownDocuments', 'otherDocuments', 'users','docTemplates'));
        }
        else {
            return redirect()->back()->with('danger', 'Usted no posee asignada una unidad organizacional favor contactar a su administrador');
        }
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
        $request->validate(
            [
                'subject'           => 'required',
                'from'              => 'required',
                'for'               => 'required',
                'greater_hierarchy' => 'required',
                'content'           => 'required',
                'doc_templates_id'  => 'required'
            ],
            [
                'doc_templates_id.required'     => 'el campo tipo es obligatorio',
                'subject.required'  => 'el campo materia es obligatorio',
                'from.required'     => 'el campo De es obligatorio',
                'for.required'      => 'el campo Para es obligatorio',
                'content.required'  => 'el campo Contenido es obligatorio',
            ]
        );

        $document = new Document($request->All());
        $document->user()->associate(Auth::user());
        $document->organizationalUnit()->associate(Auth::user()->organizationalUnit);
        $document->save();

        /* Agrega uno desde el correlativo */
        if (is_null($request->number)) {
            $document->number = DocTemplate::find($request->doc_templates_id)->prefix.ceros($document->id);
            $document->save();

        }

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
        if ($document->type == 'Acta de recepción') {
            return view('documents.reception')->withDocument($document);
        } else if ($document->type == 'Resolución') {
            return view('documents.resolution')->withDocument($document);
        } else if ($document->type == 'Circular') {
            //centrada la materia en negrita y sin de para
            return view('documents.circular')->withDocument($document);
        } else {
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
        if ($document->file) {
            session()->flash('danger', 'Lo siento, el documento ya tiene un archivo adjunto');
            return redirect()->route('documents.index');
        }
        /* De lo contrario retorna para editar el documento */ else {
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
        $request->validate(
            [
                'doc_templates_id'              => 'required',
                'subject'           => 'required',
                'from'              => 'required',
                'for'               => 'required',
                'greater_hierarchy' => 'required',
                'content'           => 'required'
            ],
            [
                'doc_templates_id.required'     => 'el campo tipo es obligatorio',
                'subject.required'  => 'el campo materia es obligatorio',
                'from.required'     => 'el campo De es obligatorio',
                'for.required'      => 'el campo Para es obligatorio',
                'content.required'  => 'el campo Contenido es obligatorio',
            ]
        );
        $document->fill($request->all());
        /* Agrega uno desde el correlativo */
        if (!$request->number) {
            if (
                $request->type == 'Memo' or
                $request->type == 'Acta de recepción' or
                $request->type == 'Circular'
            ) {

                $document->number = Correlative::getCorrelativeFromType($request->type);
            }
        }
        /* Si no viene con número agrega uno desde el correlativo */
        //if(!$request->number and $request->type != 'Ordinario') {
        //    $document->number = Correlative::getCorrelativeFromType($request->type);
        //}
        $document->save();

        session()->flash('info', 'El documento ha sido actualizado.
            <a href="' . route('documents.show', $document->id) . '" target="_blank">
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
        $document->delete();
        return redirect()->route('documents.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Documents\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function deleteFile(Document $document)
    {
        Storage::disk('gcs')->delete($document->file);

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
        $validator = Validator::make($request->all(), [
            "file" => "required|max:5000|mimes:pdf"
        ],
        [
            'file.mimes' => 'El archivo a cargar debe ser tipo .PDF',
            'file.size'  => 'El archivo a cargar no debe exeder los 5 MB',
        ]);

        if ($validator->fails()) {
            return redirect()->route('documents.index')
                    //->with(['document',$document->id])
                    ->withErrors($validator)
                    ->withInput();
        }

        $document->fill($request->all());
        if ($request->hasFile('file')) {
            $filename = $document->id . '-' .
                $document->type . '_' .
                $document->number . '.' .
                $request->file->getClientOriginalExtension();
            $document->file = $request->file->storeAs('/documents/documents', $filename, ['disk' => 'gcs']);
        }
        $document->save();
        //unset($document->number);

        session()->flash('info', 'El documento ha sido actualizado.
            <a href="' . route('documents.show', $document->id) . '" target="_blank">
            Previsualizar</a>');

        if ($request->has('sendMail')) {
            if(!empty($document->distribution))
            {
                 /* Enviar a todos los email que aparecen en distribución */
                preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $document->distribution, $emails);
                Mail::to($emails[0])->send(new SendDocument($document));
            }
        }

        return redirect()->route('documents.index');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createFromPrevious(Request $request)
    {
        $document = Document::findOrNew($request->document_id);
        if ($document->user_id != Auth::id()) {
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
        return Storage::disk('gcs')->response($document->file, $filename);
    }

    public function report()
    {
        $users = User::orderBy('name')->has('documents')->with('documents')->get();
        $ct = Document::count();
        $ous = OrganizationalUnit::has('documents')->get();
        return view('documents.report', compact('users', 'ct', 'ous'));
    }

    public function sendForSignature(Document $document)
    {
        $signature = new Signature();
        $signature->request_date = Carbon::now();
        $signature->subject = $document->subject;
        $signature->description = $document->antecedent;
        $signature->recipients = $document->distribution;

        $signature->document_type = $document->template->type;

        $documentFile = \PDF::loadView('documents.show', compact('document'));

        $signaturesFile = new SignaturesFile();
        $signaturesFile->file = base64_encode($documentFile->output());
        $signaturesFile->file_type = 'documento';
        $signaturesFile->md5_file = md5($documentFile->output());

        $signature->signaturesFiles->add($signaturesFile);

        return view('documents.signatures.create', compact('signature', 'document'));
    }

    public function signedDocumentPdf($id)
    {
        $document = Document::find($id);
        return Storage::disk('gcs')->response($document->fileToSign->signed_file);
    }
}
