<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handleLogin'])->name('handleLogin');


//ROUTES SECURISEES

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [AppController::class, 'index'])->name('dashboard');

    Route::prefix('employes')->group(function(){
        Route::get('/', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::get('/edit/{employee}', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::post('/store', [EmployeeController::class, 'store'])->name('employee.store');
        Route::put('/update/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::delete('/delete/{employee}', [EmployeeController::class, 'delete'])->name('employee.delete');
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

