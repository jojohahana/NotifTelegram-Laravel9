<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TelegramBotController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(TelegramBotController::class)->group(function () {
    Route::get('/', 'sendMessage');
    Route::post('/send-message', 'storeMessage')->name('/send-message');
    Route::get('/send-photo', 'sendPhoto')->name('/send-photo');
    Route::post('/store-photo', 'storePhoto')->name('/store-photo');
    Route::get('/updated-activity', 'updatedActivity')->name('/updated-activity');
});

// Route::get('/', 'TelegramBotController@sendMessage');
// Route::post('/send-message', 'TelegramBotController@storeMessage');
// Route::get('/send-photo', 'TelegramBotController@sendPhoto');
// Route::post('/store-photo', 'TelegramBotController@storePhoto');
// Route::get('/updated-activity', [ TelegramBotController::class, 'updatedActivity']);
