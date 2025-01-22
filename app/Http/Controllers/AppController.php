<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(){
        $totalDepartements = Departement::all()->count();
        $totalEmployes = Employee::all()->count();
        $totalAdministrateurs = User::all()->count();
        return view('dashboard', compact('totalDepartements', 'totalEmployes', 'totalAdministrateurs'));
    }
}
