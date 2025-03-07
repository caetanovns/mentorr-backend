<?php

use App\Http\Controllers\MentorController;
use Illuminate\Support\Facades\Route;
/*
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
*/

Route::get('/mentors', [MentorController::class, 'index']);
Route::get('/mentors/{mentor}', [MentorController::class, 'show']);
Route::post('/mentors', [MentorController::class, 'store']);
Route::delete('/mentors/{mentor}', [MentorController::class, 'delete']);
//Route::patch('/mentors', []);


