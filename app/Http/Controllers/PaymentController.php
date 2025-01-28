<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Carbon\Carbon;

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
        $currentDate = $currentMonthInFrench . ' ' . $currentYear;
        dd($currentDate);

    }



}
