<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\SpecieController;

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

Route::prefix('characters/')->name('character.')->group(function () {
    Route::get('get-remote', 'App\Http\Controllers\CharacterController@getRemoteCharacters')->name('get-remote');
    Route::get('get-local', 'App\Http\Controllers\CharacterController@getLocalCharacters')->name('get-local');
    Route::post('import', 'App\Http\Controllers\CharacterController@import')->name('import');
    Route::post('mass-update', 'App\Http\Controllers\CharacterController@massUpdate')->name('mass-update');
});


// these routes will simply return the app layout
// front-end will build the page content
Route::get('characters/import', function () {
    return view('layouts.app');
});

Route::get('characters/mass-update', function () {
    return view('layouts.app');
});

// resource routes
Route::resources([
    'characters' => CharacterController::class,
    'species' => SpecieController::class,
]);

