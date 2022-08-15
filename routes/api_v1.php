<?php

use App\Http\Controllers\Api\V1\Users\ListUsersApiController;
use App\Http\Controllers\Api\V1\Users\StoreUserApiController;
use App\Http\Controllers\Api\V1\Users\UpdateUserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {

    // user api endpoints
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', ListUsersApiController::class)->name('list');
        Route::post('/', StoreUserApiController::class)->name('store');
        Route::put('{user}', UpdateUserApiController::class)->name('update');
    });
});
