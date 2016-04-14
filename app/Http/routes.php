<?php

use Bican\Roles\Models\Role;

Route::group(['middleware' => 'web'], function () {

	Route::get('/', function () { 

		return view('landing.index'); 

	});

	Route::get('movies', function () { return view('movie.index'); });

	Route::get('theater/{zipCode?}', ['as' => 'theater', 'uses' => 'TheaterController@getTheaters']);

    Route::auth();

    Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('contacts', ['middleware' => 'auth', 'as' => 'contact', 'uses' => 'ContactController@contacts']);

    Route::resource('contact', 'ContactController');

    Route::resource('label', 'LabelController');

    Route::get('user/{user_id}/contacts', ['as' => 'user.contacts', 'uses' => 'ContactController@userContacts']);

    Route::get('user/{user_id}/labels', ['as' => 'user.labels', 'uses' => 'LabelController@userLabels']);

    Route::get('equilibrium', ['as' => 'equilibrium', 'uses' => 'EquilibriumController@index']);

    Route::post('equilibrium', ['as' => 'equilibrium.post', 'uses' => 'EquilibriumController@equilibrium']);

});


Route::group(['middleware' => 'api'], function () {

});