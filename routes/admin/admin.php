<?php

namespace AdminDatabaseProvider;

use AdminDatabaseProvider\Http\Controllers\Admin\DatabaseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'middleware' => ['admin.panel']], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/tables', [DatabaseController::class, 'getTables']);
        Route::get('/table', [DatabaseController::class, 'getTable']);
        Route::get('/table/columns', [DatabaseController::class, 'getTableColumns']);
        Route::get('/table/sort', [DatabaseController::class, 'sortTable']);
        Route::get('/table/search', [DatabaseController::class, 'search']);
        Route::post('/record/create', [DatabaseController::class, 'createRecord']);
        Route::post('/record/update', [DatabaseController::class, 'updateRecord']);
        Route::delete('/record/delete', [DatabaseController::class, 'destroyRecord']);
    });
});