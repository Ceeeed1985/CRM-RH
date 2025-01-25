<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Employee;
use App\Models\Departement;
use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Services\PaymentNotificationService;

class AppController extends Controller
{
    protected $paymentNotificationService;
    public function __construct(PaymentNotificationService $paymentNotificationService)
    {
        $this->paymentNotificationService = $paymentNotificationService;
    }

    public function index(){
        $totalDepartements = Departement::all()->count();
        $totalEmployes = Employee::all()->count();
        $totalAdministrateurs = User::all()->count();

        $notifications = $this->paymentNotificationService->generatePaymentNotification();
                
        return view('dashboard', [
            'totalDepartements' => $totalDepartements,
            'totalEmployes' => $totalEmployes,
            'totalAdministrateurs' => $totalAdministrateurs,
            'paymentNotificationSuccess' => $notifications['paymentNotificationSuccess'],
            'paymentNotificationWarning' => $notifications['paymentNotificationWarning'],
        ]);
    }
}
