<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Http\Requests\PostStoreRequest;
Use App\Http\Requests\PostUpdateRequest;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('posts')->group(function() {
    Route::get('/index',[PostController::class,'index']);
    Route::post('/store',[PostController::class,'store']);
    Route::get('/show/{id}',[PostController::class,'show']);
    Route::put('/update/{id}',[PostController::class,'update']);
    Route::delete('/delete/{id}',[PostController::class,'delete']);
});
