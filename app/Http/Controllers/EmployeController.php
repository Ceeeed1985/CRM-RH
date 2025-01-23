<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Departement;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    // ------------- AFFICHAGE DEPARTEMENT : GET --------------
    public function index() {
        $employes = Employee::with('departement')->paginate(10);
        $i = 1;
        return view('employes.index', compact('employes', 'i'));
    }

    public function create() {
        $departements = Departement::all();
        return view('employes.create', compact('departements'));
    }

    public function edit(Employee $employe) {
        $departements = Departement::all();
        return view('employes.edit', compact('employe', 'departements'));
    }

    // ------------- NOUVEAU DEPARTEMENT : POST --------------
    public function store(StoreEmployeeRequest $request) {
        try {
            $employe = new Employee();
            $employe->departement_id = $request->departement_id;
            $employe->nom = $request->nom;
            $employe->prenom = $request->prenom;
            $employe->email = $request->email;
            $employe->contact = $request->contact;
            $employe->montant_journalier = $request->montant_journalier;
            $employe->save();
            return redirect()->route('employe.index')->with('success_message', "Le nouvel employé a été enregistré avec succès !");
        } catch (Exception $e) {
            dd($e);
        }
        
    }

    // ------------- MODIFIER DEPARTEMENT : PUT --------------
    public function update(UpdateEmployeeRequest $request, Employee $employe){
        try {
            $employe->departement_id = $request->departement_id;
            $employe->nom = $request->nom;
            $employe->prenom = $request->prenom;
            $employe->email = $request->email;
            $employe->contact = $request->contact;
            $employe->montant_journalier = $request->montant_journalier;
            $employe->update();
            return redirect()->route('employe.index')->with('success_message', "Les informations de l'employé ont été mise à jour avec succès !");
        } catch (Exception $e) {
            dd($e);
        }
    }

    // ------------- MODIFIER DEPARTEMENT : DELETE --------------
    public function delete(Employee $employe) {
        try {
            $employe->delete();
            return redirect()->route('employe.index')->with('success_message', "L'employé a été supprimé avec succès !");
        } catch (Exception $e) {
            dd($e);
        }
    }
}
