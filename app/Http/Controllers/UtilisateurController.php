<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Utilisateur;
use App\Services\ServiceUtilisateur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\indexConnexionFormRequest;
use App\Http\Requests\creationUserFormRequest;
class UtilisateurController extends Controller
{

    public function createUser(creationUserFormRequest $request){
      if (ServiceUtilisateur::serviceCreateAccount(request('pseudoCreation'),request('passpasswordCreation'),request('mailCreation'))) {
        return redirect()->route('compte.indexComptesGet');
      }
      else {
        return redirect()->route('utilisateur.connexionPage');
      }
    }

    public function connexion(indexConnexionFormRequest $request){
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
