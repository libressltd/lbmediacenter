<?php

Route::group(['middleware' => 'web'], function () {
	Route::resource("lbmedia", "libressltd\lbmediacenter\controllers\MediaController");
});
