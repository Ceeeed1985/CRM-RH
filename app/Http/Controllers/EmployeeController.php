<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        $employes = Employee::paginate(10);
        return view('employes.index', compact('employes'));
    }

    public function create() {
        return view('employes.create');
    }

    public function edit(Employee $employee) {
        return view('employes.edit', compact('employee'));
    }
}
