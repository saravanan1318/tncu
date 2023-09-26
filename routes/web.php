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
Route::get('/icmapplicationform', [WebsiteController::class, 'applicationform']);
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
    Route::get('/icm/passwordChange', [IcmController::class, 'passwordChange']);
    Route::post('/icm/updatePassword', [IcmController::class, 'updatePassword']);
    Route::get('/icm/dashboard', [IcmController::class, 'dashboard']);
    Route::get('/icm/icmdashboard', [IcmController::class, 'icmdashboard']);
    Route::get('/icm/applicationlist', [IcmController::class, 'applicationlist']);
    Route::get('/icm/printedformat', [IcmController::class, 'printapplicationlist']);
    Route::get('/icm/selectedapplicationlist', [IcmController::class, 'selectedapplicationlist']);
    Route::get('/icm/icmwiselist', [IcmController::class, 'icmwiselist']);
    Route::get('/icm/duplicateapplicationlist', [IcmController::class, 'duplicateapplicationlist']);
    Route::get('/icm/icmapplicationlist/{icm_id}', [IcmController::class, 'icmapplicationlist']);
    Route::get('/icm/applicationregenerate', [WebsiteController::class, 'applicationregenerate']);
    Route::get('/icm/duplicateaccept', [IcmController::class, 'duplicateaccept']);
    Route::get('/icm/selectedlist', [IcmController::class, 'selectedlist']);
    Route::get('/icm/printerversion/male', [IcmController::class, 'printerversionmale']);
    Route::get('/icm/printerversion/female', [IcmController::class, 'printerversionfemale']);
    Route::get('/icm/printerversion/address/{gender}', [IcmController::class, 'contacticmlist']);
    Route::get('/icm/printerversion/address/{icm_id}/{gender}', [IcmController::class, 'contacticmapplicationlist']);
    Route::get('/icm/printerapplicationlistpdf/{icm_id}/{gender}', [IcmController::class, 'printerapplicationlistpdf']);
    Route::get('/icm/printerversionmalelist/{icm_id}/{gender}', [IcmController::class, 'printerversionmalelist']);
    Route::get('/icm/printerversionfemalelist/{icm_id}/{gender}', [IcmController::class, 'printerversionfemalelist']);
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
