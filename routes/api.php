<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'api'], function ()
{
    // User resources
    Route::group(['prefix' => 'users', 'as' => 'users.'], function ()
    {
        Route::get('{user}/profile', [\App\Http\Controllers\UserController::class, 'get_profile'])->name('get_profile');
        Route::get('{user}/tasks', [\App\Http\Controllers\UserController::class, 'get_tasks'])->name('get_tasks');
    });

    // Project resources
    Route::group(['prefix' => 'projects', 'as' => 'projects.'], function ()
    {
        Route::get('', [\App\Http\Controllers\ProjectController::class, 'index'])->name('index');
        Route::post('', [\App\Http\Controllers\ProjectController::class, 'store'])->name('store');
        Route::get('{project}', [\App\Http\Controllers\ProjectController::class, 'show'])->name('show');
        Route::put('{project}', [\App\Http\Controllers\ProjectController::class, 'update'])->name('update');
        Route::delete('{project}', [\App\Http\Controllers\ProjectController::class, 'destroy'])->name('destroy');
    });

    // Status resources
    Route::group(['prefix' => 'statuses', 'as' => 'statuses.'], function ()
    {
        Route::get('', [\App\Http\Controllers\StatusController::class, 'index'])->name('index');
        Route::post('', [\App\Http\Controllers\StatusController::class, 'store'])->name('store');
        Route::get('{status}', [\App\Http\Controllers\StatusController::class, 'show'])->name('show');
        Route::put('{status}', [\App\Http\Controllers\StatusController::class, 'update'])->name('update');
        Route::delete('{status}', [\App\Http\Controllers\StatusController::class, 'destroy'])->name('destroy');
    });

    // Task resources
    Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function ()
    {
        Route::get('', [\App\Http\Controllers\TaskController::class, 'index'])->name('index');
        Route::post('', [\App\Http\Controllers\TaskController::class, 'store'])->name('store');
        Route::get('{task}', [\App\Http\Controllers\TaskController::class, 'show'])->name('show');
        Route::put('{task}', [\App\Http\Controllers\TaskController::class, 'update'])->name('update');
        Route::delete('{task}', [\App\Http\Controllers\TaskController::class, 'destroy'])->name('destroy');

        Route::put('{task}/status/update', [\App\Http\Controllers\TaskController::class, 'updateStatus'])->name('status_update');
    });
});
