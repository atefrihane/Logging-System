<?php
Route::group(['module' => 'General', 'middleware' => ['web', 'guest'], 'namespace' => 'App\Modules\General\Controllers'], function () {

    Route::view('/login', 'General::showLogin')->name('showLogin');
});

Route::group(['module' => 'General', 'middleware' => ['web', 'auth'], 'namespace' => 'App\Modules\General\Controllers'], function () {

    Route::get('/', 'GeneralController@showHome')->name('showHome');
});
