<?php

//ROUTEUR

//ouverture du site
Route::get('/', function(){
  return view('indexConnexion');
})->name('utilisateur.connexionPage');

Route::post('/deco', 'UtilisateurController@deconnexion' )->name('utilisateur.returnConnexionPage');

// Route::get('/', function() {
//   dd(App::environment());
// });

//test connexion de l'utilisateur
Route::post('/testConnexion', 'UtilisateurController@connexion')->name('utilisateur.connexion');

//Creation compte utilisateur
Route::post('/creationUser', 'UtilisateurController@createUser')->name('utilisateur.createUser');

//affichage de tous les comptes de l'utilisateur
Route::get('/indexComptes', 'CompteController@displayAccounts')->name('compte.indexComptesGet');

//affichage de tous les comptes de l'utilisateur
Route::post('/indexComptes', 'CompteController@displayAccounts')->name('compte.indexComptesPost');

//Creation d'un nouveau compte par l'utilisateur
Route::post('/indexComptes/creationCompte','CompteController@newAccount')->name('compte.createAccount');

//Effacer un compte depuis index
Route::post('/effacerCompte','CompteController@deleteAccount')->name('compte.deleteAccount');

//Voir page Detail
Route::post('/detailCompte','CompteController@displayAccount')->name('compte.detailPage');

//retour page detail
Route::get('/detailCompte','CompteController@displayAccount')->name('compte.returnDetailPage');

//Effacer compte depuis page detail
Route::Post('/detailCompte/effacerCompte','CompteController@deleteAccount')->name('compte.deleteAccountDetail');

//Ajouter Argent sur le compte courant
Route::post('/detailCompte/ajoutArgent','CompteController@addMoney')->name('compte.addMoney');

//transferet argent à l'un de ses compte
Route::post('/detailCompte/transfertSoi','CompteController@transfertMoney')->name('compte.transfertSoi');

// créer lien vers utilisateur
Route::post('/detailCompte/linkAccount','CompteController@linkAccount')->name('compte.newLink');

//transfert à un autre utilisateur
Route::post('detailCompte/TransfertAutre','CompteController@transfertMoney')->name('compte.transfertOtherMoney');
