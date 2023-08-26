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

/**************************************** Debut route secretaire ********************************/
Route::get('/HSecretaire', [App\Http\Controllers\ControllerSecretaire::class, 'home']);
Route::get('/Formulaire', [App\Http\Controllers\ControllerSecretaire::class, 'get_form_ask'])->name('get_form_ask');
Route::post('/FormulaireSave{id_user}', [App\Http\Controllers\ControllerSecretaire::class, 'store_form_ask'])->name('store_form_ask');
Route::get('/ListeDemandes', [App\Http\Controllers\ControllerSecretaire::class, 'get_list_ask'])->name('get_list_ask');
Route::get('/ListeDetaille{id_ask}', [App\Http\Controllers\ControllerSecretaire::class, 'get_list_details_ask'])->name('get_list_details_ask');
Route::get('/RechecherDemande{id_user}',  [App\Http\Controllers\Controller::class, 'get_search_ask'])->name('get_search_ask');
Route::get('/MiseAJourDemande{id_user}', [App\Http\Controllers\ControllerSecretaire::class, 'get_update_form_ask'])->name('get_update_form_ask');
Route::post('/MiseAJourDemandeSave{id_user}', [App\Http\Controllers\ControllerSecretaire::class, 'store_update_form_ask'])->name('store_update_form_ask');
Route::get('/get_search_ask_suite', [App\Http\Controllers\ControllerSecretaire::class, 'get_search_ask_suite'])->name('get_search_ask_suite');
Route::post('/RechecherLaDemandeSuite{id}',  [App\Http\Controllers\ControllerSecretaire::class, 'store_search_ask_suite'])->name('store_search_ask_suite');
Route::post('/FormulaireSuiteSave', [App\Http\Controllers\ControllerSecretaire::class, 'store_form_ask_suite'])->name('store_form_ask_suite');


/*************************************** Fin route secretaire ***********************************/


/**************************************** Debut route verificateur ********************************/
Route::get('/HVerificateur', [App\Http\Controllers\ControllerVerificateur::class, 'home']);
Route::get('/ListeDemandesN', [App\Http\Controllers\ControllerVerificateur::class, 'get_list_ask_n_verificateur']);
Route::get('/Formulaire/{id_user}', [App\Http\Controllers\ControllerVerificateur::class, 'get_form_ask'])->name('get_form_ask_verificateur');
Route::post('/FormulaireSave{id_user}', [App\Http\Controllers\ControllerVerificateur::class, 'store_form_ask'])->name('store_form_ask_verificateur');
Route::get('/ListePiece', [App\Http\Controllers\ControllerVerificateur::class, 'get_list_piece'])->name('get_list_piece_verificateur');
Route::get('/ListeDetaille{id_ask}', [App\Http\Controllers\ControllerVerificateur::class, 'get_list_details_ask'])->name('get_list_details_ask_verificateur');
Route::get('/RechecherDemande{id_user}',  [App\Http\Controllers\Controller::class, 'get_search_ask'])->name('get_search_ask_verificateur');
Route::get('/MiseAJourDemande{id_user}', [App\Http\Controllers\ControllerVerificateur::class, 'get_update_form_ask'])->name('get_update_form_ask_verificateur');
Route::post('/MiseAJourDemandeSave{id_user}', [App\Http\Controllers\ControllerVerificateur::class, 'store_update_form_ask'])->name('store_update_form_ask_verificateur');
Route::post('/PiecesSave{id_user}', [App\Http\Controllers\ControllerVerificateur::class, 'store_form_piece'])->name('store_form_piece_verificateur');
/*************************************** Fin route verificateur ***********************************/


/**************************************** Debut route Chef division ********************************/
Route::get('/HChef_division', [App\Http\Controllers\ControllerDivision::class, 'home']);
Route::get('/ListeDemandesN', [App\Http\Controllers\ControllerDivision::class, 'get_list_ask_n_cd']);
Route::get('/Formulaire/{id_user}', [App\Http\Controllers\ControllerDivision::class, 'get_form_ask'])->name('get_form_ask_cd');
Route::post('/FormulaireSave{id_user}', [App\Http\Controllers\ControllerDivision::class, 'store_form_ask'])->name('store_form_ask_cd');
Route::get('/ListeDemandes', [App\Http\Controllers\ControllerDivision::class, 'get_list_ask']);
Route::get('/ListeDetaille{id_ask}', [App\Http\Controllers\ControllerDivision::class, 'get_list_details_ask'])->name('get_list_details_ask_cd');
Route::get('/RechecherDemande{id_user}',  [App\Http\Controllers\Controller::class, 'get_search_ask'])->name('get_search_ask_cd');
Route::get('/MiseAJourDemande{id_user}', [App\Http\Controllers\ControllerDivision::class, 'get_update_form_ask'])->name('get_update_form_ask_cd');
Route::post('/MiseAJourDemandeSave{id_user}', [App\Http\Controllers\ControllerDivision::class, 'store_update_form_ask'])->name('store_update_form_ask_cd');
/*************************************** Fin route Chef division ***********************************/

/**************************************** Debut route Chef bureau ********************************/
/* Route::get('/HChef_bureau', [App\Http\Controllers\ControllerBureau::class, 'home']);
Route::get('/liste_demand_n', [App\Http\Controllers\ControllerBureau::class, 'liste_demand_n']);
Route::get('/chef_bureau/{id}', [App\Http\Controllers\ControllerBureau::class, 'formulair'])->name('voir_demand');
Route::post('/Fchef_bureau{id}', [App\Http\Controllers\ControllerBureau::class, 'stor'])->name('store_formulaire_demand');
Route::get('/liste_demand', [App\Http\Controllers\ControllerBureau::class, 'liste_demand']);
Route::get('/searchb{id}',  [App\Http\Controllers\Controller::class, 'searchb'])->name('info.search.cb');
Route::get('/detailles_demand/{id}', [App\Http\Controllers\ControllerBureau::class, 'detailles'])->name('detailles_demand');
Route::get('/chef_bureaurMj{id}', [App\Http\Controllers\ControllerBureau::class, 'form'])->name('formulairecb_demande_mj');
Route::post('/chef_bureaurS_Mj{id}', [App\Http\Controllers\ControllerBureau::class, 'store'])->name('cb_store');
 */ /*************************************** Fin route Chef bureau ***********************************/



/**************************************** Debut route Damf ********************************/
/* Route::get('/HDamf', [App\Http\Controllers\ControllerDamf::class, 'home']);
Route::get('/liste_dmd_n', [App\Http\Controllers\ControllerDamf::class, 'liste_dmd_n']);
Route::get('/damf/{id}', [App\Http\Controllers\ControllerDamf::class, 'formulair'])->name('voir_dmd');
Route::post('/Fdamf{id}', [App\Http\Controllers\ControllerDamf::class, 'stor'])->name('store_formulaire_dmd');
Route::get('/liste_dmd', [App\Http\Controllers\ControllerDamf::class, 'liste_dmd']);
Route::get('/detailles/{id}', [App\Http\Controllers\ControllerDamf::class, 'detailles'])->name('detailles_dmd');
Route::get('/searchD{id}',  [App\Http\Controllers\Controller::class, 'searchdamf'])->name('info.search.d');
Route::get('/damfMj{id}', [App\Http\Controllers\ControllerDamf::class, 'form'])->name('formulaireda_demande_mj');
Route::post('/damfS_Mj{id}', [App\Http\Controllers\ControllerDamf::class, 'store'])->name('da_store');
 */

/*************************************** Fin route Damf ***********************************/


/**************************************** Debut route Client ********************************/
Route::get('/Client', [App\Http\Controllers\ControllerClient::class, 'home']);
Route::post('/Fclient{id}', [App\Http\Controllers\ControllerClient::class, 'Fclient'])->name('Fclient');
Route::get('/demande/pdf/{id}', [App\Http\Controllers\ControllerClient::class, 'createPDF']);

/*************************************** Fin route Client ***********************************/


/**Route Admin**********************************************************************/
Route::get('/Admin', [App\Http\Controllers\ControllerAdminSGBD::class, 'home']);
Route::get('/CheckUser{id}', [App\Http\Controllers\ControllerAdminSGBD::class, 'home'])->name('check_user');
Route::get('/ModifyUser{id}', [App\Http\Controllers\ControllerAdminSGBD::class, 'modify_user'])->name('modify_user');
Route::get('/Delete{id}', [App\Http\Controllers\ControllerAdminSGBD::class, 'delete_user'])->name('delete_user');
Route::post('/Store{id}', [App\Http\Controllers\ControllerAdminSGBD::class, 'store_user'])->name('store_user');
Route::get('/user/pdf', [App\Http\Controllers\ControllerAdminSGBD::class, 'createPDF']);

/******************************************************************************* */
