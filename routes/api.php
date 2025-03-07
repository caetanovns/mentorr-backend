<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MentorController;
use App\Http\Middleware\APIAuth;
use Illuminate\Support\Facades\Route;

/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/
/*
Route::get('/mentors', [MentorController::class, 'index']);
Route::get('/mentors/{mentor}', [MentorController::class, 'show']);
Route::post('/mentors', [MentorController::class, 'store']);
Route::delete('/mentors/{mentor}', [MentorController::class, 'delete']);
*/

Route::post('/login', [LoginController::class, 'authenticate'])
    ->withoutMiddleware(APIAuth::class);


Route::prefix('/mentors')->middleware('api_auth')->group(function () {
    Route::get('/', [MentorController::class, 'index']);
    Route::get('/{mentor}', [MentorController::class, 'show']);
    Route::post('/', [MentorController::class, 'store']);
    Route::delete('/{mentor}', [MentorController::class, 'delete']);
});
