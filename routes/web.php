<?php

use Botble\Base\Facades\AdminHelper;
use Botble\InstantNotifier\Http\Controllers\InstantNotifierController;
use Botble\InstantNotifier\Http\Controllers\InstantNotifierSettingController;
use Illuminate\Support\Facades\Route;

AdminHelper::registerRoutes(function () {
    Route::group(['prefix' => 'instantnotifiers', 'as' => 'instantnotifier.'], function () {
        Route::resource('', InstantNotifierController::class)->parameters(['' => 'instantnotifier']);
    });

    Route::group([
        'prefix' => 'settings/instantnotifier',
        'as' => 'instantnotifier.settings',
        'permission' => 'instantnotifier.settings',
    ], function () {
        Route::get('/', [
            'uses' => InstantNotifierSettingController::class . '@edit',
        ]);

        Route::put('/', [
            'as' => '.update',
            'uses' => InstantNotifierSettingController::class . '@update',
        ]);
    });
    
});
