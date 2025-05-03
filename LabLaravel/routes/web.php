<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\TreatmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [TestController::class, 'test']);

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/new', [ProductController::class, 'newProductForm'])->name('products.create');
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/{id}/edit', [ProductController::class, 'editProductForm']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

Route::resource('patients', PatientController::class);
Route::resource('doctors', DoctorController::class);
Route::resource('appointments', AppointmentController::class);
Route::resource('diagnoses', DiagnosisController::class);
Route::resource('treatments', TreatmentController::class);
