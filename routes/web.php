<?php

//ROUTEUR

//ouverture du site
Route::get('/', function(){
  return view('indexConnexion');
});

Route::post('/', function(){
  if (session('pseudo')) {
    Session::forget('pseudo');
    Session::forget('otherComptes');
  }
  return view('indexConnexion');
});

//test connexion de l'utilisateur
Route::post('/testConnexion', 'UtilisateurController@Connexion');

//Creation compte utilisateur
Route::post('/creationUser', 'UtilisateurController@createUser');

//affichage de tous les comptes de l'utilisateur
Route::get('/indexComptes', 'CompteController@displayAccounts');

//affichage de tous les comptes de l'utilisateur
Route::post('/indexComptes', 'CompteController@displayAccounts');

//Creation d'un nouveau compte par l'utilisateur
Route::post('/indexComptes/creationCompte','CompteController@newAccount');
//Effacer un compte depuis index
Route::post('/effacerCompte','CompteController@deleteAccount');

//Voir page Detail
Route::post('/detailCompte','CompteController@displayAccount');

//retour page detail
Route::get('/detailCompte','CompteController@displayAccount');

//Effacer compte depuis page detail
Route::Post('/detailCompte/effacerCompte','CompteController@deleteAccount');

//Ajouter Argent sur le compte courant
Route::post('/detailCompte/ajoutArgent','CompteController@addMoney');

//transferet argent à l'un de ses compte
Route::post('/detailCompte/transfertSoi','CompteController@transfertMoney');

// créer lien vers utilisateur
Route::post('/detailCompte/linkAccount','CompteController@linkAccount');

//transfert à un autre utilisateur
Route::post('detailCompte/TransfertAutre','CompteController@transfertMoney');
