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

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/change-password', 'Auth\ChangePasswordController@index')->name('password.change');
Route::post('/change-password', 'Auth\ChangePasswordController@changePassword')->name('password.new');

Route::get('/rechercheAvancee', 'RechercheAvanceeController@affiche')->name('rechercheAvancee.affiche');
Route::post('/rechercheAvancee', 'RechercheAvanceeController@afficheRes')->name('rechercheAvancee.afficheresultat');
Route::get('/recherche', 'RechercheController@afficherParCode')->name('rechercheparcode');
Route::get('/rechercheParRef', 'RechercheController@afficherParRefClient')->name('rechercheparrefclient');
Route::get('/prixStock', 'RechercheController@showPrixStock')->name('prixstock');
Route::get('/productDetails', 'RechercheController@showProductDetails')->name('productdetails');

Route::get('/monCompte', 'MonCompte\MonCompteController@showPage')->name('moncompte.affiche');

Route::get('/monCompte/conditionLivraisonPaiement', 'MonCompte\ConditionLivraisonPaiementController@showPage')->name('conditionlivraisonpaiement');

Route::get('/monCompte/listeCommande', 'MonCompte\ListCommandController@showSelect')->name('commande.afficheselect');
Route::post('/monCompte/listeCommande', 'MonCompte\ListCommandController@showCommand')->name('commande.affichecommande');

//Route::get('/ajouterPanier', 'PanierController@ajouterAuPanier')->name('ajouteraupanier');
Route::get('/panier', 'PanierController@affichePanier')->name('affichepanier');
Route::post('/panier/verifierEtCommander', 'PanierController@verifierEtCommander')->name('verifieretcommander');
Route::post('/ajouterAuPanier', 'PanierController@ajouterAuPanier');
Route::get('/panier/confirmation', 'PanierController@afficheConfirmation')->name('confirmationpanier');

Route::post('/savePanierInput', 'PanierController@savePanierInput');

Route::get('/importCommande', 'PanierController@importCommandeAffiche')->name('importcommandeaffiche');
Route::post('/importCommande', 'PanierController@importCommande')->name('importcommande');

Route::get('/requestList', 'RequestListController@afficheRequestList')->name('afficherequestlist');
Route::post('/ajouterRequestList', 'RequestListController@ajouterRequestList');
Route::post('/saveRequestListInput', 'RequestListController@saveRequestListInput');
Route::post('/requestList', 'RequestListController@envoyerRequestList')->name('envoyerrequestlist');
Route::get('/requestList/confirmation', 'RequestListController@afficheConfirmation')->name('confirmationrequestlist');

Route::get('/monCompte/nouvelUtilisateur', 'MonCompte\GestionUtlisateurController@afficheCreate')->name('nouvelutilisateur.affiche');
Route::post('/monCompte/nouvelUtilisateur', 'MonCompte\GestionUtlisateurController@register')->name('nouvelutilisateur.ajouter');

Route::get('/monCompte/modifierProfil', 'MonCompte\GestionUtlisateurController@afficheModif')->name('modifprofil.affiche');
Route::post('/monCompte/modifierProfil', 'MonCompte\GestionUtlisateurController@modifier')->name('modifprofil.modifier');
Route::get('/monCompte/changePassword', 'Auth\ChangePasswordController@afficheChangePassword')->name('affichechangepassword');
Route::post('/monCompte/changePassword', 'Auth\ChangePasswordController@changePassword')->name('changepassword');
Route::post('/deleteUser', 'MonCompte\GestionUtlisateurController@deleteUser');

Route::get('/monCompte/commandesCSV', 'MonCompte\CommandCsvController@afficheCommandesCsv')->name('affichecommandescsv');
Route::post('/monCompte/commandesCSV', 'MonCompte\CommandCsvController@telechargerCommandesCsv')->name('telechargercommandescsv');

Route::get('/monCompte/registerIntern', 'MonCompte\RegisterInternController@afficheCreateIntern')->name('affichecreateintern');
Route::post('/monCompte/registerIntern', 'MonCompte\RegisterInternController@register')->name('createintern');

Route::get('/contact', function () {
    if (Auth::check()) {
        return view('foot.afterAuthContact');
    } else {
        return view('foot.beforeAuthContact');
    }
})->name('contact');
