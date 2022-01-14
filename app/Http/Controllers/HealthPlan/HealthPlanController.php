<?php

namespace App\Http\Controllers\HealthPlan;

use App\Models\Commune;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class HealthPlanController extends Controller
{
    public function index($comuna)
    {
        $comunnes = Commune::all();
        $files = Storage::allFiles('health_plan_files/'.$comuna);
        return view('health_plan.index', compact('files', 'comuna','comunnes'));
    }

    public function download($comuna ,$file)
    {
        $filename = '/health_plan_files/'.$comuna.'/'.$file;
        return Storage::download($filename, mb_convert_encoding($file,'ASCII'));
    }

}
