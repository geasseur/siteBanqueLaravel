<?php

//ROUTEUR
//deconnexion
Route::post('/', 'UtilisateurController@deconnexion' )->name('utilisateur.returnConnexionPage');

//ouverture du site
Route::get('/', function(){
  return view('indexConnexion');
})->name('utilisateur.connexionPage');

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
Route::post('/effacerCompte/{id}','CompteController@deleteAccount')->name('compte.deleteAccount');

//Voir page Detail
Route::post('/detailCompte/{id}','CompteController@displayAccount')->name('compte.detailPage');

//retour page detail
Route::get('/detailCompte/{id}','CompteController@displayAccount')->name('compte.returnDetailPage');

//Effacer compte depuis page detail
Route::Post('/detailCompte/effacerCompte/{id}','CompteController@deleteAccount')->name('compte.deleteAccountDetail');

//Ajouter Argent sur le compte courant
Route::post('/detailCompte/ajoutArgent/{id}','CompteController@addMoney')->name('compte.addMoney');

//transferet argent à l'un de ses compte
Route::post('/detailCompte/transfertSoi/{id}','CompteController@transfertMoneyMyself')->name('compte.transfertSoi');

// créer lien vers utilisateur
Route::post('/detailCompte/linkAccount/{id}/{owner}','CompteController@linkAccount')->name('compte.newLink');

//transfert à un autre utilisateur
Route::post('detailCompte/TransfertAutre/{id}','CompteController@transfertMoneyOther')->name('compte.transfertOtherMoney');
