<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FilterController;
use App\Http\Controllers\MyController\NDGKController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('getMaHK', [FilterController::class, 'filterHocKy'] );
Route::post('filterClass', [FilterController::class, 'filterClass']);
Route::post('filterStudent', [FilterController::class, 'filterStudent']);
Route::post('filterScore', [FilterController::class, 'filterScore']);
Route::post('filterRating', [FilterController::class, 'filterRating']);
Route::post('filterRatingByScore', [FilterController::class, 'filterRatingByScore']);
Route::post('filterSemester', [FilterController::class, 'filterSemester']);


//detete chophepnhapdiem
Route::delete('chophepnhapdiem/{id}/delete', [NDGKController::class, 'delete']);
