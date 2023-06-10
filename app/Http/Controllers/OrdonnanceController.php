<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ordonnance;
use App\Models\Consultation;
use Dompdf\Dompdf;
use PDF;
class OrdonnanceController extends Controller
{
    public function index(Request $request) {
        $rechercher = false;
        
        // Déclaration de la variable $ordonnances
        $ordonnances = Ordonnance::orderBy("medicament", "asc")->paginate(5);
        
        // Supprimer les rendez-vous associés à un patient null
        foreach ($ordonnances as $ordonnance) {
            if ($ordonnance->consultation === null) {
                $ordonnance->delete();
            }
        }
        
        return view('ordonnances.ordonnanceTraitement.masterOrdonnance', compact('ordonnances', 'rechercher','request'));
    }
        public function create(Request $request) {
            $consultations = Consultation::all();
            return view('ordonnances.ordonnanceTraitement.createOrdonnance',compact("consultations","request"));
        }
    
        public function store(Request $request) {
            $request->validate([
                "medicament"=>"required",
                "date"=>"required",
                "dosage"=>"required",
                "nbr_fois"=>"required",
                "qte"=>"required",
                "consultation_id"=>"required"    
            ]);
            Ordonnance::create([
                "medicament"=>$request->medicament,
                "date"=>$request->date,
                "dosage"=>$request->dosage,
                "nbr_fois"=>$request->nbr_fois,
                "qte"=>$request->qte,
                "consultation_id"=>$request->consultation_id
             ]);
             return redirect('/api/ordonnance')->with("success","Ordonnance ajouté succes!");
    
        }

        public function update(Request $request, Ordonnance $ordonnance) {
            $request->validate([
                "medicament"=>"required",
                "date"=>"required",
                "dosage"=>"required",
                "nbr_fois"=>"required",
                "qte"=>"required",
                "consultation_id"=>"required"
           ]);
        $ordonnance->update([
                "medicament"=>$request->medicament,
                "date"=>$request->date,
                "dosage"=>$request->dosage,
                "nbr_fois"=>$request->nbr_fois,
                "qte"=>$request->qte,
                "consultation_id"=>$request->consultation_id
           ]);
           return redirect('/api/ordonnance')->with("success", "Ordonnance mis à jour avec succès!");
        }

        public function edit(Ordonnance $ordonnance,Request $request) {
            $rqts = Ordonnance::all();
            return view('ordonnances.ordonnanceTraitement.editOrdonnance', compact("ordonnance", "rqts","request"));
        }
                 
       
        
        public function delete(Ordonnance $ordonnance)
        {  
            $nom_complet = $ordonnance->consultation->rdv->patient->nom . " " . $ordonnance->consultation->rdv->patient->prenom;
            $ordonnance->delete();
            return back()->with("successDelete", "Ordonnance de '$nom_complet' supprimée avec succès !");
        }

        public function rechercher(Request $request)
{
    $rechercher = true;
    $nom = $request->input('nom');
    $prenom = $request->input('prenom');

    $ordonnances = Ordonnance::join('consultations', 'ordonnances.consultation_id', '=', 'consultations.id')
        ->join('rdvs', 'consultations.rdv_id', '=', 'rdvs.id')
        ->join('patients', 'rdvs.patient_id', '=', 'patients.id')
        ->where('patients.nom', 'LIKE', '%' . $nom . '%')
        ->where('patients.prenom', 'LIKE', '%' . $prenom . '%')
        ->paginate(5);

    return view('ordonnances.ordonnanceTraitement.masterOrdonnance', compact('ordonnances', 'rechercher', 'request'));
}

        

public function showOrdonnance($id,Request $request)
 {
    // Récupérer l'ordonnance à imprimer depuis la base de données
    $ordonnance = Ordonnance::findOrFail($id);

    // Passer les données nécessaires à la vue
    return view('ordonnances.ordonnanceTraitement.imprimerOrdonnance', compact('ordonnance',"request"));
 }
 
 public function pdf($id,Request $request)
{
    $ordonnance = Ordonnance::with('consultation')->findOrFail($id);

    view()->share('ordonnance', $ordonnance);
    $pdf = PDF::loadView('ordonnances.ordonnanceTraitement.pdf_view', compact('ordonnance',"request"));

    return $pdf->download($ordonnance->consultation->rdv->patient->nom . '_' . $ordonnance->consultation->rdv->patient->prenom . '.pdf');
}



    
}
