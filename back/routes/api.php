<?php

use App\Http\Action\Task\CreateTaskPostAction;

use App\Http\Action\Task\DeleteTaskAction;
use App\Http\Action\Task\EditTaskPutAction;
use App\Http\Action\Task\TaskByStatusGetAction;
use App\Http\Action\Task\TaskByUserGetAction;
use App\Http\Action\User\MeGetAction;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->prefix('task')->group(function () {
    Route::post('/create', CreateTaskPostAction::class)->name('task.create');
    Route::put('/update/{task}', EditTaskPutAction::class)->name('task.update');
    Route::delete('/delete/{task}', DeleteTaskAction::class)->name('task.delete');
    Route::get('/filtered', TaskByStatusGetAction::class)->name('tasks.filtered');
    Route::get('/all', TaskByUserGetAction::class)->name('tasks.filtered');
});

Route::middleware('auth:sanctum')->prefix('system')->group(function () {
    Route::get('/me', MeGetAction::class)->name('tasks.filtered');
});
