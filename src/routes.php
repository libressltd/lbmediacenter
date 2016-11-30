<?php

Route::group(['middleware' => ['web', 'auth']], function () {
	Route::resource("lbmedia", "libressltd\lbmediacenter\controllers\MediaController");
});


Route::group(['middleware' => ['api', 'auth:api']], function () {
	Route::resource("api/lbmedia", "libressltd\lbmediacenter\controllers\MediaController");
});
