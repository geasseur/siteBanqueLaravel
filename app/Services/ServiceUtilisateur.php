<?php

namespace App\Services;
use App\Utilisateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ServiceUtilisateur{

  public static function serviceConnexion($pseudoConnexion, $passwordConnexion){
    //récupération du mot de passe avec le pseudo donnée
    $testPassword = DB::table('Utilisateurs')->where('pseudo', $pseudoConnexion)->first();
    //dump($testPassword);
    if (!$testPassword) {
      Session::put('error','utilisateur inconnu');
      return false;
    }
    // vérification du mot de passe donnée à partir du mot de passe récupéré précédemment
    else {
      if (password_verify($passwordConnexion, $testPassword->password)) {
        //stockage du pseudo dans une variable de session
        Session::put('pseudo', $pseudoConnexion);
        //redirection vers la page index
        return true;
      }
      else {
        Session::put('error','Le mot de passe est incorrect');
        return false;
      }
    }
  }

  //service rentrant les donnees dans la bdd
  public static function serviceCreateAccount($pseudo, $password, $mail){
    $User = DB::table('Utilisateurs')->where("pseudo", $pseudo)->first();

    if ($User) {
      Session::put('error',"Ce nom d'utilisateur existe déjà");
      return false;
    }
    else {
      Utilisateur::create([
        'pseudo'=>$pseudo,
        'password'=>password_hash($password, PASSWORD_BCRYPT),
        'mail'=>$mail
      ]);
      Session::put('error','votre compte a été crée avec succès');
      return true;
    }
  }

}

 ?>
