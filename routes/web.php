<?php

use App\Http\Controllers\AjaxCommander;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
});

Route::group(['prefix' => 'ajax'], function() {
    Route::get('getChatMessages/{user}', [AjaxCommander::class, 'getChatMessages'])
        ->name('ajax.get-chat-messages');
});
