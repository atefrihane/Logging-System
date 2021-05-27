<?php

Route::group(['module' => 'Log', 'middleware' => ['api'], 'namespace' => 'App\Modules\Log\Controllers'], function () {
    Route::post('/log/start', 'LogControllerApi@handleStartLog');
    Route::post('/log/end', 'LogControllerApi@handleEndLog');
    Route::get('/logs/filter', 'LogControllerApi@handleFilterLogs');
});
