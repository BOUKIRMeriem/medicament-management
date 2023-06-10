<?php

namespace App\Http\Controllers;
use BotMan\BotMan\BotMan;
use App\Models\Patient;
use App\Models\DemandeRdv;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BotManController extends Controller
{


    public function handle()
    {
        $botman = app("botman");
        $botman->hears("{message}", function($botman, $message) {
            if ($message == "salut") {
                $this->ask($botman);
            } else {
                $botman->reply("Veuillez écrire 'salut' pour démarrer la conversation.");
            }
        });
        $botman->listen();
    }
    
    public function ask($botman)
    {
        $patientId = session('patientId');
     
        $botman->ask("Salut! Voulez-vous connaître les heures d'ouverture du cabinet et les informations sur les médecins ?", function ($answer, $botman) {
            $response = strtolower($answer->getText());
    
            if (strpos($response, "oui") !== false) {
                $botman->say(" Les heures d'ouverture du cabinet sont de 9h à 18h du lundi au vendredi.");
    
                $medecins = DB::table('medecins')->get();
    
                if ($medecins->isEmpty()) {
                    $botman->say("Désolé, aucune information sur les médecins n'est disponible pour le moment.");
                } else {
                    $botman->say("Nous avons un médecin :");
                    foreach ($medecins as $medecin) {
                        $botman->say("Du nom de " . $medecin->nom . " " . $medecin->prenom . ", spécialisé en " . $medecin->specialite);
                    }
                }
    
                $botman->ask("Souhaitez-vous prendre un rendez-vous ?", function ($answer, $botman) {
                    $response = strtolower($answer->getText());
    
                    if (strpos($response, "oui") !== false) {
                        $botman->ask("Donnez le nom et prénom du médecin qui vous intéresse pour prendre rendez-vous.", function ($answer, $botman) {
                            $name = $answer->getText();
                            $nameParts = explode(' ', $name);
                            $medecinNom = '';
                            $medecinPrenom = '';
    
                            foreach ($nameParts as $part) {
                                $medecin = DB::table('medecins')
                                    ->where(function ($query) use ($part) {
                                        $query->where('nom', 'like', '%' . $part . '%')
                                            ->orWhere('prenom', 'like', '%' . $part . '%');
                                    })
                                    ->first();
    
                                if ($medecin) {
                                    $botman->ask("Quelle date et à quelle heure souhaitez-vous prendre rendez-vous avec le Dr. {$medecin->nom} {$medecin->prenom} ?", function ($answer, $botman) use ($name, $medecin) {
                                        $datetime = $answer->getText();
                                        $datetimeParts = explode(' ', $datetime);
    
                                        if (count($datetimeParts) !== 2) {
                                            $botman->repeat("Désolé, je n'ai pas compris. Veuillez donner à la fois la date et l'heure du rendez-vous.");
                                            return;
                                        }
    
                                        $date = $datetimeParts[0];
                                        $time = $datetimeParts[1];
    
                                        // Vérifier si le rendez-vous existe dans la table "rdvs"
                                        $rendezVous = DB::table('rdvs')
                                            ->where('medecin_id', $medecin->id)
                                            ->where('date', $date)
                                            ->where('heure', $time)
                                            ->first();
    
                                        // Vérifier si le rendez-vous existe dans la table "demande_rdvs"
                                        $rendezVousDemande = DB::table('demande_rdvs')
                                            ->where('medecin_id', $medecin->id)
                                            ->where('date', $date)
                                            ->where('heure', $time)
                                            ->first();
    
                                        if ($rendezVous) {
                                            $botman->ask("Veuillez indiquer le statut (urgent ou normal) :", function ($answer, $botman) use ($name, $date, $time, $medecin) {
                                                $statut = strtolower($answer->getText());
    
                                                if (strpos($statut, "urgent") !== false ) {
                                                    $botman->say("Votre rendez-vous avec le Dr. {$medecin->nom} {$medecin->prenom} le {$date} à {$time} a été enregistré avec succès !");
                                                    $botman->say("Veuillez attendre l'appel de confirmation le plus tôt possible, bonne chance.");
                                                    DB::table('demande_rdvs')->insert([
                                                        'date' => $date,
                                                        'heure' => $time,
                                                        'statut' => $statut,
                                                        'patient_id' => session('patientId'),
                                                        'medecin_id' => $medecin->id
                                                    ]);
                                                } else {
                                                    $botman->say("Désolé, ce rendez-vous est déjà pris. Veuillez choisir une autre date et heure.");
                                                }
                                            });
                                        } elseif ($rendezVousDemande) {
                                            $botman->ask("Veuillez indiquer le statut (urgent ou normal) :", function ($answer, $botman) use ($name, $date, $time, $medecin) {
                                                $statut = strtolower($answer->getText());
    
                                                if (strpos($statut, "urgent") !== false ) {
                                                    $botman->say("Votre rendez-vous avec le Dr. {$medecin->nom} {$medecin->prenom} le {$date} à {$time} a été enregistré avec succès !");
                                                    $botman->say("Veuillez attendre l'appel de confirmation le plus tôt possible, bonne chance.");
                                                    DB::table('demande_rdvs')->insert([
                                                        'date' => $date,
                                                        'heure' => $time,
                                                        'statut' => $statut,
                                                        'patient_id' => session('patientId'),
                                                        'medecin_id' => $medecin->id
                                                    ]);
                                                } else {
                                                    $botman->say("Désolé, ce rendez-vous est déjà demandé.");
                                                }
                                            });
                                        } else {
                                            $botman->ask("Veuillez indiquer le statut (urgent ou normal) :", function ($answer, $botman) use ($name, $date, $time, $medecin) {
                                                $statut = strtolower($answer->getText());
    
                                                if (strpos($statut, "urgent") !== false || strpos($statut, "normal") !== false) {
                                                    $botman->say("Votre rendez-vous avec le Dr. {$medecin->nom} {$medecin->prenom} le {$date} à {$time} a été enregistré avec succès !");
                                                    $botman->say("Veuillez attendre l'appel de confirmation le plus tôt possible, bonne chance.");
                                                    DB::table('demande_rdvs')->insert([
                                                        'date' => $date,
                                                        'heure' => $time,
                                                        'statut' => $statut,
                                                        'patient_id' => session('patientId'),
                                                        'medecin_id' => $medecin->id
                                                    ]);
                                                } else {
                                                    $botman->repeat("Désolé, je n'ai pas compris. Veuillez indiquer le statut en tant que 'urgent' ou 'normal'.");
                                                }
                                            });
                                        }
                                    });
                                    break;
                                }
                            }
    
                            if (!$medecin) {
                                $botman->say("Désolé, je n'ai pas trouvé de médecin avec ce nom et prénom.");
                            }
                        });
                    } elseif(strpos($response, "non") !== false) {
                        $botman->say("D'accord, si vous avez d'autres questions, n'hésitez pas à demander !");
                    }else{
                        $botman->say("Désolé, je n'ai pas compris.");

                    }
                    
                });
            } elseif(strpos($response, "non") !== false) {
                $botman->say("D'accord, si vous avez d'autres questions, n'hésitez pas à demander !");
            }else{
                $botman->say("Désolé, je n'ai pas compris.");

            }
        });
    }
    

//interface
public function hello(Request $request)
{
    $patientId = $request->input('id');
    session(['patientId' => $patientId]);
    $patient = Patient::find($patientId);
    return view('chatbot.hello', compact('patient','request'));
}

//register
public function register(Request $request)
{
    $patientId = $request->input('patient_id'); // Valeur par défaut si le champ patient_id n'est pas présent dans la requête

    return view('chatbot.registerPatient')->with('patientId', $patientId);
}
//create
public function createPatient(Request $request)
{
    $request->validate([
        "cin" => "required",
        "nom" => "required",
        "prenom" => "required",
        "date_Naissance" => "required",
        "adresse" => "required",
        "telephone" => "required",
        "adresse_Email" => 'required|email|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
        "sexe" => "required",
        "mutuelle"=>"required"
    ]);

    // Vérifier si un enregistrement avec le même numéro CIN existe déjà
    $patient = Patient::firstOrCreate([
        "cin" => $request->cin
    ], [
        "nom" => $request->nom,
        "prenom" => $request->prenom,
        "date_Naissance" => $request->date_Naissance,
        "adresse" => $request->adresse,
        "telephone" => $request->telephone,
        "adresse_Email"=>$request->adresse_Email,
        "sexe" => $request->sexe,
        "mutuelle"=>$request->mutuelle
    
    ]);

    $patientId = $request->input('patient_id');
    $jsCode = "<script>localStorage.setItem('key', '$patientId');</script>";
    if ($patient->wasRecentlyCreated) {
        $patientId = $patient->id;
        return redirect('/hello?id=' . $patientId); // Redirection avec l'ID en tant que paramètre
    } else {
        $patientId = $patient->id; // Récupération de l'ID du patient existant
        return redirect('/hello?id=' . $patientId);
    }
}

//modifier
public function edit(Patient $patient) {
    $patient = Patient::findOrFail($patient->id);
    $rqts = Patient::all();
    return view('chatbot.edit',compact("patient", "rqts"));
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
    
    return redirect('hello?id=' .$patient->id)->with(['patient' => $patient->id],"success","Patient mis à jour avec succès!");
}

    
}
