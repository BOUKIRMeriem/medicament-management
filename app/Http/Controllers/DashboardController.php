<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Charts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Redirect,Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\Rdv;
use App\Models\DemandeRdv;
use App\Notifications\AppointmentReminder;
use App\Models\Consultation;
use App\Models\Ordonnance;
class DashboardController extends Controller
{
    public function getAppointments()
    {
        $appointments = Rdv::leftJoin('medecins', 'rdvs.medecin_id', '=', 'medecins.id')
            ->select('rdvs.id', 'rdvs.date', 'rdvs.heure', 'rdvs.commentaire', 'medecins.nom AS medecin_name', 'medecins.prenom AS medecin_firstname')
            ->paginate(5);
    
        $formattedAppointments = [];
        foreach ($appointments as $appointment) {
            $formattedAppointment = [
                'title' => $appointment->medecin_firstname . ' ' . $appointment->medecin_name ?? 'N/A',
                'start' => $appointment->date . 'T' . $appointment->heure,
            ];
            
            $formattedAppointments[] = $formattedAppointment;
        }
    
        return response()->json($formattedAppointments);
    }
   
public function dashboard(Request $request)
{
   
    $userId = $request->input('id');
  

    
    $opt = Auth::id();
    $user = User::find($userId);
    $valide = $request->get('valide');
    $totalMedecins = Medecin::query()->count();
    $totalPatients = Patient::query()->count();
    $totalRdvs = Rdv::query()->count();
    $totalConsultations = Consultation::query()->count();
    $totalOrdonnances = Ordonnance::query()->count();  


    $demandes = DemandeRdv::where('valide', false)->orderBy('date', 'asc')->paginate(5);
    return view('layout.dashboard', compact('user','demandes', 'valide',
     'totalMedecins', 'totalPatients', 'totalRdvs',
      'totalConsultations', 'totalOrdonnances','request'));
}

    
    

    public function getAgeChartData()
{
    $patients = Patient::all();
    $ageGroups = [0, 12, 18, 30, 50, 60, 70, 80, 90]; // Groupes d'âge
    $ageData = array_fill(0, count($ageGroups) - 1, 0); // Initialiser les données pour chaque groupe d'âge
     foreach ($patients as $patient) {
        $birthDate = Carbon::parse($patient->date_Naissance);
        $age = $birthDate->diffInYears(Carbon::now());

        // Incrémenter le compteur correspondant au groupe d'âge approprié
        for ($i = 0; $i < count($ageGroups) - 1; $i++) {
            if ($age >= $ageGroups[$i] && $age < $ageGroups[$i + 1]) {
                $ageData[$i]++;
                break;
            }
         }
    }
 return response()->json($ageData);
}
  public function getAppointmentsChartData()
{
    $appointments = Rdv::all();
    $daysOfWeek = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
    $appointmentData = array_fill(0, 7, 0); // Initialiser les données pour chaque jour de la semaine
    $totalDuration = 0;
    $canceledAppointmentsCount = 0;
     foreach ($appointments as $appointment) {
        $dayOfWeek = Carbon::parse($appointment->date)->dayOfWeek;
        $appointmentData[$dayOfWeek]++;
        $totalDuration += $appointment->duration;
        if ($appointment->canceled) {
            $canceledAppointmentsCount++;
        }
    }
    $averageDuration = ($appointments->count() > 0) ? $totalDuration / $appointments->count() : 0;
    $cancellationRate = ($appointments->count() > 0) ? ($canceledAppointmentsCount / $appointments->count()) * 100 : 0;
    return response()->json([
        'labels' => $daysOfWeek,
        'data' => $appointmentData,
        'averageDuration' => $averageDuration,
        'cancellationRate' => $cancellationRate,
    ]);
}

public function valider(DemandeRdv $demande)
{
    // Valider la demande
    $demande->valide = true;
    $demande->save();

    // Ajouter la demande à la table appropriée
    $rdv = new Rdv();
    $rdv->date = $demande->date;
    $rdv->heure = $demande->heure;
    $rdv->duree = '15min'; 
    $rdv->commentaire = 'ffffffffffffff'; 
    $rdv->patient_id = $demande->patient_id;
    $rdv->medecin_id = $demande->medecin_id;
    // Ajoutez d'autres attributs nécessaires à la table de rendez-vous
    $rdv->save();

    // Rediriger ou retourner une réponse appropriée
    return redirect()->back()->with('success', 'Demande validée et ajoutée à la table de rendez-vous.');
}








}
