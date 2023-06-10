<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analyse;
use App\Models\Consultation;
use Dompdf\Dompdf;
use PDF;
class AnalyseController extends Controller
{
public function index(Request $request) {
        $rechercher = false;
        
        // Déclaration de la variable $ordonnances
        $analyses = Analyse::orderBy("date", "asc")->paginate(5);
        
        // Supprimer les rendez-vous associés à un patient null
        foreach ($analyses as $analyse) {
            if ($analyse->consultation === null) {
                $analyse->delete();
            }
        }
        
        return view('ordonnances.ordonnanceAnalyse.masterAnalyse', compact('analyses', 'rechercher','request'));
}
public function create(Request $request) {
        $consultations = Consultation::all();
        return view('ordonnances.ordonnanceAnalyse.createAnalyse',compact("consultations","request"));
}
public function store(Request $request) {
        $request->validate([
         
            "date"=>"required",
            "special_instructions"=>"required",
            "consultation_id"=>"required"    
        ]);
        Analyse::create([
       
            "date"=>$request->date,
            "special_instructions"=>$request->special_instructions,
            "consultation_id"=>$request->consultation_id
         ]);
         return redirect('/analyse')->with("success","Ordonnance ajouté avec succes!");
 }
public function update(Request $request, Analyse $analyse) {
        $request->validate([
            "date"=>"required",
            "special_instructions"=>"required",
            "consultation_id"=>"required"  
       ]);
    $analyse->update([
            
        "date"=>$request->date,
        "special_instructions"=>$request->special_instructions,
        "consultation_id"=>$request->consultation_id
       ]);
       return redirect('/analyse')->with("success", "Ordonnance mis à jour avec succès!");
    }

public function edit(Analyse $analyse,Request $request) {
        $rqts = Analyse::all();
        return view('ordonnances.ordonnanceAnalyse.editAnalyse', compact("analyse", "rqts","request"));
}
public function delete(Analyse $analyse)
    {  
        $nom_complet = $analyse->consultation->rdv->patient->nom . " " . $analyse->consultation->rdv->patient->prenom;
        $analyse->delete();
        return back()->with("successDelete", "Ordonnance de '$nom_complet' supprimée avec succès !");
    }

public function rechercher(Request $request)
{
    $rechercher = true;
    $nom = $request->input('nom');
    $prenom = $request->input('prenom');

        $analyses = Analyse::join('consultations', 'analyses.consultation_id', '=', 'consultations.id')
        ->join('rdvs', 'consultations.rdv_id', '=', 'rdvs.id')
        ->join('patients', 'rdvs.patient_id', '=', 'patients.id')
        ->where('patients.nom', 'LIKE', '%' . $nom . '%')
        ->where('patients.prenom', 'LIKE', '%' . $prenom . '%')
        ->paginate(5);

    return view('ordonnances.ordonnanceAnalyse.masterAnalyse', compact('analyses', 'rechercher', 'request'));
}
public function showOrdonnance($id, Request $request)
{
    // Récupérer l'ordonnance à imprimer depuis la base de données
    $analyse = Analyse::findOrFail($id);
    return view('ordonnances.ordonnanceAnalyse.imprimerAnalyse', compact('analyse','request'));
}


public function pdf($id,Request $request)
{
    $analyse = Analyse::with('consultation')->findOrFail($id);

   
    $pdf = PDF::loadView('ordonnances.ordonnanceAnalyse.pdfAnalyse', compact('analyse'));

    return $pdf->download($analyse->consultation->rdv->patient->nom . '_' . $analyse->consultation->rdv->patient->prenom . '.pdf');
}
}

