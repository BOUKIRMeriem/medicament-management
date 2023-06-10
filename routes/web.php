<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedecinController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RdvController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\OrdonnanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\RadiologieController;
use App\Http\Controllers\AnalyseController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dashboard', [DashboardController::class, 'dashboard'])  ->name('dashboard')
->middleware('auth');
  


Route::get('/radiologie/rechercher', [RadiologieController::class, 'rechercher'])->name('radiologie.rechercher')->middleware('auth');
Route::get('/analyse/create', [AnalyseController::class, 'create'])->name('analyse.create')->middleware('auth');

Route::get('/pdf/{analyse}', [AnalyseController::class, 'pdf'])->name('analyse.pdf')->middleware('auth');
Route::get('/pdf/{radiologie}', [RadiologieController::class, 'pdf'])->name('radiologie.pdf')->middleware('auth');
Route::get('/pdf/{ordonnance}', [OrdonnanceController::class, 'pdf'])->name('export.pdf')->middleware('auth');

Route::get('/radiologie/create', [RadiologieController::class, 'create'])->name('radiologie.create')->middleware('auth');


Route::get('/analyse/rechercher', [AnalyseController::class, 'rechercher'])->name('analyse.rechercher')->middleware('auth');
Route::get('/analyse/{analyse}', [AnalyseController::class, 'edit'])->name('analyse.edit')->middleware('auth');
Route::put('/analyse/{analyse}', [AnalyseController::class, 'update'])->name('analyse.update')->middleware('auth');
Route::delete('/analyse/{analyse}', [AnalyseController::class, 'delete'])->name('analyse.supprimer')->middleware('auth');
Route::get('/analyse', [AnalyseController::class,'index'])->name('analyse')->middleware('auth');
//radiologie
Route::get('/radiologie/{radiologie}', [RadiologieController::class, 'edit'])->name('radiologie.edit')->middleware('auth');
Route::put('/radiologie/{radiologie}', [RadiologieController::class, 'update'])->name('radiologie.update')->middleware('auth');
Route::delete('/radiologie/{radiologie}', [RadiologieController::class, 'delete'])->name('radiologie.supprimer')->middleware('auth');
Route::get('/radiologie', [RadiologieController::class,'index'])->name('radiologie')->middleware('auth');

//chatbot
Route::put('/patient/{patient}', [BotManController::class, 'update'])->name('updatePatient')->middleware('auth');
Route::get('/patient/{patient}', [BotManController::class, 'edit'])->name('editPatient')->middleware('auth');
Route::get('/demandes/{demande}/valider', [DashboardController::class, 'valider'])->name('validerDemande');
Route::get('/', [BotManController::class, 'register']);
Route::match(['get', 'post'], '/createPatient', [BotManController::class, 'createPatient'])->name('createPatient')->middleware('auth');
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle'])->middleware('auth');
Route::get('/hello', [BotManController::class, 'hello'])->name('hello')->middleware('auth');
//user
Route::get('/user/{user}', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update')->middleware('auth');
Route::get('/user', [UserController::class,'index'])->name('user')->middleware('auth');
Route::delete('/user/{user}', [UserController::class, 'delete'])->name('user.supprimer')->middleware('auth');
//dashbord
Route::get('/calendar', [DashboardController::class, 'getAppointments'])->name('calendar')->middleware('auth');
Route::get('/appointments-chart', [DashboardController::class, 'getAppointmentsChartData'])->middleware('auth');
Route::get('/age-chart', [DashboardController::class, 'getAgeChartData'])->middleware('auth');

Route::get('/patients/{id}/desarchive', [PatientController::class,'désarchive'])->name('patient.desarchive')->middleware('auth');
Route::get('/ordonnance/rechercher', [OrdonnanceController::class, 'rechercher'])->name('ordonnance.rechercher')->middleware('auth');
Route::get('/ordonnance/create', [OrdonnanceController::class, 'create'])->name('ordonnance.create')->middleware('auth');
Route::get('/patients/{id}/archive', [PatientController::class,'archive'])->name('patient.archive')->middleware('auth');
Route::get('/ordonnance/{ordonnance}', [OrdonnanceController::class, 'showOrdonnance'])->name('ordonnance.show')->middleware('auth');
//authentification
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/check',[UserController::class,'check'])->name('check');
//Medecin
Route::get('/medecin', [MedecinController::class,'index'])->name('medecin')->middleware('auth');
Route::get('/medecin/create', [MedecinController::class, 'create'])->name('medecin.create')->middleware('auth');
Route::post('/medecin/create', [MedecinController::class, 'store'])->name('medecin.ajouter')->middleware('auth');
Route::get('/medecin/{medecin}', [MedecinController::class, 'edit'])->name('medecin.edit')->middleware('auth');
Route::put('/medecin/{medecin}', [MedecinController::class, 'update'])->name('medecin.update')->middleware('auth');
Route::delete('/medecin/{medecin}', [MedecinController::class, 'delete'])->name('medecin.supprimer')->middleware('auth');
//patient
Route::get('/patient', [PatientController::class,'index'])->name('patient')->middleware('auth');
Route::get('/patient/{patient}', [PatientController::class, 'edit'])->name('patient.edit')->middleware('auth');
Route::put('/patient/{patient}', [PatientController::class, 'update'])->name('patient.update')->middleware('auth');
Route::delete('/patient/{patient}', [PatientController::class, 'destroy'])->name('patient.supprimer')->middleware('auth');
Route::get('/{patient}', [PatientController::class,'afficher'])->name('afficherPatient')->middleware('auth');
//rendez-vous
Route::get('/rdv/rechercher', [RdvController::class, 'rechercher'])->name('rdv.rechercher')->middleware('auth');
Route::get('/rdv/create', [RdvController::class, 'create'])->name('rdv.create')->middleware('auth');
Route::post('/rdv/create', [RdvController::class, 'store'])->name('rdv.ajouter')->middleware('auth');
Route::get('/rdv/{rdv}', [RdvController::class, 'edit'])->name('rdv.edit')->middleware('auth');
Route::put('/rdv/{rdv}', [RdvController::class, 'update'])->name('rdv.update')->middleware('auth');
//consultation
Route::get('/consultation/rechercher', [ConsultationController::class, 'rechercher'])->name('consultation.rechercher')->middleware('auth');
Route::get('/consultation/create', [ConsultationController::class, 'create'])->name('consultation.create')->middleware('auth');
Route::post('/consultation/create', [ConsultationController::class, 'store'])->name('consultation.ajouter')->middleware('auth');
Route::get('/consultation/{consultation}', [ConsultationController::class, 'edit'])->name('consultation.edit')->middleware('auth');
Route::put('/consultation/{consultation}', [ConsultationController::class, 'update'])->name('consultation.update')->middleware('auth');
//ordonnance
Route::post('/ordonnance/create', [OrdonnanceController::class, 'store'])->name('ordonnance.ajouter')->middleware('auth');





