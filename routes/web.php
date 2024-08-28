<?php
// routes/web.php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

// Route untuk halaman depan
Route::get('/', function () {
    return view('home');
})->name('home');

// Route untuk Employee
Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/employees/edit/{id}', [EmployeeController::class, 'edit'])->name('employees.edit');
Route::post('/employees/store', [EmployeeController::class, 'store'])->name('employees.store');
Route::get('/employees/delete/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

// Route untuk Location
Route::get('/locations', [LocationController::class, 'index'])->name('locations.index');
Route::post('/locations/store', [LocationController::class, 'store'])->name('locations.store');
Route::get('/locations/edit/{code}', [LocationController::class, 'edit']);
Route::get('/locations/delete/{code}', [LocationController::class, 'destroy']);
