<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Api'], function (){

    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('/login', 'Auth\LoginController@login');

});


Route::group(['middleware' => 'auth:api',  'namespace' => 'Api'], function (){

    Route::get('/profile', 'UsersController@profile');

    Route::patch('/profile', 'UsersController@updateProfile');

    Route::post('/students', 'StudentsController@addByParent');

});

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'namespace' => 'Api'], function () {

    Route::resource('/students', 'StudentsController');

});


Route::fallback(function(){
    return response()->json([
        'message' => 'Sayfa bulunamadı. Sistem yöneticisiyle iletişime geçin'], 404);
});
