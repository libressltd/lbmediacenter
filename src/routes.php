<?php

Route::group(['middleware' => ['web', 'auth']], function () {
	Route::post("lbmedia", "libressltd\lbmediacenter\controllers\MediaController@store");
});
Route::get("lbmedia/{media_id}", "libressltd\lbmediacenter\controllers\MediaController@show");


Route::group(['middleware' => ['api', 'auth:api']], function () {
	Route::resource("api/lbmedia", "libressltd\lbmediacenter\controllers\MediaController");
});
