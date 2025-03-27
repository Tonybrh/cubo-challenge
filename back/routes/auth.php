<?php

use App\Http\Action\User\CreateUserPostAction;
use App\Http\Action\User\LoginUserPostAction;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function() {
    Route::post('/user/create', CreateUserPostAction::class)->name('user.create');
    Route::post('/user/login', LoginUserPostAction::class)->name('user.login');
});
