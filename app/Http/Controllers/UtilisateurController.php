<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Utilisateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class UtilisateurController extends Controller
{

    public function createUser(Request $request){
      Utilisateur::validate(request('mailCreation'), ['mailCreation'=> 'required|mail'],['mailCreation.required'=>"tu n'as pas remplit ton mail", 'mailCreation.mail' => "ce n'est pas une adresse mail"]);
      $User = Utilisateur::where("pseudoCreation", request('pseudoConnexion'))->first();
      dd($User);
      // if ($User) {
      //   return Redirect::to("/");
      // }
      // Utilisateur::create([
      //   'pseudo'=>request('pseudoCreation'),
      //   'password'=>request('passwordCreation'),
      //   'mail'=>request('mail')
      // ]);
    }

    public function Connexion(){
      //récupération du mot de passe avec le pseudo donnée
      $testPassword = DB::table('Utilisateurs')->where('pseudo', request('pseudoConnexion'))->get(['password']);
      //vérification du mot de passe donnée à partir du mot de passe récupéré précédemment
      if (password_verify(request('passwordConnexion'), $testPassword->first()->password)) {
        //stockage du pseudo dans une variable de session
        Session::put('pseudo',request('pseudoConnexion'));
        //redirection vers la page index
        return Redirect::to("http://localhost:8888/siteBanqueLaravel/public/indexComptes");
      }
    }
}
