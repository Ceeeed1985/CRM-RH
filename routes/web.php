<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handleLogin'])->name('handleLogin');


//ROUTES SECURISEES

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard');

    Route::prefix('employes')->group(function(){
        Route::get('/', [EmployeController::class, 'index'])->name('employe.index');
        Route::get('/create', [EmployeController::class, 'create'])->name('employe.create');
        Route::get('/edit/{employe}', [EmployeController::class, 'edit'])->name('employe.edit');
        Route::post('/store', [EmployeController::class, 'store'])->name('employe.store');
        Route::put('/update/{employe}', [EmployeController::class, 'update'])->name('employe.update');
        Route::delete('/delete/{employe}', [EmployeController::class, 'delete'])->name('employe.delete');
    });

    Route::prefix('departements')->group(function(){
        Route::get('/', [DepartementController::class, 'index'])->name('departement.index');
        Route::get('/create', [DepartementController::class, 'create'])->name('departement.create');
        Route::post('/store', [DepartementController::class, 'store'])->name('departement.store');
        Route::get('/edit/{departement}', [DepartementController::class, 'edit'])->name('departement.edit');
        Route::put('/udpate/{departement}', [DepartementController::class, 'update'])->name('departement.update');
        Route::delete('/delete/{departement}', [DepartementController::class, 'delete'])->name('departement.delete');
    });


});

