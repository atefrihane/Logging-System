<?php

Route::group(['module' => 'Log', 'middleware' => ['web'], 'namespace' => 'App\Modules\Log\Controllers'], function() {

    Route::resource('Log', 'LogController');

});
