<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxCommander;

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

Route::middleware('auth:api')->group(function(){

    Route::post('/sendMessage', [AjaxCommander::class, 'receiveChatMessage']);
    Route::post('/setCssAttribute', [AjaxCommander::class, 'setAnimationAttribute']);

    Route::get('/getCssAttributes', [AjaxCommander::class, 'getAnimationAttributes']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
