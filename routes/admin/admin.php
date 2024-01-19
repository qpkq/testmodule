<?php

namespace AdminDatabaseProvider;

use Illuminate\Support\Facades\Route;
use Http\Controllers\Admin\DatabaseController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

//Route::get('/admin', [DatabaseController::class, 'index']);

Route::group(['prefix' => 'api', 'middleware' => []], function () {
    Route::get('/admin', [DatabaseController::class, 'index']);
});

//Route::group(["prefix" => "api", 'middleware' => ['web']], function () {
//    Route::group(["prefix" => "dashboard"], function () {
//        Route::group(["prefix" => "v1"], function () {
//            Route::group(['middleware' => ['auth.api', 'auth.url', 'check.permissions', 'check.devices']], function () {
//                /*
//                 * Blog
//                 */
//                Route::group(["prefix" => "blog"], function () {
//                    Route::group(["prefix" => "categories"], function () {
//                        Route::get('/', [CategoryController::class, 'get'])->name('dashboard.blog.get');
//                        Route::get('/view', [CategoryController::class, 'view'])->name('dashboard.blog.categories_view');
//                        Route::post('/create', [CategoryController::class, 'create'])->name('dashboard.blog.categories_create');
//                        Route::post('/update', [CategoryController::class, 'update'])->name('dashboard.blog.categories_update');
//                        Route::post('/delete', [CategoryController::class, 'delete'])->name('dashboard.blog.categories_delete');
//                    });
//
//                    Route::group(["prefix" => "posts"], function () {
//                        Route::get('/', [PostController::class, 'get'])->name('dashboard.blog.get');
//                        Route::get('/view', [PostController::class, 'view'])->name('dashboard.blog.posts_view');
//                        Route::post('/create', [PostController::class, 'create'])->name('dashboard.blog.posts_create');
//                        Route::post('/update', [PostController::class, 'update'])->name('dashboard.blog.posts_update');
//                        Route::post('/delete', [PostController::class, 'delete'])->name('dashboard.blog.posts_delete');
//                    });
//
//                    Route::group(["prefix" => "tags"], function () {
//                        Route::get('/', [PostsTagController::class, 'get'])->name('dashboard.tags.get');
//                    });
//                });
//            });
//        });
//    });
//});
