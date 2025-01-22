<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
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
    });
});

