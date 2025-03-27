<?php

use App\Http\Action\User\CreateUserPostAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('auth')->group(function() {
    Route::post('/user/create', CreateUserPostAction::class)->name('user.create');
});
