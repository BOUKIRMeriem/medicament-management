<?php

namespace App\Http\Controllers;
use App\Models\Consultation;
use App\Models\Rdv;
use Illuminate\Http\Request;

class ConsultationController extends Controller
  { public function index(Request $request)
    {
        $rechercher = false;
    
        $consultations = Consultation::orderBy('date_consultation', 'asc')->paginate(5);
    
        foreach ($consultations as $consultation) {
            if ($consultation->rdv === null) {
                $consultation->delete();
            }
        }
    
        $consultations = Consultation::with('rdv', 'patient')
            ->orderBy('date_consultation', 'asc')
            ->paginate(5);
    
        return view('consultations.masterConsultation', compact('consultations', 'rechercher','request'));
    }
    
       public function create(Request $request)
   {
       $rdvs = Rdv::all();
      
        return view('consultations.createConsultation',compact("rdvs","request"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rdv_id' => 'required',
            'date_consultation' => 'required',
            'type_consultation' => 'required',
            'diagnostic' => 'required',
        ]);

        Consultation::create($request->all());

        return redirect()->route('consultation')->with('success', 'Consultation ajouté avec succés !');
    }


    public function edit(Consultation $consultation,Request $request)
    {    $consultations = Consultation::all();
        return view('consultations.editConsultation', compact('consultation','consultations','request'));
    }


    
    public function update(Request $request, Consultation $consultation)
    {
        $request->validate([
            'rdv_id' => 'required',
            'date_consultation' => 'required',
            'type_consultation' => 'required',
            'diagnostic' => 'required',
        ]);

        $consultation->update($request->all());

        return redirect()->route('consultation')
            ->with('success', 'Consultation updated successfully.');
    }

    public function delete(Consultation $consultation)
    {
        $consultation->delete();

        return redirect()->route('consultation')->with('success', 'Consultation supprimé avec succés !');
            
    }


    
    public function rechercher(Request $request)
    {
        $rechercher = true;
        $nom = $request->input('nom');
        $prenom = $request->input('prenom');
    
        $consultations = Consultation::join('rdvs', 'consultations.rdv_id', '=', 'rdvs.id')
                    ->join('patients', 'rdvs.patient_id', '=', 'patients.id')
                    ->where('patients.nom', 'LIKE', '%'.$nom.'%')
                    ->where('patients.prenom', 'LIKE', '%'.$prenom.'%')
                    ->paginate(5);
    
     
                    return view('consultations.masterConsultation', compact('consultations', 'rechercher','request'));
    }
    
    

}
