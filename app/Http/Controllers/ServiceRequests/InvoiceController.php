<?php

namespace App\Http\Controllers\ServiceRequests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rrhh\UserBankAccount;
use Illuminate\Support\Facades\Http;
use App\Models\ServiceRequests\ServiceRequest;
use App\Models\ServiceRequests\Fulfillment;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    //

    public function welcome()
    {
        if (Auth::guard('external')->check())
        {
            return $this->show(Auth::guard('external')->user()->id);
        }
        return view('service_requests.invoice.welcome');
    }

    // public function login($access_token = null)
    // {
    //     if ($access_token) {

    //         if (env('APP_ENV') == 'production' OR env('APP_ENV') == 'testing') {
    //             $url_base = "https://www.claveunica.gob.cl/openid/userinfo/";
    //             $response = Http::withToken($access_token)->post($url_base);

    //             if($response->getStatusCode() == 200) {
    //                 $user_cu = json_decode($response);
    //                 $user_id = $user_cu->RolUnico->numero;
    //             }
    //             else {
    //                 return redirect()->route('invoice.welcome');
    //             }

    //         } else if (env('APP_ENV') == 'local') {
    //             $user_id = $access_token;
    //         }
    //         return $this->show($user_id);
    //     }
    // }

    public function login(Request $request)
    {
        $errors = new MessageBag;
        $credentials = $request->only('id', 'password');
        $credentials['id'] = str_replace('.','',$credentials['id']);
        $credentials['id'] = str_replace('-','',$credentials['id']);
        $credentials['id'] = substr($credentials['id'], 0, -1);

        if (Auth::guard('external')->attempt($credentials, $request->filled('remember'))) {
            // Authentication passed...
            return $this->show(Auth::guard('external')->user()->id);
        }
        $errors = new MessageBag(['id' => ['Estas credenciales no coinciden con nuestros registros..']]); // if Auth::attempt fails (wrong credentials) create a new message bag instance.

        return back()->withErrors($errors)->withInput($request->only('id', 'remember'));
    }


    public function show($user_id)
    {
        //$serviceRequests = ServiceRequest::where('user_id',$user_id)->get();

        //$fulfillment = Fulfillment::whereHas('ServiceRequest', function($query, use $user_id) { $query->where('user_id',$user_id);})->orderBy('payment_date')->get();

        $fulfillments = Fulfillment::whereHas('ServiceRequest', function($query) use ($user_id) {
            $query->where('user_id',$user_id);}
            )->orderBy('year', 'DESC')->orderBy('month', 'DESC')->get();

        $bankaccount = UserBankAccount::where('user_id',$user_id)->get();

        $user = User::find($user_id);

        if(!$user)  logger("Invocie Login: No existe el usuario en la bd ", ['user_id' => $user_id]);

        return view('service_requests.invoice.show', compact('fulfillments','bankaccount','user'));
    }

    public function downloadInvoice(Fulfillment $fulfillment)
    {
        $storage_path = 'service_request/invoices/';
        $file =  $storage_path . $fulfillment->id . '.pdf';

        if (Storage::disk('gcs')->exists($file)) {
            return Storage::disk('gcs')->response($file, mb_convert_encoding($fulfillment->id . '.pdf', 'ASCII'));
        } else {
            session()->flash('warning', 'No se ha encontrado el archivo. Intente nuevamente en 10 minutos, si el problema persiste, suba nuevamente el archivo.');
            return redirect()->back();
        }
    }
    public function downloadResolution(ServiceRequest $serviceRequest)
    {
        $storage_path = 'service_request/resolutions/';
        $file =  $storage_path . $serviceRequest->id . '.pdf';
        if (Storage::disk('gcs')->exists($file)) {
            return Storage::disk('gcs')->response($file, mb_convert_encoding($serviceRequest->id . '.pdf', 'ASCII'));
        } else {
            session()->flash('warning', 'No se ha encontrado el archivo. Intente nuevamente en 10 minutos, si el problema persiste, suba nuevamente el archivo.');
            return redirect()->back();
        }

    }

}
