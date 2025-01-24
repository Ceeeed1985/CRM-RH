@extends('layouts.template')

@section('content')
<h1 class="app-page-title">Employés</h1>
<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-4">
        <h3 class="section-title">Modifier un employé</h3>
        <div class="section-intro">Vous pouvez mettre à jour les informations d'un employé en modifiant les champs dans le formulaire</div>
    </div>
    <div class="col-12 col-md-8">
        <div class="app-card app-card-settings shadow-sm p-4">
            
            <div class="app-card-body">
                <form class="settings-form" method="POST" action="{{ route('employe.update', $employe->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="setting-input-3" class="form-label">Département</label>
                        <select name="departement_id" id="departement_id" class="form-control">
                            @foreach ($departements as $departement)
                                {{-- <option value="{{ $departement->id }}" {{ $employe->departement->id === $departement->id ? 'selected' : '' }}>{{ $departement->name }}</option> --}}
                                <option value="{{ $departement->id }}" {{ isset($employe->departement) && $employe->departement->id === $departement->id ? 'selected' : '' }}>{{ $departement->name }}</option>
                            @endforeach
                        </select>
                        @error('departement_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-1" class="form-label">Nom de famille<span class="ms-2" data-container="body" data-bs-toggle="popover" data-trigger="hover" data-placement="top" data-content="This is a Bootstrap popover example. You can use popover to provide extra info."></span>
                        </label>
                        <input type="text" class="form-control" id="setting-input-1" name="nom" value="{{ $employe->nom }}" placeholder="Entrez le nom" required>
                        @error('nom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-2" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="setting-input-2" name="prenom" value="{{ $employe->prenom }}" placeholder="Entrez le prénom" required>
                        @error('prenom')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-3" class="form-label">Email</label>
                        <input type="email" class="form-control" id="setting-input-3" name="email" value="{{ $employe->email }}" placeholder="Entrez l'adresse mail">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-3" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="setting-input-3" name="contact" value="{{ $employe->contact }}" placeholder="Entrez le numéro de téléphone">
                        @error('contact')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="setting-input-3" class="form-label">Montant journalier</label>
                        <input type="number" class="form-control" id="setting-input-3" name="montant_journalier" value="{{ $employe->montant_journalier }}" placeholder="Entrez le montant journalier">
                        @error('montant_journalier')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn app-btn-primary" >Mettre à jour</button>
                </form>
            </div><!--//app-card-body-->
            
        </div><!--//app-card-->
    </div>
</div><!--//row-->
<hr class="my-4">

@endsection