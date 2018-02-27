<?php
namespace App\Services;
use App\Compte;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ServiceCompte{
  public static function createAccountService($idUser, $typeCompte){
    $owner = DB::table('Utilisateurs')->where('id',$idUser)->first()->pseudo;
    Compte::create([
      'idUser'=>$idUser,
      'type_account'=>$typeCompte,
      'owner'=>$owner,
      'credit'=>0.93
    ]);
  }

  public static function transfertMoneyService($idCompte, $idDestinataire, $moneyForMe){
    $envoyeur = DB::table('Comptes')->where('id',$idCompte)->first()->credit;
    $destinataire = DB::table('Comptes')->where('id',$idDestinataire)->first()->credit;
    $envoyeur -= $moneyForMe;
    $destinataire += $moneyForMe;
    DB::table('Comptes')->where('id',$idCompte)->update(['credit' => $envoyeur]);
    DB::table('Comptes')->where('id',$idDestinataire)->update(['credit' => $destinataire]);
  }

  public static function addMoneyService($idCompte, $newMoney){
    $credit = DB::table('Comptes')->where('id', $idCompte)->first()->credit;
    $credit += $newMoney;
    DB::table('Comptes')->where('id',$idCompte)->update(['credit' => $credit]);
  }
}

?>
