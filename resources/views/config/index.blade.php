@extends('layouts.template')

@section('content')
<div class="row g-3 mb-4 align-items-center justify-content-between">
    <div class="col-auto">
        <h1 class="app-page-title mb-0">Configurations</h1>
    </div>

    <div class="col-auto">
         <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <form class="table-search-form row gx-1 align-items-center">
                        <div class="col-auto">
                            <input type="text" id="search-orders" name="searchorders" class="form-control search-orders" placeholder="Search">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn app-btn-secondary">Search</button>
                        </div>
                    </form>
                    
                </div><!--//col-->

                <div class="col-auto">						    
                    <a class="btn app-btn-secondary" href="{{ route('configurations.create') }}">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-download me-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                        Nouvelle configuration
                    </a>
                </div>
            </div><!--//row-->
        </div><!--//table-utilities-->
    </div><!--//col-auto-->
</div><!--//row-->

@if(Session::get('success_message'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ Session::get('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">#</th>
                                <th class="cell">Type</th>
                                <th class="cell">Valeur</th>
                                <th class="cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($allConfigurations as $config)
                                <tr>
                                    <td class="cell">{{ $i++ }}</td>
                                    <td class="cell">
                                        @switch($config->type)
                                            @case('PAYMENT_DATE')
                                                <span class="truncate">Date mensuelle de paiement</span>
                                                @break
                                            @case('APP_NAME')
                                                <span class="truncate">Nom de l'application</span>
                                                @break
                                            @case('DEVELOPPER_NAME')
                                                <span class="truncate">Equipe de développement</span>
                                                @break
                                            @case('ANOTHER')
                                                <span class="truncate">Autre configuration</span>
                                                @break
                                            @default
                                                <span class="truncate">{{ $config->type }}</span>
                                        @endswitch
                                    </td>
                                    <td class="cell items-center">
                                        <span class="truncate">{{ $config->value }}</span>
                                        @if ($config->type === 'PAYMENT_DATE')
                                            <span class="truncate">de chaque mois</span>
                                        @endif
                                    </td>
                                    <td>
                                        <form method ='POST' action="{{ route('configurations.delete', $config->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type='submit' class="btn btn-sm btn-outline-danger border border-danger" style='margin-left:5px'>Supprimer</button>
                                        </form>
                                    </td>
                                </tr>  
                            @empty
                                <tr>
                                    <td class="cell" colspan="4">Aucune configuration ajoutée</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
               
            </div><!--//app-card-body-->		
        </div><!--//app-card-->
        <nav class="app-pagination">
            {{ $allConfigurations->links() }}
        </nav><!--//app-pagination-->
        
    </div><!--//tab-pane-->
    

</div><!--//tab-content-->
@endsection