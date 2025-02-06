<?php

namespace App\Http\Controllers;

use Exception;
use Stringable;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use PhpParser\Node\Stmt\TryCatch;

class PaymentController extends Controller
{
    public function index(){
        $defaultPaymentDateQuery = Configuration::where('type', 'PAYMENT_DATE')->first();
        $defaultPaymentDate = $defaultPaymentDateQuery->value;
        $convertedPaymentDate = intval($defaultPaymentDate);
        $today = date('d');
        $isPaymentDay = false;
        if($today == $convertedPaymentDate){
            $isPaymentDay = true;
        };
        // dd(date('d'));

        $payments = Payment::latest()->orderBy('id', 'desc')->paginate(10);
        return view('payments.index', compact('payments', 'isPaymentDay'));
    }

    public function initPayment() {

        $monthMapping = [
            'JANUARY' => 'JANVIER',
            'FEBRUARY' => 'FÉVRIER',
            'MARCH' => 'MARS',
            'APRIL' => 'AVRIL',
            'MAY' => 'MAI',
            'JUNE' => 'JUIN',
            'JULY' => 'JUILLET',
            'AUGUST' => 'AOÛT',
            'SEPTEMBER' => 'SEPTEMBRE',
            'OCTOBER' => 'OCTOBRE',
            'NOVEMBER' => 'NOVEMBRE',
            'DECEMBER' => 'DÉCEMBRE',
        ];
        $currentMonth = strtoupper(Carbon::now()->formatLocalized('%B'));

        //Récupération du mois en cours en français
        $currentMonthInFrench = $monthMapping[$currentMonth] ?? '';
        
        //Récupération de l'année en cours
        $currentYear = Carbon::now()->format('Y');


        //Récupérer liste employés pas encore payés (mois en cours)
        $employes = Employee::whereDoesntHave('payments', function($query) use($currentMonthInFrench, $currentYear){
            $query->where('month', '=', $currentMonthInFrench)->where('year', '=', $currentYear);
        })->get();

        if($employes->count() === 0){
            return redirect()->back()->with('error_message', 'Tous les employés ont déjà été payés pour le mois de '. $currentMonthInFrench .'.');
        }

        //Faire les paiements
        foreach($employes as $employe){
            $hasBeenPaidThisMonth = $employe->payments()->where('month', '=', $currentMonthInFrench)->where('year', '=', $currentYear)->exists();

            if(!$hasBeenPaidThisMonth){
                $salaire = $employe->montant_journalier * 31;
                $payment = new Payment([
                    'reference' => strtoupper(Str::random(10)),
                    'employee_id' => $employe->id,
                    'amount'=>$salaire,
                    'launch_date'=>now(),
                    'done_time'=>now(),
                    'status'=>'SUCCESS',
                    'month'=>$currentMonthInFrench,
                    'year'=>$currentYear,
                ]);

                $payment->save();
            }
        }

        return redirect()->back()->with('success_message', 'Paiement des employés effectué pour le mois de '. $currentMonthInFrench .'.');

    }

    public function downloadInvoice(Payment $payment){
        try {
            $fullPaymentInfo = Payment::with('employe')->find($payment->id);
            //Generer une vue
            // return view('payments.invoice', compact('fullPaymentInfo'));
            $pdf = FacadePdf::loadView('payments.invoice', compact('fullPaymentInfo'));
            return $pdf->download('facture_'.$fullPaymentInfo->employe->nom.'_'.$fullPaymentInfo->employe->prenom.'.pdf');

        } catch (Exception $e) {
            throw new Exception("Une erreur est survenue lors de la création du pdf");
        }
    }


}
