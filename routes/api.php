<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RdvController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RadiologieController;
use App\Http\Controllers\AnalyseController;
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
Route::get('/analyse/{analyse}', [AnalyseController::class, 'showOrdonnance'])->name('analyse.show');

Route::get('/radiologie/{radiologie}', [RadiologieController::class, 'showOrdonnance'])->name('radiologie.show');

//analyse 
Route::post('/analyse/ajouter', [AnalyseController::class, 'store'])->name('analyse.ajouter')->middleware('auth');

//radiologie
Route::post('/radiologie/ajouter', [RadiologieController::class, 'store'])->name('radiologie.ajouter');

Route::get('/patient/rechercher', [PatientController::class, 'rechercher'])->name('patient.rechercher');
Route::post('/patient/ajouter', [PatientController::class, 'store'])->name('patient.ajouter');
Route::get('/patient/create', [PatientController::class, 'create'])->name('patient.create');
Route::put('/patient/{patient}', [BotManController::class, 'update'])->name('updatePatient');
Route::get('/patient/{patient}', [BotManController::class, 'edit'])->name('editPatient');
//user
Route::post('/user/create', [UserController::class, 'store'])->name('user.ajouter');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::get('/user/rechercher', [UserController::class, 'rechercher'])->name('user.rechercher');

Route::get('/medecin/rechercher', [MedecinController::class, 'rechercher'])->name('medecin.rechercher');
Route::post('/delete-appointment', [UserController::class, 'delete'])->name('delete-appointment');
Route::get('/medecin/{medecin}', [MedecinController::class, 'historiqueConsultation'])->name('medecin.afficher');
//ordonnance
Route::put('/ordonnance/{ordonnance}', [OrdonnanceController::class, 'update'])->name('ordonnance.update');
Route::get('/ordonnance', [OrdonnanceController::class,'index'])->name('ordonnance');
Route::get('/telechargerOrdonnance', [OrdonnanceController::class, 'downloadPDF'])->name('telechargerOrdonnance');
Route::get('/ordonnance/{ordonnance}', [OrdonnanceController::class, 'edit'])->name('ordonnance.edit');
Route::delete('/ordonnance/{ordonnance}', [OrdonnanceController::class, 'delete'])->name('ordonnance.supprimer');
//rendez-vous
Route::get('/rdv', [RdvController::class, 'index'])->name('rdv');
Route::delete('/rdv/{rdv}', [RdvController::class, 'delete'])->name('rdv.supprimer');
//consultation
Route::get('/consultation', [ConsultationController::class,'index'])->name('consultation');
Route::delete('/consultation/{consultation}', [ConsultationController::class, 'delete'])->name('consultation.supprimer');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



