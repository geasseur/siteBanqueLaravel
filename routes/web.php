<?php

//ROUTEUR

//ouverture du site
Route::get('/', function(){
  return view('indexConnexion');
});

Route::post('/', function(){
  if (session('pseudo')) {
    Session::forget('pseudo');
  }
  return view('indexConnexion');
});

//test connexion de l'utilisateur
Route::post('/testConnexion', 'UtilisateurController@Connexion');

//Creation compte utilisateur
Route::post('/creationUser', 'UtilisateurController@createUser');

//affichage de tous les comptes de l'utilisateur
Route::get('/indexComptes', 'CompteController@displayAccount');

//Creation d'un nouveau compte par l'utilisateur
Route::post('/indexComptes/creationCompte','CompteController@newAccount');
