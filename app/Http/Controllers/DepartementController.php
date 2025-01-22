<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveDepartementRequest;
use App\Models\Departement;
use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class DepartementController extends Controller
{
    // ------------- AFFICHAGE DEPARTEMENT : GET --------------
    public function index() {
        $departements = Departement::paginate(10);
        return view('departements.index', compact('departements'));
    }

    public function create() {
        return view('departements.create');
    }

    public function edit(Departement $departement) {
        return view('departements.edit', compact('departement'));
    }

    // ------------- NOUVEAU DEPARTEMENT : POST --------------
    public function store(Departement $departement, saveDepartementRequest $request) {
        try {
            $departement->name = $request->name;
            $departement->save();
            return redirect()->route('departement.index')->with('success_message', "Le nouveau département a été enregistré avec succès !");
        } catch (Exception $e) {
            dd($e);
        }
    }

    // ------------- MODIFIER DEPARTEMENT : PUT --------------
    public function update(Departement $departement, saveDepartementRequest $request) {
        try {
            $departement->name = $request->name;
            $departement->update();
            return redirect()->route('departement.index')->with('success_message', "Le nouveau département a été mis à jour avec succès !");
        } catch (Exception $e) {
            dd($e);
        }
    }

    // ------------- MODIFIER DEPARTEMENT : DELETE --------------
    public function delete(Departement $departement) {
        try {
            $departement->delete();
            return redirect()->route('departement.index')->with('success_message', "Le département a été supprimé avec succès !");
        } catch (Exception $e) {
            dd($e);
        }
    }

}
