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
      $this->validate($request, ['pseudoCreation'=>'required'],['pseudoCreation.required'=>'il faut rentrer un nom']);
      $this->validate($request, ['passwordCreation'=>'required'],['passwordCreation.required'=>'il faut rentrer un mot de passe']);
      $this->validate($request, ['mailCreation'=> 'required|email'],['mailCreation.required'=>"tu n'as pas remplit ton mail", 'mailCreation.email' => "ce n'est pas une adresse mail"]);
      $User = DB::table('Utilisateurs')->where("pseudo", request('pseudoCreation'))->first();
//      dump($User);

      if ($User) {
        Session::put('error',"Ce nom d'utilisateur existe déjà");
        return Redirect::to("http://localhost:8888/siteBanqueLaravel/public/");
      }
      else {
        Utilisateur::create([
          'pseudo'=>request('pseudoCreation'),
          'password'=>password_hash(request('passwordCreation'), PASSWORD_BCRYPT),
          'mail'=>request('mailCreation')
        ]);
        Session::put('error','votre compte a été crée avec succès');
        return Redirect::to('http://localhost:8888/siteBanqueLaravel/public/');
      }
    }

    public function Connexion(Request $request){
      //validation des entrées du formulaire
      $this->validate($request, ['pseudoConnexion'=>'required'],['pseudoConnexion.required'=>'donnez votre pseudo']);
      $this->validate($request, ['passwordConnexion'=>'required'],['passwordConnexion.required'=>'rentrez votre mot de passe']);
      //récupération du mot de passe avec le pseudo donnée
      $testPassword = DB::table('Utilisateurs')->where('pseudo', request('pseudoConnexion'))->first();
      dump($testPassword);
      if (!$testPassword) {
        Session::put('error','utilisateur inconnu');
        return Redirect::to("http://localhost:8888/siteBanqueLaravel/public/");
      }
      // vérification du mot de passe donnée à partir du mot de passe récupéré précédemment
      else {
        if (password_verify(request('passwordConnexion'), $testPassword->password)) {
          //stockage du pseudo dans une variable de session
          Session::put('pseudo',request('pseudoConnexion'));
          //redirection vers la page index
          return Redirect::to("http://localhost:8888/siteBanqueLaravel/public/indexComptes");
        }
        else {
          Session::put('error','Le mot de passe est incorrect');
          return Redirect::to("http://localhost:8888/siteBanqueLaravel/public/");
        }
      }
    }
}
