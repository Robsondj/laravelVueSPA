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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('properties', 'PropertyController@index');
Route::group(['prefix' => 'property'], function () {
    Route::post('store', 'PropertyController@store');
    Route::get('edit/{id}', 'PropertyController@edit');
    Route::get('states', 'PropertyController@getStates');
    Route::post('update/{id}', 'PropertyController@update');
    Route::delete('delete/{id}', 'PropertyController@delete');
});