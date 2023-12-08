<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('home');
});
Route::get('/login', [App\Http\Controllers\Controller::class, 'loginUser'])->name('login');
Route::get('/register', [App\Http\Controllers\Controller::class, 'registerUser'])->name('register');
//Route::get('/', [App\Http\Controllers\ControllerAdminSGBD::class, 'test']);

/**************************************** Debut route secretaire ********************************/
Route::get('/HSecretaire', [App\Http\Controllers\ControllerSecretaire::class, 'home']);
Route::get('/Formulaire', [App\Http\Controllers\ControllerSecretaire::class, 'get_form_ask'])->name('get_form_ask');
Route::post('/FormulaireSave{id_user}', [App\Http\Controllers\ControllerSecretaire::class, 'store_form_ask'])->name('store_form_ask');
Route::get('/ListeDemandes', [App\Http\Controllers\ControllerSecretaire::class, 'get_list_ask'])->name('get_list_ask');
Route::get('/ListeDetaille{id_ask}', [App\Http\Controllers\ControllerSecretaire::class, 'get_list_details_ask'])->name('get_list_details_ask');
Route::get('/RechecherDemande{id_user}',  [App\Http\Controllers\Controller::class, 'get_search_ask'])->name('get_search_ask');
Route::get('/MiseAJourDemande{id_user}', [App\Http\Controllers\ControllerSecretaire::class, 'get_update_form_ask'])->name('get_update_form_ask');
Route::post('/MiseAJourDemandeSave{id_user}', [App\Http\Controllers\ControllerSecretaire::class, 'store_update_form_ask'])->name('store_update_form_ask');
/* Route::get('/get_search_ask_suite', [App\Http\Controllers\ControllerSecretaire::class, 'get_search_ask_suite'])->name('get_search_ask_suite');
Route::post('/RechecherLaDemandeSuite{id}',  [App\Http\Controllers\ControllerSecretaire::class, 'store_search_ask_suite'])->name('store_search_ask_suite');
Route::post('/FormulaireSuiteSave', [App\Http\Controllers\ControllerSecretaire::class, 'store_form_ask_suite'])->name('store_form_ask_suite'); */
Route::get('/ListeBack', [App\Http\Controllers\ControllerSecretaire::class, 'listeretour'])->name('get_list_back');
Route::get('/CorrectionDemande{id}', [App\Http\Controllers\ControllerSecretaire::class, 'get_correction_form_ask'])->name('get_correction_form_ask');
Route::post('/CorrectionDemandeSave{id}', [App\Http\Controllers\ControllerSecretaire::class, 'store_correction_form_ask'])->name('store_correction_form_ask');

Route::get('/Recu{id_ask}', [App\Http\Controllers\ControllerSecretaire::class, 'get_rec_ask'])->name('get_rec_ask');


/*************************************** Fin route secretaire ***********************************/


/**************************************** Debut route verificateur ********************************/
Route::get('/HVerificateur', [App\Http\Controllers\ControllerVerificateur::class, 'home']);
Route::get('/ListeDemandesN_verificateur', [App\Http\Controllers\ControllerVerificateur::class, 'liste_demande_n']);
Route::get('/Formulaire_verificateur/{id}', [App\Http\Controllers\ControllerVerificateur::class, 'formulaire'])->name('voir_demande');
Route::post('/FormulaireSave_verificateur/{id}', [App\Http\Controllers\ControllerVerificateur::class, 'store'])->name('store_formulaire_demandes');
Route::get('/ListeDemandes_verificateur', [App\Http\Controllers\ControllerVerificateur::class, 'liste'])->name('liste_demande');
Route::get('/Listepiece', [App\Http\Controllers\ControllerVerificateur::class, 'listep'])->name('get_list_piece_verificateur');

Route::get('/detaille/{id}', [App\Http\Controllers\ControllerVerificateur::class, 'detaille'])->name('get_list_details_ask_verificateur');
Route::get('/searchv{id}',  [App\Http\Controllers\Controller::class, 'searchv'])->name('info.search.v');
Route::get('/VerificateurMj{id}', [App\Http\Controllers\ControllerVerificateur::class, 'formulaire'])->name('get_update_form_ask_verificateur');

/* Route::get('/VerificateurMj{id}', [App\Http\Controllers\ControllerVerificateur::class, 'form'])->name('get_update_form_ask_verificateur');
 */
Route::post('/VerificateurS_Mj/{id}', [App\Http\Controllers\ControllerVerificateur::class, 'store'])->name('le_store_formulaire');
Route::post('/FVerifica{id}', [App\Http\Controllers\ControllerVerificateur::class, 'store_piece_dmd'])->name('store_form_piece_verificateur');
Route::get('/retour_s{id}', [App\Http\Controllers\ControllerVerificateur::class, 'retour'])->name('retour_s');
Route::get('/ListeBackv', [App\Http\Controllers\ControllerVerificateur::class, 'listeretour'])->name('get_list_back_v');
Route::get('/VerificateurCorrection{id}', [App\Http\Controllers\ControllerVerificateur::class, 'formulaire'])->name('get_correction_form_ask_verificateur');

/* Route::get('/VerificateurCorrection{id}', [App\Http\Controllers\ControllerVerificateur::class, 'form_corre'])->name('get_correction_form_ask_verificateur');
 */
Route::post('/Verifica/{id}', [App\Http\Controllers\ControllerVerificateur::class, 'checkref'])->name('store_search');
Route::post('/rejtpieces/{id}', [App\Http\Controllers\ControllerVerificateur::class, 'rejet'])->name('rejet_piece_verificateur');

Route::post('/VerificateurS_corr/{id}', [App\Http\Controllers\ControllerVerificateur::class, 'store_corr'])->name('le_store_corr');


/*************************************** Fin route verificateur ***********************************/


/**************************************** Debut route Chef division ********************************/
Route::get('/HChef_division', [App\Http\Controllers\ControllerDivision::class, 'home']);
Route::get('/liste_demandes_n', [App\Http\Controllers\ControllerDivision::class, 'liste_demandes_n']);
Route::get('/chef_division/{id}', [App\Http\Controllers\ControllerDivision::class, 'formulaires'])->name('voir_demandes');
Route::post('/Fchef_division{id}', [App\Http\Controllers\ControllerDivision::class, 'stores'])->name('store_formulaire_demanded');
Route::get('/liste_demandes', [App\Http\Controllers\ControllerDivision::class, 'liste_demandes']);
Route::get('/detailles_demandes/{id}', [App\Http\Controllers\ControllerDivision::class, 'detailles'])->name('detailles_demandes');
Route::get('/searchd{id}',  [App\Http\Controllers\Controller::class, 'searchd'])->name('info.search.cd');
Route::get('/chef_divisionMj{id}', [App\Http\Controllers\ControllerDivision::class, 'form'])->name('formulairecd_demande_mj');
Route::post('/chef_divisionS_Mj{id}', [App\Http\Controllers\ControllerDivision::class, 'store'])->name('le_store');
Route::get('/retour_v{id}', [App\Http\Controllers\ControllerDivision::class, 'retour'])->name('retour_v');
Route::get('/ListeBackd', [App\Http\Controllers\ControllerDivision::class, 'listeretour'])->name('get_list_back_d');

Route::get('/Mise a jour devises/{id}', [App\Http\Controllers\ControllerDivision::class, 'devise'])->name('devises');
Route::post('/Ajout devises/{id}', [App\Http\Controllers\ControllerDivision::class, 'adddevise'])->name('adddevises');
Route::post('/Ajout cours/{id}', [App\Http\Controllers\ControllerDivision::class, 'addc'])->name('addcours');
Route::get('/ListeDeviseMj', [App\Http\Controllers\ControllerDivision::class, 'get_devis_mj'])->name('ListeDeviseMj');

/*************************************** Fin route Chef division ***********************************/

/**************************************** Debut route Chef bureau ********************************/
Route::get('/HChef_bureau', [App\Http\Controllers\ControllerBureau::class, 'home']);
Route::get('/liste_demand_n', [App\Http\Controllers\ControllerBureau::class, 'liste_demand_n']);
Route::get('/chef_bureau/{id}', [App\Http\Controllers\ControllerBureau::class, 'formulair'])->name('voir_demand');
Route::post('/Fchef_bureau{id}', [App\Http\Controllers\ControllerBureau::class, 'stor'])->name('store_formulaire_demand');
Route::get('/liste_demand', [App\Http\Controllers\ControllerBureau::class, 'liste_demand']);
Route::get('/searchb{id}',  [App\Http\Controllers\Controller::class, 'searchb'])->name('info.search.cb');
Route::get('/detailles_demand/{id}', [App\Http\Controllers\ControllerBureau::class, 'detailles'])->name('detailles_demand');
Route::get('/chef_bureaurMj{id}', [App\Http\Controllers\ControllerBureau::class, 'form'])->name('formulairecb_demande_mj');
Route::post('/chef_bureaurS_Mj{id}', [App\Http\Controllers\ControllerBureau::class, 'store'])->name('cb_store');
Route::get('/retour_cd{id}', [App\Http\Controllers\ControllerBureau::class, 'retour'])->name('retour_cd');
Route::get('/ListeBackb', [App\Http\Controllers\ControllerBureau::class, 'listeretour'])->name('get_list_back_b');

/*************************************** Fin route Chef bureau ***********************************/



/**************************************** Debut route Damf ********************************/
Route::get('/HDamf', [App\Http\Controllers\ControllerDamf::class, 'home']);
Route::get('/liste_dmd_n', [App\Http\Controllers\ControllerDamf::class, 'liste_dmd_n']);
Route::get('/damf/{id}', [App\Http\Controllers\ControllerDamf::class, 'formulair'])->name('voir_dmd');
Route::post('/Fdamf{id}', [App\Http\Controllers\ControllerDamf::class, 'stor'])->name('store_formulaire_dmd');
Route::get('/liste_dmd', [App\Http\Controllers\ControllerDamf::class, 'liste_dmd']);
Route::get('/detailles/{id}', [App\Http\Controllers\ControllerDamf::class, 'detailles'])->name('detailles_dmd');
Route::get('/searchD{id}',  [App\Http\Controllers\Controller::class, 'searchdamf'])->name('info.search.d');
Route::get('/damfMj{id}', [App\Http\Controllers\ControllerDamf::class, 'form'])->name('formulaireda_demande_mj');
Route::post('/damfS_Mj{id}', [App\Http\Controllers\ControllerDamf::class, 'store'])->name('da_store');
Route::get('/retour_cb{id}', [App\Http\Controllers\ControllerDamf::class, 'retour'])->name('retour_cb');


/*************************************** Fin route Damf ***********************************/


/**************************************** Debut route Client ********************************/
Route::get('/Client', [App\Http\Controllers\ControllerClient::class, 'home']);
Route::post('/Fclient{id}', [App\Http\Controllers\ControllerClient::class, 'Fclient'])->name('Fclient');
Route::get('/demande/pdf/{id}', [App\Http\Controllers\ControllerClient::class, 'createPDF']);

/*************************************** Fin route Client ***********************************/


/**Route Admin**********************************************************************/
Route::get('/Admin', [App\Http\Controllers\ControllerAdminSGBD::class, 'home']);
Route::get('/Admin', [App\Http\Controllers\ControllerAdminSGBD::class, 'home'])->name('home');

Route::get('/CheckUser{id}', [App\Http\Controllers\ControllerAdminSGBD::class, 'home'])->name('check_user');
Route::get('/ModifyUser{id}', [App\Http\Controllers\ControllerAdminSGBD::class, 'modify_user'])->name('modify_user');
Route::get('/Delete{id}', [App\Http\Controllers\ControllerAdminSGBD::class, 'delete_user'])->name('delete_user');
Route::post('/Store{id}', [App\Http\Controllers\ControllerAdminSGBD::class, 'store_user'])->name('store_user');
Route::get('/user/pdf', [App\Http\Controllers\ControllerAdminSGBD::class, 'createPDF']);
Route::get('/liste/pdf/{status}/{sdate}/{fdate}', [App\Http\Controllers\ControllerAdminSGBD::class, 'listePDF'])->name('liste.pdf');
Route::get('/laliste/pdf/{status}/{sdate}/{fdate}/{devise}', [App\Http\Controllers\ControllerAdminSGBD::class, 'lalistePDF'])->name('laliste.pdf');
Route::get('/laliste/pdf/{test}', [App\Http\Controllers\ControllerAdminSGBD::class, 'lalisteetatsPDF'])->name('lalisteetats.pdf');

Route::get('/Etat', [App\Http\Controllers\ControllerAdminSGBD::class, 'getetatdmd'])->name('etatdmd');
Route::post('/listedmd', [App\Http\Controllers\ControllerAdminSGBD::class, 'listedmd'])->name('listedmd');
Route::get('/lesdetailles/{id}', [App\Http\Controllers\ControllerAdminSGBD::class, 'detailles'])->name('detaillesdmd');

Route::post('/laliste', [App\Http\Controllers\ControllerAdminSGBD::class, 'laliste'])->name('laliste');

Route::get('/lespays', [App\Http\Controllers\ControllerAdminSGBD::class, 'getpays'])->name('lespays');
Route::get('/lessocietes', [App\Http\Controllers\ControllerAdminSGBD::class, 'getsociete'])->name('lessocietes');
Route::get('/lesdevis', [App\Http\Controllers\ControllerAdminSGBD::class, 'getdevis'])->name('lesdevis');

/******************************************************************************* */
