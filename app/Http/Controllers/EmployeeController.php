<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $employes = Employee::paginate(10);
        return view('employes.index', compact('employes'));
    }

    public function create() {
        $departements = Departement::all();
        return view('employes.create', compact('departements'));
    }

    public function edit(Employee $employee) {
        return view('employes.edit', compact('employee'));
    }
}
