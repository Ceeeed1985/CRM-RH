<?php

namespace App\Services;

use App\Models\Configuration;
use Carbon\Carbon;

class PaymentNotificationService
{
    public function generatePaymentNotification()
    {
        $paymentNotificationSuccess = "";
        $paymentNotificationWarning = "";
        $currentDate = Carbon::now()->day;

        $defaultPaymentDateQuery = Configuration::where('type', 'PAYMENT_DATE')->first();
        
        if ($defaultPaymentDateQuery) {
            $defaultPaymentDate = $defaultPaymentDateQuery->value;
            $convertedPaymentDate = intval($defaultPaymentDate);

            if ($currentDate < $convertedPaymentDate) {
                $paymentNotificationWarning = "Le paiement doit avoir lieu le " . $defaultPaymentDate . " de ce mois.";
            } else {
                $nextMonth = Carbon::now()->addMonth();
                $nextMonthName = $nextMonth->format('F');
                $paymentNotificationSuccess = "Le paiement doit avoir lieu le " . $defaultPaymentDate . " du mois " . $nextMonthName . "."; 
            }
        }

        return [
            'paymentNotificationSuccess' => $paymentNotificationSuccess,
            'paymentNotificationWarning' => $paymentNotificationWarning,
        ];
    }
}
