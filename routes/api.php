<?php

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

// All these routes should be protected by auth middleware
// however for the scope of this assignment i don't implement
// an authentication system
Route::namespace('App\Controllers\Api')->name('api.')->group(function(){
    Route::apiResources(['character' => 'CharacterController']);
});

