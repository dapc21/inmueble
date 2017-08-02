<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Layout (Login)
|--------------------------------------------------------------------------
*/
Route::get('/', ['as'=>'login','uses'=>'LogController@getLogin']); //index @ LogController (GET)
Route::post('login', ['as' => 'login', 'uses' => 'LogController@postLogin']); //login @ LogController (POST)

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {
	Route::get('api', ['as' => 'api', 'uses' => 'DashboardController@index']); //Home
	Route::post('logout', ['as' => 'logout', 'uses' => 'LogController@logout']); //Salida del sistema
	Route::get('error/404', ['as'=>'error404','uses'=>'ErrorController@error404']); //ErrorController @ error404 (GET)
	Route::resource('panel','PanelController'); //Panel
	Route::get('properties/showProperties','PropertyController@showProperties'); //showProperties @ PropertyController (GET)
	Route::get('properties/editProperties','PropertyController@editProperties'); //editProperties @ PropertyController (GET)
	Route::get('properties/listProperties','PropertyController@listProperties'); //listProperties @ PropertyController (GET)
	Route::resource('properties','PropertyController'); //Inmuebles
	Route::get('statuses/all', ['as'=>'statuses.all','uses'=>'StatusController@allStatuses']); //allStatuses @ StatusController (GET)
	Route::get('facilities/all', ['as'=>'facilities.all','uses'=>'FacilityController@allFacilities']); //allFacilities @ FacilityController (GET)
});
