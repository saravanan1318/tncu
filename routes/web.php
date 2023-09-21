<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\IcmController;
use App\Http\Controllers\LoginFormController;
use App\Http\Controllers\PHPMailerController;
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
Route::get('/notification', [WebsiteController::class, 'notification']);
Route::get('/applicationform', [WebsiteController::class, 'applicationform']);
Route::get('applicationreview/{id}', [WebsiteController::class, 'applicationreview']);
Route::get('applicationpdf/{id}', [WebsiteController::class, 'applicationpdf']);
Route::post('store-applicationform', [WebsiteController::class, 'store']) ;
Route::get('application-acknowledgement/{id}', [WebsiteController::class, 'applicationacknowledgement']);
Route::post('checkicmeligible', [WebsiteController::class, 'checkicmeligible']);
Route::get('/checksms', [WebsiteController::class, 'smstest']);
Route::get('/about-us', [WebsiteController::class, 'aboutus']);

/**AUTH */
//Route::get('loginform', [ 'as' => 'loginform', 'uses' => 'IcmController@index']);
Route::get('login', [LoginFormController::class, 'index']);
Route::post('checklogin', [LoginFormController::class, 'checklogin']);
Route::get('logout', [LoginFormController::class, 'logout']);

use App\Http\Controllers\UrlShortenerController;

Route::get('/{code}', [UrlShortenerController::class, 'redirect'])->name('redirect');


/**ICM */
Route::group(['middleware' => 'auth'], function () {
    Route::get('/icm/dashboard', [IcmController::class, 'dashboard']);
    Route::get('/icm/icmdashboard', [IcmController::class, 'icmdashboard']);
    Route::get('/icm/applicationlist', [IcmController::class, 'applicationlist']);
    Route::get('/icm/selectedapplicationlist', [IcmController::class, 'selectedapplicationlist']);
    Route::get('/icm/icmwiselist', [IcmController::class, 'icmwiselist']);
    Route::get('/icm/duplicateapplicationlist', [IcmController::class, 'duplicateapplicationlist']);
    Route::get('/icm/icmapplicationlist/{icm_id}', [IcmController::class, 'icmapplicationlist']);
    Route::get('/icm/applicationregenerate', [WebsiteController::class, 'applicationregenerate']);
});

Route::get('composeEmail/{id}', [PHPMailerController::class, 'composeEmail']);

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
Route::get('/clear-config', function() {
    $exitCode = Artisan::call('config:clear');
    // return what you want
});
Route::get('/clear-optimize', function() {
    $exitCode = Artisan::call('optimize');
    // return what you want
});
Route::get('/clear-route', function() {
    $exitCode = Artisan::call('config:route');
    // return what you want
});
