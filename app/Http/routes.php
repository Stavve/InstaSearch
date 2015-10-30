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


//Binds the Interface to the InstagramWebService
App::bind('Acme\WebService\InstagramWebServiceInterface','Acme\InstagramWebService');
App::bind('Acme\Repository\IRepository','Acme\Repository\PhotoRepository');

Route::get('location','MainController@index');

Route::get('popular','MainController@apiJsonResponse');


Route::get('popular-photos',[
	'as'=>'photos',
	'uses'=>'MainController@photos'
]);

Route::get('tags',[
	'as'=>'tags',
	'uses'=>'MainController@tags'
]);


Route::group(['before' =>'csrf'],function(){

		Route::post('location',[
			'as' => 'location',
			'uses' =>'MainController@getPhotosByLocation'
		]);


		Route::post('tags',[
			'as'=>'tags',
			'uses'=>'MainController@getPhotoByTag'
		]);


});

