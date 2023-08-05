<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\IcmController;

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



/**ICM */
Route::get('/icm/dashboard', [IcmController::class, 'index']);


