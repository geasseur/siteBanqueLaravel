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
  public function displayAccounts(){
    //recupération de l'id de l'utilisateur
     $idUserRecup = DB::table('Utilisateurs')->where('pseudo', session('pseudo'))->get(['id']);
     //récupération de tout les comptes de l'utilisateur stocké dans une variable
     $comptes = Compte::all()->where('idUser', $idUserRecup->first()->id);
     //l'id de l'utilisateur stocké dans une variable de session
     Session::put('idUser',$idUserRecup->first()->id);
     // dump(session('idUser'));
     // dump(session('pseudo'));
     //affichage de la vue avec envois des variables
     return view('index', compact('idUser','comptes'));
  }

  public function displayAccount(){
    $otherSelfComptes = DB::table('Comptes')->where('owner',session('pseudo'))->get();
    if (request('idCompte')) {
      //recupération de tout les détails du compte visé par l'id
      $compte = DB::table('Comptes')->where('id', request('idCompte'))->first();
      // retourne la page détail en envoyant les variables nécessaire
      return view('detailCompte')->with('compte', $compte)->with('otherSelfComptes',$otherSelfComptes);
    }
    else {
      $compte = DB::table('Comptes')->where('id', $idCompte)->first();
      return view('detailCompte')->with('compte', $compte)->with('otherSelfComptes',$otherSelfComptes);
    }
  }

  public function newAccount(){
    $testCompte = DB::table('Comptes')->where('type_account', request('typeCompte'))->where('idUser',request('idUser'))->first();
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
    if (request('validationDelete') == 'oui') {
      $compte = DB::table('Comptes')->where('id', '=', request('idCompte'))->delete();
      return Redirect::to("http://localhost:8888/siteBanqueLaravel/public/indexComptes");
    }
    else {
      Session::put('error','vous ne pouvez pas effacer ce compte, car vous n\'avez pas cochez le bouton oui');
      $idCompte = request('idCompte');
      //dd(request('idCompte'));
      return redirect()->action(
    'CompteController@displayAccount', ['idCompte' => $idCompte]
);
    }
  }

  //fonctino pour ajouter argent sur son compte
  public function addMoney(Request $request){
    $this->validate($request, ['newMoney'=>'required|numeric'],['newMoney.required'=>'vous devez rentrer une somme', 'newMoney.numeric '=> 'Vous devez ne rentrer que des chiffres']);
    $credit = DB::table('Comptes')->where('id',request('idCompte'))->first()->credit;
    $credit += request('newMoney');
    DB::table('Comptes')->where('id',request('idCompte'))->update(['credit' => $credit]);
    return redirect()->action(
  'CompteController@displayAccount', ['idCompte' => request('idCompte')]);
  }

  //fonction pour transferer de l'argent à l'un de ses comptes perso
  public function transfertMoney(Request $request){
    if (request('forMe')) {
      $this->validate($request, ['moneyForOther'=>'required|alpha_num'],['moneyForOther.required'=>'vous devez rentrer une somme', 'moneyForOther.alpha_num '=> "Vous devez ne rentrer que des chiffres"]);
      $envoyeur = DB::table('Comptes')->where('id',request('idCompte'))->first()->credit;
      $destinataire = DB::table('Comptes')->where('id',request('idDestinataire'))->first()->credit;
      dump($envoyeur,$destinataire);
      $envoyeur -= request('moneyForMe');
      $destinataire += request('moneyForMe');
      dump($envoyeur,$destinataire);
      DB::table('Comptes')->where('id',request('idCompte'))->update(['credit' => $envoyeur]);
      DB::table('Comptes')->where('id',request('idDestinataire'))->update(['credit' => $destinataire]);
      return redirect()->action(
        'CompteController@displayAccount', ['idCompte' => request('idCompte')]);
    }
    else {
      $envoyeur = DB::table('Comptes')->where('id',request('idCompte'))->first()->credit;
      $destinataire = DB::table('Comptes')->where('id',request('idDestinataire'))->first()->credit;
      //dd($envoyeur, $destinataire);
      $envoyeur -= request('moneyForOther');
      $destinataire += request('moneyForOther');
      dump($envoyeur,$destinataire);
      DB::table('Comptes')->where('id',request('idCompte'))->update(['credit' => $envoyeur]);
      DB::table('Comptes')->where('id',request('idDestinataire'))->update(['credit' => $destinataire]);
      return redirect()->action(
        'CompteController@displayAccount', ['idCompte' => request('idCompte')]);
    }
  }

  public function linkAccount(Request $request){
    $this->validate($request, ['nameUser'=>'required'],['nameUser.required'=>'il faut rentrer un nom']);
    if (request('nameUser') != request('owner')) {
      $otherComptes = DB::table('Comptes')->where('owner', request('nameUser'))->get();
    }
    else {
      Session::put('error' ,"vous ne pouvez pas mettre votre propre nom");
      return redirect()->action(
      'CompteController@displayAccount', ['idCompte' => request('idCompte')]);
    }
    if ($otherComptes->isEmpty()) {
      Session::put('error' ,"il n'y a pas d'utilisateur qui porte ce nom");
      return redirect()->action(
        'CompteController@displayAccount', ['idCompte' => request('idCompte')]);
    }
    else {
      Session::put('trouve', 'trouver');
      Session::put('otherComptes',$otherComptes);
      return redirect()->action('CompteController@displayAccount', ['idCompte' => request('idCompte')]);
    }
  }
}
