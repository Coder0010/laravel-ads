<?php

use MKamelMasoud\Ads\Http\Controllers\AdController;
use MKamelMasoud\Ads\Http\Controllers\CategoryController;
use MKamelMasoud\Ads\Http\Controllers\TagController;

Route::group(['prefix' => 'api'], function () {
    Route::resource('ads', AdController::class)->only('index', 'show');
    Route::resource('tags', TagController::class)->except('create', 'edit');
    Route::resource('categories', CategoryController::class)->except('create', 'edit');
});
