<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function(Request $request) {
        return auth()->user()->token;
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

// Dashboard
Route::middleware(['auth:sanctum',])->namespace('Dashboard')->prefix('dashboard')->group(function () {
    Route::prefix('request')->group(function () {
        Route::resource('individual', 'Request\Entreprise\IndividualController')->only(['store','update','destroy','show']);
        Route::resource('sa', 'Request\Entreprise\SaController')->only(['store','update','destroy','show']);;
        Route::resource('sarl_suarl', 'Request\Entreprise\SarlSuarlController')->only(['store','update','destroy','show']);;
        Route::resource('sas_or_sasu', 'Request\Entreprise\SasOrSasuController')->only(['store','update','destroy','show']);;
        Route::resource('sci', 'Request\Entreprise\SciController')->only(['store','update','destroy','show']);;
        Route::resource('civil_status', 'Request\Entreprise\CivilStatusController')->only(['store','update']);;
    });
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/type_canal', 'BaseInfoController@typeCanal')->name('type_canal');
    Route::get('/offer_type', 'BaseInfoController@offerType')->name('offer_type');
    Route::get('/type_conter', 'BaseInfoController@typeConter')->name('type_conter');
    Route::get('/get_all_region', 'BaseInfoController@getAllRegion')->name('get_all_region');
    Route::get('/identity_piece', 'BaseInfoController@identityPiece')->name('identity_piece');
    Route::get('/marital_option', 'BaseInfoController@getMaritalOption')->name('marital_option');
    Route::get('/marital_status', 'BaseInfoController@getMaritalStatus')->name('marital_status');
    Route::get('/marital_regime', 'BaseInfoController@getMaritalRegime')->name('marital_regime');
    Route::get('/type_inscription', 'BaseInfoController@typeInscription')->name('type_inscription');
    Route::get('/type_administrative', 'BaseInfoController@typeAdministrative')->name('type_administrative');
    Route::get('/canal_communication', 'BaseInfoController@canalCommunication')->name('canal_communication');
    Route::get('/get_allAgent_collect', 'BaseInfoController@getAllAgentCollect')->name('get_allAgent_collect');
    Route::get('/get_allAgent_deposit', 'BaseInfoController@getAllAgentDeposit')->name('get_allAgent_deposit');
    Route::get('/caracteristique_technique', 'BaseInfoController@caracteristiqueTechnique')->name('caracteristique_technique');
});
Route::resource('contact', ContactController::class)->only('index', 'store');
