<?php

use App\Http\Controllers\AjaxCommander;
use Illuminate\Support\Facades\Route;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;

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

WebSocketsRouter::webSocket('/socket', \App\DashboardWebsocketHandler::class);

Route::get('/', function () {
    return view('dashboard');
});

Route::get('ajax-client', function(){
    return view('ajaxclient');
});
Route::get('websocket-client', function(){
    return view('websocketclient');
});

Route::group(['prefix' => 'ajax'], function() {
    Route::get('getChatMessages/{user}', [AjaxCommander::class, 'getAjaxData'])
        ->name('ajax.get-ajax-data');
});
