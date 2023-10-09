<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\TaskController::class, 'viewTask']);

Route::get('view-tasks', [App\Http\Controllers\TaskController::class, 'viewTask']);
Route::post('save-task', [App\Http\Controllers\TaskController::class, 'saveTask'])->name('save_task');
Route::get('edit/{id}', [App\Http\Controllers\TaskController::class, 'editTask']);
Route::post('update-task/{id}', [App\Http\Controllers\TaskController::class, 'updateTask']);
Route::get('delete/{id}', [App\Http\Controllers\TaskController::class, 'deleteTask']);
Route::post('/update-task-priority', [App\Http\Controllers\TaskController::class, 'updateTaskPriority'])->name('update_task_priority');

