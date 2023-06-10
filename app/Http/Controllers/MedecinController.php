<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medecin;
use App\Models\Consultation;
class MedecinController extends Controller
{
    public function index(Request $request) {
        $rechercher = false;
        $medecins = Medecin::orderBy("nom", "asc")->paginate(5);
        return view('medecins.masterMedecin', compact('medecins', 'rechercher', 'request'));
    }
    

     public function create(Request $request) {
            $medecins = Medecin::all();
            return view('medecins.createMedecin',compact("medecins","request"));
        }
    
        public function store(Request $request) {
            $request->validate([
                "nom"=>"required",
                "prenom"=>"required",
                'email' => 'required|email|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
                "telephone"=>"required",
                "specialite"=>"required"
            ]);
             Medecin::create([
                "nom"=>$request->nom,
                "prenom"=>$request->prenom,
                "email"=>$request->email,
                "telephone"=>$request->telephone,
                "specialite"=>$request->specialite
            ]);
        
            return redirect('/medecin')->with("success", "Médecin ajouté avec succès!");
           
        }
        public function edit(Medecin $medecin, Request $request) {
            $rqts = Medecin::all();
            return view('medecins.editMedecin', compact("medecin", "rqts","request"));
        }
                 
        public function update(Request $request, Medecin $medecin) {
            $request->validate([
                "nom"=>"required",
                "prenom"=>"required",
                'email' => 'required|email|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
                "telephone"=>"required",
                "specialite"=>"required"
            ]);
        
            $medecin->update([
                "nom"=>$request->nom,
                "prenom"=>$request->prenom,
                "email"=>$request->email,
                "telephone"=>$request->telephone,
                "specialite"=>$request->specialite
            ]);
            return redirect('/medecin')->with("success","Medecin mis à jour avec succès!");
        }
        public function delete(Medecin $medecin)
        {  
            $nom_complet= $medecin->nom." ".$medecin->prenom;
            $medecin->delete();
            return back()->with("successDelete", "Medecin ' $nom_complet' supprimé avec succès !");
        }
        public function rechercher(Request $request)
        {
            $rechercher = true;
            $nom = $request->input('nom');
            //$prenom = $request->input('prenom');
        
            $medecins = Medecin::where('nom', 'LIKE', '%'.$nom.'%')
                                 ->paginate(5);
        
            return view('medecins.masterMedecin', compact('medecins', 'rechercher','request'));
        }
        public function historiqueConsultation(Medecin $medecin,Request $request )
        {
            $consultations = $medecin->consultations()->get();
        
            return view('medecins.historiqueConsultation', compact('medecin', 'consultations','request'));
        }
        
        

        

}

