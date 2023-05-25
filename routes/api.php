<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Users
Route::post('/auth_login', [App\Http\Controllers\UserController::class, 'userLogin']);
Route::post('/create_user', [App\Http\Controllers\UserController::class, 'createUser']);
Route::get('/get_current_user/{id}', [App\Http\Controllers\UserController::class, 'getCurrentUser']);
Route::get('/get_all_users', [App\Http\Controllers\UserController::class, 'getAllUserr']);


//Patients
Route::post('/create_patient', [App\Http\Controllers\PatientController::class, 'createPatient']);
Route::post('/update_patient', [App\Http\Controllers\PatientController::class, 'updatePatient']);
Route::get('/get_patient/{id}', [App\Http\Controllers\PatientController::class, 'getPatientById']);
Route::get('/get_all_patients', [App\Http\Controllers\PatientController::class, 'getAllPatients']);



//Medical Records
Route::get('/get_all_patient_medical_record/{id}', [App\Http\Controllers\PatientMedicalRecordController::class, 'getAllPatienMedRecordsById']);
Route::post('/create_med_record', [App\Http\Controllers\PatientMedicalRecordController::class, 'createMedRecord']);
Route::post('/update_med_record', [App\Http\Controllers\PatientMedicalRecordController::class, 'updateMedRecord']);
Route::get('/get_med_record/{id}', [App\Http\Controllers\PatientMedicalRecordController::class, 'getMedRecordById']);
Route::get('/get_all_med_records', [App\Http\Controllers\PatientMedicalRecordController::class, 'getAllMedRecords']);