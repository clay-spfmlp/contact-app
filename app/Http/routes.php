<?php

use Bican\Roles\Models\Role;

Route::group(['middleware' => 'web'], function () {

	Route::auth();

	Route::resource('contact', 'ContactController');

    Route::resource('label', 'LabelController');

    Route::group(['middleware' => 'role:admin'], function () {

    	Route::get('admin', [
    		'as' => 'admin',
    		'uses' => 'AdminController@index'
    	]);

	    Route::resource('role', 'RoleController');

	    Route::resource('permission', 'PermissionController');

	    Route::get('permissions', [
	    	'as' => 'permissions', 
	    	'uses' => 'PermissionController@permissions'
	    ]);

	    Route::get('roles', [
	    	'as' => 'roles', 
	    	'uses' => 'PermissionController@roles'
	    ]);

	    Route::get('model-details', [
	    	'as' => 'model.details',
	    	'uses' => 'AdminController@modelDetails'
	    ]);

	    Route::post('update-role',[
	    	'as' => 'update.role',
	    	'uses' => 'PermissionController@updateRole'
	    ]);

    });



	Route::get('/', function () { 
		return view('landing.index'); 
	});

	Route::get('movies', function () { 
		return view('movie.index'); 
	});

	Route::get('theater/{zipCode?}', [
		'as' => 'theater', 
		'uses' => 'TheaterController@getTheaters'
	]);

    Route::get('home', [
    	'as' => 'home', 
    	'uses' => 'HomeController@index'
    ]);

    Route::get('contacts', [
    	'middleware' => 'auth', 
    	'as' => 'contact', 
    	'uses' => 'ContactController@contacts'
    ]);

    Route::post('contacts/delete', [
    	'middleware' => 'auth', 
    	'as' => 'contacts.delete.check', 
    	'uses' => 'ContactController@deleteCheck'
    ]);

    Route::post('contacts/label', [
    	'middleware' => 'auth', 
    	'as' => 'contacts.add.label', 
    	'uses' => 'ContactController@addLabel'
    ]);

    Route::get('user/{user_id}/contacts', [
    	'as' => 'user.contacts', 
    	'uses' => 'ContactController@userContacts'
    ]);

    Route::get('user/{user_id}/labels', [
    	'as' => 'user.labels', 
    	'uses' => 'LabelController@userLabels'
    ]);

    Route::get('equilibrium-indexs', [
    	'as' => 'equilibrium', 
    	'uses' => 'EquilibriumController@index'
    ]);

    Route::post('equilibrium-indexs', [
    	'as' => 'equilibrium.post', 
    	'uses' => 'EquilibriumController@equilibrium'
    ]);

});


Route::group(['middleware' => 'api'], function () {

});