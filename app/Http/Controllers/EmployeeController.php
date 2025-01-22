<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index() {
        return view('employes.index');
    }

    public function create() {
        return view('employes.create');
    }

    public function edit(Employee $employee) {
        return view('employes.edit', compact('employee'));
    }
}
