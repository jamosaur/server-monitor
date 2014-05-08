<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => '', 'uses' => 'ServerController@getServerData'));

Route::get('serverinfo/{ip}/{port}', array('as' => '', 'uses' => 'ServerController@getServerInfo'));

Route::get('temp', function(){
    return View::make('template'); 
});