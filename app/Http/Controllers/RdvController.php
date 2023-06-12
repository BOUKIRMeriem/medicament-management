<?php

namespace App\Http\Controllers;
use App\Models\Rdv;
use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Http\Request;
use App\Services\AppointmentReminderService;
use App\Mail\AppointmentReminderMail;
class RdvController extends Controller
{
    public function index(Request $request)
    {
        $aujourdhui = $request->query('aujourdhui');
    
        if ($aujourdhui == "true") {
            $rdvs = Rdv::with('patient', 'medecin')
                ->whereDate('date', '=', date('Y-m-d'))
                ->paginate(5);
            $totalRdvs = $rdvs->count();
            return view('rdvs.masterRdv', compact("rdvs", "totalRdvs", "aujourdhui","request"));
        } else {
            $rechercher = false;
            $rdvs = Rdv::orderBy("date", "asc")->paginate(5);
            foreach ($rdvs as $rdv) {
                if ($rdv->medecin === null || $rdv->patient === null) {
                    $rdv->delete();
                }
            }
            $rdvs = Rdv::with('patient', 'medecin')
                ->orderBy('date', 'asc')
                ->orderBy('heure', 'asc')
                ->paginate(5);
    
            return view('rdvs.masterRdv', compact('rdvs', 'rechercher',"request"));
        }
    }
        public function create(Request $request) {
            $patients = Patient::all();
            $medecins = Medecin::all();
          return view('rdvs.createRdv',compact("patients","medecins","request"));
        }
        public function store(Request $request)
{
    $validator = $request->validate([
        "date" => "required",
        "heure" => [
            "required",
            function($attribute, $value, $fail) use ($request) {
                $rdv = Rdv::where("date", $request->date)
                          ->where("heure", $value)
                          ->where("medecin_id", $request->medecin_id)
                          ->first();
                if ($rdv) {
                    $fail("Il y a déjà un rendez-vous à cette date et heure pour ce médecin.");
                }
            }
        ],
        "duree" => "required",
        "commentaire" => "required",
        "patient_id" => "required",
        "medecin_id" => "required"
    ]);

    Rdv::create([
        "date" => $request->date,
        "heure" => $request->heure,
        "duree" => $request->duree,
        "commentaire" => $request->commentaire,
        "patient_id" => $request->patient_id,
        "medecin_id" => $request->medecin_id
    ]);

    return redirect('api/rdv')->with("success", "Rendez-vous ajouté avec succès!");
}

        
        
        public function edit(Rdv $rdv,Request $request) {
            $rdvs = Rdv::all();
            return view('rdvs.editRdv', compact("rdv", "rdvs","request"));
        }
                 
        public function update(Request $request, Rdv $rdv)
        {
            $request->validate([
                "date" => "required",
                "heure" => "required",
                "duree" => "required",
                "commentaire" => "required",
                "patient_id" => "required",
                "medecin_id" => "required"
            ]);
        
            $existingRdv = Rdv::where('date', $request->date)
                               ->where('heure', $request->heure)
                               ->where('medecin_id', $request->medecin_id)
                               ->where('id', '!=', $rdv->id)
                               ->first();
        
            if ($existingRdv) {
                return redirect()->back()->withErrors(['msg' => 'Un rendez-vous existe déjà à cette heure et date pour ce médecin.']);
            }
        
            $rdv->update([
                "date" => $request->date,
                "heure" => $request->heure,
                "duree" => $request->duree,
                "commentaire" => $request->commentaire,
                "patient_id" => $request->patient_id,
                "medecin_id" => $request->medecin_id
            ]);
        
            return redirect('/api/rdv')->with("success", "Rendez-vous mis à jour avec succès!");
        }
        
        

        public function delete(Rdv $rdv)
{  
              if ($rdv->patients != null) {
               $nom_complet = $rdv->patients->nom." ".$rdv->patients->prenom;
             }else {
                $nom_complet = "N/A";
           }
    
             $rdv->delete();
               return back()->with("successDelete", "Rendez-vous '$nom_complet' supprimé avec succès !");
}

public function rechercher(Request $request)
{
    $rechercher = true;
    $nom = $request->input('nom');
    $prenom = $request->input('prenom');

    $rdvs = Rdv::join('patients', 'rdvs.patient_id', '=', 'patients.id')
                ->where('patients.nom', 'LIKE', '%'.$nom.'%')
                ->where('patients.prenom', 'LIKE', '%'.$prenom.'%')
                ->paginate(5);

    return view('rdvs.masterRdv', compact('rdvs', 'rechercher',"request"));
}

private $appointmentReminderService;

      public function __construct(AppointmentReminderService $appointmentReminderService)
    {
        $this->appointmentReminderService = $appointmentReminderService;
    }

     public function sendAppointmentReminders()
    {
        $this->appointmentReminderService->sendAppointmentReminders();
        return "Notifications de rappel de rendez-vous envoyées avec succès.";
    }

}   
   
