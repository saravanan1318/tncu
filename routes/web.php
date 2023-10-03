<?php

use App\Http\Controllers\StudentController;
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
Route::get('/payment', [WebsiteController::class, 'pay']);
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
    Route::get('/icm/selectedapplicationlist/Male', [IcmController::class, 'selectedapplicationicmlistmale']);
    Route::get('/icm/selectedapplicationlist/Female', [IcmController::class, 'selectedapplicationicmlistfemale']);
    Route::get('/icm/selectedapplicationlist/{icm_id}/{gender}', [IcmController::class, 'selectedapplicationlistgendericm']);
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


    Route::get('/icm/invoice/generate', [IcmController::class, 'generateinvoice']);
    Route::get('/icm/fees/paid', [IcmController::class, 'feespaid']);
    Route::get('/icm/fees/paid/{invoiceNo}', [IcmController::class, 'invoiceview']);
    Route::post('/icm/invoice/store', [IcmController::class, 'storeinvoice']);
    Route::get('/icm/printinvoice/{invoiceNo}', [IcmController::class, 'printinvoice']);

    Route::get('/student/studentdashboard', [StudentController::class, 'dashboard']);
    Route::post('/student/payment', [StudentController::class, 'payment']);

    Route::get('/icm/icmwise/paidreport', [IcmController::class, 'icmwisepaidreport']);

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
