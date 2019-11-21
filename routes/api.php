<?php

use Illuminate\Http\Request;



Route::group(['middleware' => 'admin',  'namespace' => 'Api'], function (){




});

Route::group(['middleware' => 'admin', 'prefix' => 'panel', 'namespace' => 'Api'], function () {


    Route::resource('/students', 'StudentsController');

});
