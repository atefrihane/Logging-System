<?php

Route::group(['module' => 'General', 'middleware' => ['web', 'auth'], 'namespace' => 'App\Modules\User\Controllers'], function () {

    Route::get('/logout', 'UserController@handleLogout')->name('handleLogout');
});


Route::group(['module' => 'General', 'middleware' => ['web', 'guest'], 'namespace' => 'App\Modules\User\Controllers'], function () {

    Route::post('/login', 'UserController@handleLogin')->name('handleLogin');

});

