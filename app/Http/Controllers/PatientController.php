<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;


class PatientController extends Controller
{     
    public function index(Request $request)
    {
        $archive = $request->get('archive');
        
        if ($archive == true) {
            $rechercher = false;
            $patients = Patient::where('archiver', true)->orderBy('nom', 'asc')->paginate(5);
            return view('patients.masterPatient', compact('patients', 'rechercher', 'archive','request'));
        } else {
            $archive = false;
            $rechercher = false;
            $patients = Patient::where('archiver', false)->orderBy('nom', 'asc')->paginate(5);
            return view('patients.masterPatient', compact('patients', 'rechercher', 'archive','request'));
        }
    }
public function archive($id)
{
    $patient = Patient::findOrFail($id);
    $patient->archiver = true;
    $patient->save();

    return redirect('/patient')->with("success","Patient archivée avec succes!");
} 
public function désarchive($id)
{
    $patient = Patient::findOrFail($id);
    $patient->archiver = false;
    $patient->save();

    return redirect('/patient')->with("success","Patient désarchivée avec succes!");
} 

      
        public function create(Request $request) {
            $patients = Patient::all();
            return view('patients.createPatient',compact("patients","request"));
        }
    
        public function store(Request $request) {
            $request->validate([
                "cin"=>"required",
                "nom"=>"required",
                "prenom"=>"required",
                "date_Naissance"=>"required",
                "adresse"=>"required",
                "telephone"=>"required",
                "adresse_Email" => 'required|email|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
                "sexe"=>"required",
                "mutuelle"=>"required"
            ]);
             Patient::create([
                "cin"=>$request->cin,
                "nom"=>$request->nom,
                "prenom"=>$request->prenom,
                "date_Naissance"=>$request->date_Naissance,
                "adresse"=>$request->adresse,
                "telephone"=>$request->telephone,
                "adresse_Email"=>$request->adresse_Email,
                "sexe"=>$request->sexe,
                "mutuelle"=>$request->mutuelle
            ]);

             return redirect('/patient')->with("success","Patient ajouté avec succes!");
    
        }
        public function edit(Patient $patient,Request $request) {
            $rqts = Patient::all();
            return view('patients.editPatient', compact("patient", "rqts","request"));
        }
        public function afficher(Patient $patient,Request $request) {
            $rqts = Patient::all();
            return view('patients.afficherPatient', compact("patient", "rqts","request"));
        }
                 
        public function update(Request $request, Patient $patient) {
            $request->validate([
                "cin"=>"required",
                "nom"=>"required",
                "prenom"=>"required",
                "date_Naissance"=>"required",
                "adresse"=>"required",
                "telephone"=>"required",
                "adresse_Email" => 'required|email|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
                "sexe"=>"required",
                "mutuelle"=>"required"
            ]);
        
            $patient->update([
                "cin"=>$request->cin,
                "nom"=>$request->nom,
                "prenom"=>$request->prenom,
                "date_Naissance"=>$request->date_Naissance,
                "adresse"=>$request->adresse,
                "telephone"=>$request->telephone,
                "adresse_Email"=>$request->adresse_Email,
                "sexe"=>$request->sexe,
                "mutuelle"=>$request->mutuelle
            ]);
            
         return redirect('/patient')->with("success","Patient mis à jour avec succès!");
        }
        
        public function destroy($id)
        {
            $patient = Patient::findOrFail($id);
            $nom_complet = $patient->nom . " " . $patient->prenom;
            $patient->delete();
            return back()->with("successDelete", "Patient '$nom_complet' supprimé avec succès !");
        }
        
        public function rechercher(Request $request)
        {
            $rechercher = true;
            $nom = $request->input('nom');
            $prenom = $request->input('prenom');
        
            $patients = Patient::where('nom', 'LIKE', '%'.$nom.'%')
                                 ->where('prenom', 'LIKE', '%'.$prenom.'%')
                                 ->paginate(5);
        
            return view('patients.masterPatient', compact('patients', 'rechercher','request'));
        }
    
       

}
