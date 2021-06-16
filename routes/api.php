<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'question' => 'App\Http\Controllers\API\QuestionController',
    'aptitude' => 'App\Http\Controllers\API\AptitudeController',
    'logical' => 'App\Http\Controllers\API\LogicalController',
    'technical' => 'App\Http\Controllers\API\TechnicalController'
    ]);