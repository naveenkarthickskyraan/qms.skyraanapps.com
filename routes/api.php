<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Middleware\ThrottleRequests;

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

//new Route
Route::get('/app_list_api',[App\Http\Controllers\Api\ApiController::class,'App']);

// Route::any('/get_categories_using_app_id_and_category_id',[App\Http\Controllers\Api\ApiController::class,'get_categories_using_app_id_and_category_id']);

Route::middleware(['throttle:300,1'])->any('/get_categories_using_app_id_and_category_id', [App\Http\Controllers\Api\ApiController::class, 'get_categories_using_app_id_and_category_id']);


Route::any('/get_questions_using_category_id',[App\Http\Controllers\Api\ApiController::class,'get_questions_using_category_id']);

Route::any('/get_direction_based_questions_using_category_id',[App\Http\Controllers\Api\ApiController::class,'get_direction_based_questions_using_category_id']);

Route::any('/get_questions_search_using_app_id',[App\Http\Controllers\Api\ApiController::class,'get_questions_search_using_app_id']);

Route::any('/get_questions_detail',[App\Http\Controllers\Api\ApiController::class,'get_questions_detail']);

Route::any('/get_last_fetched_questions_using_quiz_id',[App\Http\Controllers\Api\ApiController::class,'get_last_fetched_questions_using_quiz_id']);
