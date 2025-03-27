<?php

use App\Http\Action\Task\CreateTaskPostAction;

use App\Http\Action\Task\DeleteTaskAction;
use App\Http\Action\Task\EditTaskPutAction;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('task')->group(function () {
    Route::post('/create', CreateTaskPostAction::class)->name('task.create');
    Route::put('/update/{task}', EditTaskPutAction::class)->name('task.update');
    Route::delete('/delete/{task}', DeleteTaskAction::class)->name('task.delete');
});
