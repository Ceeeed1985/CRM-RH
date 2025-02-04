<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handleLogin'])->name('handleLogin');

Route::get('/validate-account/{email}', [AdminController::class, 'defineAccess']);
Route::post('/validate-account/{email}', [AdminController::class, 'submitDefineAccess'])->name('submitDefineAccess');



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

    Route::prefix('configurations')->group(function(){
        Route::get('/', [ConfigurationController::class, 'index'])->name('configurations');
        Route::get('/create', [ConfigurationController::class, 'create'])->name('configurations.create');
        Route::post('/store', [ConfigurationController::class, 'store'])->name('configurations.store');
        Route::delete('/delete/{configuration}', [ConfigurationController::class, 'delete'])->name('configurations.delete');
    });

    Route::prefix('administrateurs')->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('administrateurs');
        Route::get('/create', [AdminController::class, 'create'])->name('administrateurs.create');
        Route::post('/create', [AdminController::class, 'store'])->name('administrateurs.store');
        Route::get('/edit/{administrateur}', [AdminController::class, 'edit'])->name('administrateurs.edit');
        Route::put('/edit/{administrateur}', [AdminController::class, 'update'])->name('administrateurs.update');
        Route::delete('/delete/{user}', [AdminController::class, 'delete'])->name('administrateurs.delete');
    });
        
    Route::prefix('payment')->group(function(){
        Route::get('/', [PaymentController::class, 'index'])->name('payments');
        Route::get('/make', [PaymentController::class, 'initPayment'])->name('payment.init');
    });
});

