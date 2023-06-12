<?php
use App\Http\Middleware\Authenticate;
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
Route::get('/rdv/sendAppointmentReminders',  [RdvController::class, 'sendAppointmentReminders'])->name('rdv.sendAppointmentReminders');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get('/radiologie/rechercher', [RadiologieController::class, 'rechercher'])->name('radiologie.rechercher');
Route::get('/analyse/create', [AnalyseController::class, 'create'])->name('analyse.create');

Route::get('/pdf/{analyse}', [AnalyseController::class, 'pdf'])->name('analyse.pdf');
Route::get('/pdf/{radiologie}', [RadiologieController::class, 'pdf'])->name('radiologie.pdf');
Route::get('/pdf/{ordonnance}', [OrdonnanceController::class, 'pdf'])->name('export.pdf');

Route::get('/radiologie/create', [RadiologieController::class, 'create'])->name('radiologie.create');


Route::get('/analyse/rechercher', [AnalyseController::class, 'rechercher'])->name('analyse.rechercher');
Route::get('/analyse/{analyse}', [AnalyseController::class, 'edit'])->name('analyse.edit');
Route::put('/analyse/{analyse}', [AnalyseController::class, 'update'])->name('analyse.update');
Route::delete('/analyse/{analyse}', [AnalyseController::class, 'delete'])->name('analyse.supprimer');
Route::get('/analyse', [AnalyseController::class,'index'])->name('analyse');
//radiologie
Route::get('/radiologie/{radiologie}', [RadiologieController::class, 'edit'])->name('radiologie.edit');
Route::put('/radiologie/{radiologie}', [RadiologieController::class, 'update'])->name('radiologie.update');
Route::delete('/radiologie/{radiologie}', [RadiologieController::class, 'delete'])->name('radiologie.supprimer');
Route::get('/radiologie', [RadiologieController::class,'index'])->name('radiologie');

//chatbot
Route::put('/patient/{patient}', [BotManController::class, 'update'])->name('updatePatient');
Route::get('/patient/{patient}', [BotManController::class, 'edit'])->name('editPatient');
Route::get('/demandes/{demande}/valider', [DashboardController::class, 'valider'])->name('validerDemande');
Route::get('/', [BotManController::class, 'register']);
Route::match(['get', 'post'], '/createPatient', [BotManController::class, 'createPatient'])->name('createPatient');
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
Route::get('/hello', [BotManController::class, 'hello'])->name('hello');
//user
Route::get('/user/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
Route::get('/user', [UserController::class,'index'])->name('user');
Route::delete('/user/{user}', [UserController::class, 'delete'])->name('user.supprimer');
//dashbord
Route::get('/calendar', [DashboardController::class, 'getAppointments'])->name('calendar');
Route::get('/appointments-chart', [DashboardController::class, 'getAppointmentsChartData']);
Route::get('/age-chart', [DashboardController::class, 'getAgeChartData']);

Route::get('/patients/{id}/desarchive', [PatientController::class,'désarchive'])->name('patient.desarchive');
Route::get('/ordonnance/rechercher', [OrdonnanceController::class, 'rechercher'])->name('ordonnance.rechercher');
Route::get('/ordonnance/create', [OrdonnanceController::class, 'create'])->name('ordonnance.create');
Route::get('/patients/{id}/archive', [PatientController::class,'archive'])->name('patient.archive');
Route::get('/ordonnance/{ordonnance}', [OrdonnanceController::class, 'showOrdonnance'])->name('ordonnance.show');
//authentification
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/check', [UserController::class, 'check'])->name('check');
//Medecin
Route::get('/medecin', [MedecinController::class,'index'])->name('medecin');
Route::get('/medecin/create', [MedecinController::class, 'create'])->name('medecin.create');
Route::post('/medecin/create', [MedecinController::class, 'store'])->name('medecin.ajouter');
Route::get('/medecin/{medecin}', [MedecinController::class, 'edit'])->name('medecin.edit');
Route::put('/medecin/{medecin}', [MedecinController::class, 'update'])->name('medecin.update');
Route::delete('/medecin/{medecin}', [MedecinController::class, 'delete'])->name('medecin.supprimer');
//patient
Route::get('/patient', [PatientController::class,'index'])->name('patient');
Route::get('/patient/{patient}', [PatientController::class, 'edit'])->name('patient.edit');
Route::put('/patient/{patient}', [PatientController::class, 'update'])->name('patient.update');
Route::delete('/patient/{patient}', [PatientController::class, 'destroy'])->name('patient.supprimer');
Route::get('/{patient}', [PatientController::class,'afficher'])->name('afficherPatient');
//rendez-vous
Route::get('/rdv/rechercher', [RdvController::class, 'rechercher'])->name('rdv.rechercher');
Route::get('/rdv/create', [RdvController::class, 'create'])->name('rdv.create');
Route::post('/rdv/create', [RdvController::class, 'store'])->name('rdv.ajouter');
Route::get('/rdv/{rdv}', [RdvController::class, 'edit'])->name('rdv.edit');
Route::put('/rdv/{rdv}', [RdvController::class, 'update'])->name('rdv.update');
//consultation
Route::get('/consultation/rechercher', [ConsultationController::class, 'rechercher'])->name('consultation.rechercher');
Route::get('/consultation/create', [ConsultationController::class, 'create'])->name('consultation.create');
Route::post('/consultation/create', [ConsultationController::class, 'store'])->name('consultation.ajouter');
Route::get('/consultation/{consultation}', [ConsultationController::class, 'edit'])->name('consultation.edit');
Route::put('/consultation/{consultation}', [ConsultationController::class, 'update'])->name('consultation.update');
//ordonnance
Route::post('/ordonnance/create', [OrdonnanceController::class, 'store'])->name('ordonnance.ajouter');





