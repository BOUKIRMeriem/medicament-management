<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radiologie;
use App\Models\Consultation;
use Dompdf\Dompdf;
use PDF;
use Illuminate\Support\Facades\Input;
class RadiologieController extends Controller
{
public function index(Request $request) {
        $rechercher = false;
        
        // Déclaration de la variable $ordonnances
        $radiologies = Radiologie::orderBy("date", "asc")->paginate(5);
        
        // Supprimer les rendez-vous associés à un patient null
        foreach ($radiologies as $radiologie) {
            if ($radiologie->consultation === null) {
                $radiologie->delete();
            }
        }
        
        return view('ordonnances.ordonnancesRadiologie.masterRadiologie', compact('radiologies', 'rechercher','request'));
}
public function create(Request $request) {
        $consultations = Consultation::all();
        return view('ordonnances.ordonnancesRadiologie.createRadiologie',compact("consultations","request"));
}
public function store(Request $request) {
        $request->validate([
         
            "date"=>"required",
            "special_instructions"=>"required",
            "consultation_id"=>"required"    
        ]);
        Radiologie::create([
       
            "date"=>$request->date,
            "special_instructions"=>$request->special_instructions,
            "consultation_id"=>$request->consultation_id
         ]);
         return redirect('/radiologie')->with("success","Ordonnance ajouté avec succes!");

}
public function update(Request $request, Radiologie $radiologie) {
        $request->validate([
            "date"=>"required",
            "special_instructions"=>"required",
            "consultation_id"=>"required"  
       ]);
    $radiologie->update([
            
        "date"=>$request->date,
        "special_instructions"=>$request->special_instructions,
        "consultation_id"=>$request->consultation_id
       ]);
       return redirect('/radiologie')->with("success", "Ordonnance mis à jour avec succès!");
}

public function edit(Radiologie $radiologie,Request $request) {
        $rqts = Radiologie::all();
        return view('ordonnances.ordonnancesRadiologie.editRadiologie', compact("radiologie", "rqts","request"));
}
public function delete(Radiologie $radiologie)
    {  
        $nom_complet = $radiologie->consultation->rdv->patient->nom . " " . $radiologie->consultation->rdv->patient->prenom;
        $radiologie->delete();
        return back()->with("successDelete", "Ordonnance de '$nom_complet' supprimée avec succès !");
    }

public function rechercher(Request $request)
{
    $rechercher = true;
    $nom = $request->input('nom');
    $prenom = $request->input('prenom');

    $radiologies = Radiologie::join('consultations', 'radiologies.consultation_id', '=', 'consultations.id')
    ->join('rdvs', 'consultations.rdv_id', '=', 'rdvs.id')
    ->join('patients', 'rdvs.patient_id', '=', 'patients.id')
    ->where('patients.nom', 'LIKE', '%' . $nom . '%')
    ->where('patients.prenom', 'LIKE', '%' . $prenom . '%')
    ->paginate(5);

    return view('ordonnances.ordonnancesRadiologie.masterRadiologie', compact('radiologies', 'rechercher', 'request'));
}
public function showOrdonnance($id, Request $request)
{   
    // Récupérer l'ordonnance à imprimer depuis la base de données
    $radiologie = Radiologie::findOrFail($id);
    return view('ordonnances.ordonnancesRadiologie.imprimerRadiologie', compact('radiologie', 'request'));
}
public function pdf($id, Request $request)
{
    $radiologie = Radiologie::with('consultation')->findOrFail($id);


    $pdf = PDF::loadView('ordonnances.ordonnancesRadiologie.pdfRadiologie', compact('radiologie'));

    return $pdf->download($radiologie->consultation->rdv->patient->nom . '_' . $radiologie->consultation->rdv->patient->prenom . '.pdf');
}
}
