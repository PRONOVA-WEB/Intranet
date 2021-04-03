<?php

namespace App\Http\Controllers\ServiceRequests;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceRequests\ServiceRequest;
use App\Models\ServiceRequests\Fulfillment;
use Luecano\NumeroALetras\NumeroALetras;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function toPay(Request $request){
        $establishment_id = $request->establishment_id;
        $topay_fulfillments1 = Fulfillment::whereHas("ServiceRequest", function($subQuery) {
                                       $subQuery->where('has_resolution_file',1);
                                     })
                                     ->when($request->establishment_id == 1 || $request->establishment_id == 12, function ($q) use ($establishment_id) {
                                          return $q->whereHas("ServiceRequest", function($subQuery) use ($establishment_id) {
                                                      $subQuery->where('establishment_id',$establishment_id);
                                                    });
                                       })
                                     ->when($request->establishment_id == 0, function ($q) use ($establishment_id) {
                                          return $q->whereHas("ServiceRequest", function($subQuery) use ($establishment_id) {
                                                      $subQuery->whereNotIn('establishment_id',[1,12]);
                                                    });
                                       })
                                     ->where('has_invoice_file',1)
                                     ->where('type','Mensual')
                                     ->where('responsable_approbation',1)
                                     ->where('rrhh_approbation',1)
                                     ->where('finances_approbation',1)
                                     ->whereNull('total_paid')
                                     ->get();

         $topay_fulfillments2 = Fulfillment::whereHas("ServiceRequest", function($subQuery) {
                                        $subQuery->where('has_resolution_file',1);
                                      })
                                      ->when($request->establishment_id == 1 || $request->establishment_id == 12, function ($q) use ($establishment_id) {
                                           return $q->whereHas("ServiceRequest", function($subQuery) use ($establishment_id) {
                                                       $subQuery->where('establishment_id',$establishment_id);
                                                     });
                                        })
                                      ->when($request->establishment_id == 0, function ($q) use ($establishment_id) {
                                           return $q->whereHas("ServiceRequest", function($subQuery) use ($establishment_id) {-
                                                       $subQuery->whereNotIn('establishment_id',[1,12]);
                                                     });
                                        })
                                      ->where('has_invoice_file',1)
                                      ->where('type','<>','Mensual')
                                      ->whereNull('total_paid')
                                      ->get();

        $topay_fulfillments = $topay_fulfillments1->merge($topay_fulfillments2);

        return view('service_requests.reports.to_pay', compact('topay_fulfillments','request'));
    }

    public function bankPaymentFile($establishment_id)
    {
        $fulfillments1 = Fulfillment::whereHas("ServiceRequest", function($subQuery) {
                                       $subQuery->where('has_resolution_file',1);
                                     })
                                     ->when($establishment_id == 1 || $establishment_id == 12, function ($q) use ($establishment_id) {
                                          return $q->whereHas("ServiceRequest", function($subQuery) use ($establishment_id) {
                                                      $subQuery->where('establishment_id',$establishment_id);
                                                });
                                       })
                                     ->when($establishment_id == 0, function ($q) use ($establishment_id) {
                                          return $q->whereHas("ServiceRequest", function($subQuery) use ($establishment_id) {
                                                      $subQuery->whereNotIn('establishment_id',[1,2]);
                                                    });
                                       })
                                     ->where('has_invoice_file',1)
                                     ->where('payment_ready', 1)
                                     ->whereNull('total_paid')
                                     ->where('type','Mensual')
                                     ->where('responsable_approbation',1)
                                     ->where('rrhh_approbation',1)
                                     ->where('finances_approbation',1)
                                     ->get();

         $fulfillments2 = Fulfillment::whereHas("ServiceRequest", function($subQuery) {
                                        $subQuery->where('has_resolution_file',1);
                                      })
                                      ->when($establishment_id == 1 || $establishment_id == 12, function ($q) use ($establishment_id) {
                                           return $q->whereHas("ServiceRequest", function($subQuery) use ($establishment_id) {
                                                       $subQuery->where('establishment_id',$establishment_id);
                                                     });
                                        })
                                      ->when($establishment_id == 0, function ($q) use ($establishment_id) {
                                           return $q->whereHas("ServiceRequest", function($subQuery) use ($establishment_id) {
                                                       $subQuery->whereNotIn('establishment_id',[1,2]);
                                                     });
                                        })
                                      ->where('has_invoice_file',1)
                                      ->where('payment_ready', 1)
                                      ->whereNull('total_paid')
                                      ->where('type','<>','Mensual')
                                      ->get();

        $fulfillments = $fulfillments1->merge($fulfillments2);

        if ($fulfillments->count() == 0) {
            session()->flash('warning', "No existen solicitudes aptas para pago.");
            return redirect()->back();
        }

        $txt = '';
        foreach ($fulfillments as $fulfillment) {
            if (!$fulfillment->serviceRequest->employee->bankAccount) {
                session()->flash('warning', "La solicitud con id {$fulfillment->serviceRequest->id} no contiene el banco a donde se debe pagar.");
                return redirect()->back();
            }
            if (!$fulfillment->serviceRequest->employee->bankAccount->type) {
                session()->flash('warning', "La solicitud con id {$fulfillment->serviceRequest->id} no contiene método de pago.");
                return redirect()->back();
            }
            if (!$fulfillment->serviceRequest->employee->bankAccount->number) {
                session()->flash('warning', "La solicitud con id {$fulfillment->serviceRequest->id} no contiene número de cuenta.");
                return redirect()->back();
            }
            if (!$fulfillment->total_to_pay) {
                session()->flash('warning', "La solicitud con id {$fulfillment->serviceRequest->id} no contiene total a pagar.");
                return redirect()->back();
            }

            $totalToPay = $fulfillment->total_to_pay - round($fulfillment->total_to_pay * 0.115);
            $txt .=
                $fulfillment->serviceRequest->employee->id . strtoupper($fulfillment->serviceRequest->employee->dv)."\t".
                strtoupper(trim($fulfillment->serviceRequest->employee->fullName))."\t".
                strtolower($fulfillment->serviceRequest->email)."\t".
                $fulfillment->serviceRequest->employee->bankAccount->bank->code."\t".
                $fulfillment->serviceRequest->employee->bankAccount->type."\t".
                intval($fulfillment->serviceRequest->employee->bankAccount->number)."\t".
                $totalToPay."\r\n"; // Para final de linea de txt en windows
        }

        $response = new StreamedResponse();
        $response->setCallBack(function () use ($txt) {
            echo $txt;
        });
        $response->headers->set('Content-Type', 'text/plain');
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, "pago-banco.txt");
        $response->headers->set('Content-Disposition', $disposition);

        return $response;

    }

    public function pendingResolutions(Request $request){
        $serviceRequests = ServiceRequest::whereNull('has_resolution_file')->orWhere('has_resolution_file','===',0)
                                        ->get();
        foreach ($serviceRequests as $key => $serviceRequest) {
            //only completed
            if ($serviceRequest->SignatureFlows->where('status','===',0)->count() == 0 && $serviceRequest->SignatureFlows->whereNull('status')->count() == 0) {

            }else{
              $serviceRequests->forget($key);
            }
        }

        // dd($fulfillments);
        return view('service_requests.reports.pending_resolutions', compact('serviceRequests'));
    }


    public function withoutBankDetails()
    {

        $servicerequests = ServiceRequest::whereHas("fulfillments", function($subQuery) {
            $subQuery->where('has_invoice_file',1);
          })
          ->get();

        return view('service_requests.reports.without_bank_details', compact('servicerequests'));

    }

    public function indexWithResolutionFile() {
        $serviceRequests = ServiceRequest::where('has_resolution_file',1)->paginate(50);
        $title = 'Solicitudes con resolución cargada';
        return view('service_requests.reports.index_with_resolution_file', compact('serviceRequests','title'));
        /* Hacer foreach de cada SRs y dentro hacer un foreach de sus fulfillments y mostrar cual tiene boleta y cual no */
    }

    public function indexWithoutResolutionFile() {
        $serviceRequests = ServiceRequest::where('has_resolution_file','<>',1)->paginate(50);
        $title = 'Solicitudes sin resolución cargada';
        return view('service_requests.reports.index_with_resolution_file', compact('serviceRequests','title'));
        /* Hacer foreach de cada SRs y dentro hacer un foreach de sus fulfillments y mostrar cual tiene boleta y cual no */
    }

    public function resolutionPDF(ServiceRequest $ServiceRequest)
    {
        $formatter = new NumeroALetras();
        $ServiceRequest->gross_amount_description = $formatter->toWords($ServiceRequest->gross_amount, 0);

        if ($ServiceRequest->fulfillments) {
          foreach ($ServiceRequest->fulfillments as $key => $fulfillment) {
            $fulfillment->total_to_pay_description = $formatter->toWords($fulfillment->total_to_pay, 0);
          }
        }

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('service_requests.report_resolution',compact('ServiceRequest'));

        return $pdf->stream('mi-archivo.pdf');
        // return view('service_requests.report_resolution', compact('serviceRequest'));
        // $pdf = \PDF::loadView('service_requests.report_resolution');
        // return $pdf->stream();
    }

    public function payRejected() {
        $fulfillments = Fulfillment::where('payment_ready',0)->orderByDesc('id')->get();
        return view('service_requests.reports.pay_rejected', compact('fulfillments'));
    }
}
