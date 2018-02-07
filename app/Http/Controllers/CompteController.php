<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Compte;
class CompteController extends Controller
{
  public function displayAccount(){
    //recupération de l'id de l'utilisateur
     $idUserRecup = DB::table('Utilisateurs')->where('pseudo', session('pseudo'))->get(['id']);
     //récupération de tout les comptes de l'utilisateur stocké dans une variable
     $comptes = Compte::all()->where('idUser', $idUserRecup->first()->id);
     //l'id de l'utilisateur stocké dans une variable de session
     Session::put('idUser',$idUserRecup->first()->id);
     dump(session('idUser'));
     dump(session('pseudo'));
     //affichage de la vue avec envois des variables
     return view('index', compact('idUser','comptes'));
  }

  public function newAccount(){
    $testCompte = DB::table('Comptes')->where('type_account', request('typeCompte'))->where('idUser',request('idUser'))->first();
    //dump($testCompte);
    if($testCompte){
      $error = 'Vous avez déjà un compte de type '.$testCompte->type_account.' ';
      Session::put('error', $error);
      return Redirect::to("http://localhost:8888/siteBanqueLaravel/public/indexComptes");
    }
    else {
      $owner = DB::table('Utilisateurs')->where('id',request('idUser'))->first()->pseudo;
      dump($owner);
      Compte::create([
        'idUser'=>request('idUser'),
        'type_account'=>request('typeCompte'),
        'owner'=>$owner,
        'credit'=>0.93
      ]);
      return Redirect::to("http://localhost:8888/siteBanqueLaravel/public/indexComptes");
    }
  }

  public function deleteAccount(){
    $compte = DB::table('Comptes')->where('id', '=', request('idCompte'))->delete();
    return Redirect::to("http://localhost:8888/siteBanqueLaravel/public/indexComptes");
  }
}
