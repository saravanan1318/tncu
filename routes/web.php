<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\IcmController;
use App\Http\Controllers\LoginFormController;

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

Route::get('/', [WebsiteController::class, 'index']);
Route::get('/applicationform', [WebsiteController::class, 'applicationform']);
Route::post('store-applicationform', [WebsiteController::class, 'store']);


/**AUTH */
//Route::get('loginform', [ 'as' => 'loginform', 'uses' => 'IcmController@index']);
Route::get('login', [LoginFormController::class, 'index']);
Route::post('checklogin', [LoginFormController::class, 'checklogin']);
Route::get('logout', [LoginFormController::class, 'logout']);

/**ICM */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/icm/dashboard', [IcmController::class, 'dashboard']);
    Route::get('/icm/applicationlist', [IcmController::class, 'applicationlist']);
});



