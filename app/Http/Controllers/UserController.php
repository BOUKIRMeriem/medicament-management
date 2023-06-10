<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotification;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{  
public function login(){
         return view('authentification.login');
}
  
public function check(Request $request){
    $request->validate([ 
        'username' => 'required',
        'mot_de_passe' => 'required',
    ]);

    $user = DB::selectOne('SELECT * FROM users WHERE username = ? LIMIT 1', [$request->username]);

    if ($user) {
        if (Hash::check($request->mot_de_passe, $user->mot_de_passe)) {
                $request->session()->put('loggedUser',$user->id);
             
                return redirect('/dashboard?id='.$user->username);
            }else{
                return back()->with('fail','Mot de passe invalide');
            }
        }else{
            return back()->with('fail','aucun compte trouvé pour cette connexion');
        }
}
   
public function index(Request $request)
{
    $rechercher = false;
    $users = User::orderBy("username", "asc")->get();
    return view('users.masterUser', compact('users', 'rechercher','request'));
}
public function delete(User $user)
{  
    $nom_complet= $user->nom." ".$user->prenom;
    $user->delete();
    return back()->with("successDelete", "User ' $nom_complet' supprimé avec succès !");
}
public function rechercher(Request $request)
        {
            $rechercher = true;
            $username  = $request->input('username');
            $users = User::where('username', 'LIKE', '%'.$username.'%')->get();
                                 
              return view('users.masterUser', compact('users', 'rechercher','request'));
        }
public function create(Request $request)
{
        
          return view('users.createUser', compact("request"));
}
public function store(Request $request) {
            $request->validate([
                "username"=>"required",
                'email' => 'required|email|unique:users|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
                "telephone"=>"required",
                "role"=>"required",
                'mot_de_passe' => 'required|min:5|max:12'
            ]);
             User::create([
                "username"=>$request->username,
                "email"=>$request->email,
                "telephone"=>$request->telephone,
                "role"=>$request->role,
                "mot_de_passe" => Hash::make($request->input('mot_de_passe'))

          
            ]);
        
            return redirect('/user')->with("success", "User ajouté avec succès!");
           
}

public function edit(User $user,Request $request) {
            $rqts = User::all();
            return view('users.editUser', compact("user", "rqts","request"));
}
                 
public function update(Request $request, User $user) {
            $request->validate([
                "username"=>"required",
                'email' => 'required|email|unique:users|regex:/^[A-Za-z0-9._%+-]+@gmail\.com$/',
                "telephone"=>"required",
                "role"=>"required",
                "mot_de_passe"=>"required",
                "mutuelle"=>"required"
            ]);
        
            $user->update([
                "username"=>$request->username,
                "email"=>$request->email,
                "telephone"=>$request->telephone,
                "role"=>$request->role,
                "mot_de_passe" => Hash::make($request->input('mot_de_passe')),
                "mutuelle"=>$request->mutuelle
            ]);
            return redirect('/user')->with("success","User mis à jour avec succès!");
}
}

