<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/change-password', 'Auth\ChangePasswordController@index')->name('password.change');
Route::post('/change-password', 'Auth\ChangePasswordController@changePassword')->name('password.new');

Route::get('/rechercheAvancee', 'RechercheAvanceeController@affiche')->name('rechercheAvancee.affiche');
Route::post('/rechercheAvancee', 'RechercheAvanceeController@afficheRes')->name('rechercheAvancee.afficheresultat');
Route::get('/recherche', 'RechercheController@afficherParCode')->name('rechercheparcode');
Route::get('/rechercheParRef', 'RechercheController@afficherParRefClient')->name('rechercheparrefclient');
Route::get('/prixStock', 'RechercheController@showPrixStock')->name('prixstock');
Route::get('/productDetails', 'RechercheController@showProductDetails')->name('productdetails');

Route::get('/monCompte', 'MonCompteController@showPage')->name('moncompte.affiche');

Route::get('/monCompte/conditionLivraisonPaiement', 'ConditionLivraisonPaiementController@showPage')->name('conditionlivraisonpaiement');

Route::get('/monCompte/listeCommande', 'ListCommandController@showSelect')->name('commande.afficheselect');
Route::post('/monCompte/listeCommande', 'ListCommandController@showCommand')->name('commande.affichecommande');

//Route::get('/ajouterPanier', 'PanierController@ajouterAuPanier')->name('ajouteraupanier');
Route::get('/panier', 'PanierController@affichePanier')->name('affichepanier');
Route::post('/panier/verifierEtCommander', 'PanierController@verifierEtCommander')->name('verifieretcommander');
Route::post('/ajouterAuPanier', 'PanierController@ajouterAuPanier');
Route::get('/panier/merci', 'PanierController@afficheRemerciement')->name('merciPanier');

Route::post('/savePanierInput', 'PanierController@savePanierInput');

Route::get('/importCommande', 'PanierController@importCommandeAffiche')->name('importcommandeaffiche');
Route::post('/importCommande', 'PanierController@importCommande')->name('importcommande');

Route::get('/requestList', 'RequestListController@afficheRequestList')->name('afficherequestlist');
Route::post('/ajouterRequestList', 'RequestListController@ajouterRequestList');
Route::post('/saveRequestListInput', 'RequestListController@saveRequestListInput');
Route::post('/requestList', 'RequestListController@envoyerRequestList')->name('envoyerrequestlist');

Route::get('/monCompte/nouvelUtilisateur', 'GestionUtlisateurController@afficheCreate')->name('nouvelutilisateur.affiche');
Route::post('/monCompte/nouvelUtilisateur', 'GestionUtlisateurController@register')->name('nouvelutilisateur.ajouter');

Route::get('/monCompte/modifierProfil', 'GestionUtlisateurController@afficheModif')->name('modifprofil.affiche');
Route::post('/monCompte/modifierProfil', 'GestionUtlisateurController@modifier')->name('modifprofil.modifier');
Route::post('/deleteUser', 'GestionUtlisateurController@deleteUser');


Route::get('/contact', function () {
    if (Auth::check()) {
        return view('foot.afterAuthContact');
    } else {
        return view('foot.beforeAuthContact');
    }
})->name('contact');
