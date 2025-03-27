<?php

use App\Http\Action\Task\CreateTaskPostAction;

use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('task')->group(function () {
    Route::post('/create', CreateTaskPostAction::class)->name('task.create');
});
