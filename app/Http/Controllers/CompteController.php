<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\deleteAccountFormRequest;
use App\Http\Requests\TransfertMoneyForMeFormRequest;
use App\Http\Requests\TransfertMoneyForOtherFormRequest;
use App\Http\Requests\LinkFormRequest;
use App\Http\Requests\NewMoneyFormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Compte;
use App\Services\ServiceCompte;
class CompteController extends Controller
{
  public function displayAccounts(){
    //recupération de l'id de l'utilisateur
     $idUserRecup = DB::table('Utilisateurs')->where('pseudo', session('pseudo'))->get(['id']);
     //récupération de tout les comptes de l'utilisateur stocké dans une variable
     $comptes = Compte::all()->where('idUser', $idUserRecup->first()->id);
     //l'id de l'utilisateur stocké dans une variable de session
     Session::put('idUser',$idUserRecup->first()->id);
     //affichage de la vue avec envois des variables
     return view('index', compact('idUser','comptes'));
  }

  public function displayAccount($id){
     // if ($id) {
       $otherSelfComptes = DB::table('Comptes')->where('owner',session('pseudo'))->where('id','!=',$id)->get();
      //recupération de tout les détails du compte visé par l'id
      $compte = DB::table('Comptes')->where('id', $id)->first();
      //retourne la page détail en envoyant les variables nécessaire
      return view('detailCompte')->with(compact(['otherSelfComptes','compte']));
  }

  public function newAccount(){
    $testCompte = DB::table('Comptes')->where('type_account', request('typeCompte'))->where('idUser',request('idUser'))->first();
    if($testCompte){
      $error = 'Vous avez déjà un compte de type '.$testCompte->type_account.' ';
      Session::put('error', $error);
      return redirect()->route('compte.indexComptesGet');
    }
    else {
      ServiceCompte::createAccountService(request('idUser'), request('typeCompte'));
      return redirect()->route('compte.indexComptesGet');
    }
  }

  //test delete avec formRequest
  public function deleteAccount(deleteAccountFormRequest $request, $id){
    $compte = DB::table('Comptes')->where('id', '=', $id)->delete();
    return redirect()->route('compte.indexComptesGet');
  }

  public function addMoney(NewMoneyFormRequest $request, $id){
      ServiceCompte::addMoneyService($id, request('newMoney'));
      //dd($id);
      return redirect()->route('compte.returnDetailPage', ['id' => $id]);
  }

  public function transfertMoneyMyself(TransfertMoneyForMeFormRequest $request,$id){
    //Partie pour le formulaire de transfert entre les comptes du même utilisateur
      ServiceCompte::transfertMoneyService($id, request('idDestinataire'), request('moneyForMe'));
      return redirect()->action('CompteController@displayAccount', ['id' => $id]);
  }

  public function transfertMoneyOther(TransfertMoneyForOtherFormRequest $request,$id){
    ServiceCompte::transfertMoneyService($id, request('idDestinataire'), request('moneyForOther'));
    return redirect()->action(
      'CompteController@displayAccount', ['id' => $id]);
  }

  public function linkAccount(LinkFormRequest $request, $id, $owner){
    // //Verifier si l'utilisateur et le compte cherché ne sont pas les même
    if (request('nameUser') != $owner) {
      $otherComptes = DB::table('Comptes')->where('owner', request('nameUser'))->get();
    }
    else {
      Session::put('error' ,"vous ne pouvez pas mettre votre propre nom");
      return redirect()->action(
      'CompteController@displayAccount', ['id' => $id ]);
    }
    //Verifie si il trouve un utilisateur portant le nom cherché
    $otherComptes = DB::table('Comptes')->where('owner', request('nameUser'))->get();
    if ($otherComptes->isEmpty()) {
      Session::put('error' ,"il n'y a pas d'utilisateur qui porte ce nom");
      return redirect()->action(
        'CompteController@displayAccount', ['id' => $id]);
    }
    else {
      Session::put('trouve', 'trouver');
      Session::forget('otherComptes');
      Session::put('otherComptes',$otherComptes);
      return redirect()->action('CompteController@displayAccount', ['id' => $id]);
    }
  }
}
