<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Departement;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // ------------- AFFICHAGE DEPARTEMENT : GET --------------
    public function index() {
        $employes = Employee::paginate(10);
        $i = 1;
        return view('employes.index', compact('employes', 'i'));
    }

    public function create() {
        $departements = Departement::all();
        return view('employes.create', compact('departements'));
    }

    public function edit(Employee $employee) {
        return view('employes.edit', compact('employee'));
    }

    // ------------- NOUVEAU DEPARTEMENT : POST --------------
    public function store(StoreEmployeeRequest $request) {
        try {
            $employee = new Employee();
            $employee->departement_id = $request->departement_id;
            $employee->nom = $request->nom;
            $employee->prenom = $request->prenom;
            $employee->email = $request->email;
            $employee->contact = $request->contact;
            $employee->montant_journalier = $request->montant_journalier;
            $employee->save();
            return redirect()->route('employee.index')->with('success_message', "Le nouvel employé a été enregistré avec succès !");
        } catch (Exception $e) {
            dd($e);
        }
        
    }

    // ------------- MODIFIER DEPARTEMENT : PUT --------------


    // ------------- MODIFIER DEPARTEMENT : DELETE --------------
    
}
