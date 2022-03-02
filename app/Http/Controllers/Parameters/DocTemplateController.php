<?php

namespace App\Http\Controllers\Parameters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\DocTemplate;

class DocTemplateController extends Controller
{
    public function index()
    {
        $docTemplates = DocTemplate::all();
        return view('parameters.doc_templates.index', compact('docTemplates'));
    }

    public function edit(DocTemplate $docTemplate)
    {
        return view('parameters.doc_templates.edit', compact('docTemplate'));
    }

    public function create()
    {
       return view('parameters.doc_templates.create');
    }

    public function store(Request $request)
    {
        $docTemplate = new DocTemplate($request->All());
        $docTemplate->save();

        return redirect()->route('parameters.documents_templates.index')->with('success','Plantilla de documento ' .$docTemplate->type. ' creada');
    }

    public function update(Request $request, DocTemplate $docTemplate)
    {
        $docTemplate->fill($request->all());
        $docTemplate->save();
        return redirect()->route('parameters.documents_templates.index')->with('success','Plantilla de documento ' .$docTemplate->type. ' actualizada');
    }

    public function destroy(DocTemplate $docTemplate)
    {
        $docTemplate->delete();
        return redirect()->route('parameters.documents_templates.index')->with('success','Plantilla de documento eliminada');
    }

}
