<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HospitalController;

Route::get('/', [HospitalController::class, 'dashboard'])->name('dashboard');
Route::get('/patients', [HospitalController::class, 'patients'])->name('patients');

Route::get('/patients/{medical_record_no}', [HospitalController::class, 'showPatient'])
    ->name('patients.show');

Route::get('/patients/{medical_record_no}/visit-history', [HospitalController::class, 'visitHistory'])
    ->name('patients.history');

Route::get('/visits', [HospitalController::class, 'visits'])
    ->name('visits.index');