<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Utilisateur;
use App\Services\ServiceUtilisateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class UtilisateurController extends Controller
{

    public function createUser(Request $request){
      $this->validate($request, ['pseudoCreation'=>'required'],['pseudoCreation.required'=>'il faut rentrer un nom !']);
      $this->validate($request, ['passwordCreation'=>'required'],['passwordCreation.required'=>'il faut rentrer un mot de passe !']);
      $this->validate($request, ['mailCreation'=> 'required|email'],['mailCreation.required'=>"tu n'as pas remplit ton mail", 'mailCreation.email' => "ce n'est pas une adresse mail"]);
      if (ServiceUtilisateur::serviceCreateAccount(request('pseudoCreation'),request('passpasswordCreation'),request('mailCreation'))) {
        return redirect()->route('compte.indexComptesGet');
      }
      else {
        return redirect()->route('utilisateur.connexionPage');
      }
    }

    public function connexion(Request $request){
      //validation des entrées du formulaire
      $this->validate($request, ['pseudoConnexion'=>'required'],['pseudoConnexion.required'=>'donnez votre pseudo']);
      $this->validate($request, ['passwordConnexion'=>'required'],['passwordConnexion.required'=>'rentrez votre mot de passe']);
      if(ServiceUtilisateur::serviceConnexion(request('pseudoConnexion'),request('passwordConnexion'))){
        return redirect()->route('compte.indexComptesGet');
      }
      else {
        return redirect()->route('utilisateur.connexionPage');
      }
    }

    public function deconnexion(){
      Session::forget('pseudo');
      Session::forget('otherComptes');
      session()->forget('pseudo');
      session()->forget('otherComptes');
      return view('indexConnexion');
    }
}
