<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeConfigRequest;
use App\Models\Configuration;

class ConfigurationController extends Controller
{
    public function index()
    {
        $allConfigurations = Configuration::latest()->paginate(10);
        $i = 1;
        return view ('config/index', compact('allConfigurations', 'i'));
    }

    public function create() {
        return view('config/create');
    }

    public function store(storeConfigRequest $request){
        try {
            Configuration::create($request->all());
            return redirect()->route('configurations')->with('success_message', "Les données de configurations ont été enregistrées avec succès");
        } catch (Exception $e) {
            throw new Exception("Erreur lors de l'enregistrement de la donnée de configuration");
        }
    }

    public function delete(Configuration $configuration){
        try {
            $configuration->delete();
            return redirect()->route('configurations')->with('success_message', "Les données de configurations ont été supprimées avec succès");
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression de la donnée de configuration");
        }
    }
}
