<?php

use App\Http\Controllers\Task\IndexController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Task', 'prefix' => 'tasks'], function () {
    Route::get('/', [IndexController::class, 'index'])->name('tasks.index');
    Route::post('/', [IndexController::class, 'store'])->name('tasks.store');
    Route::get('/{task}', [IndexController::class, 'show'])->name('tasks.show');
    Route::put('/{task}', [IndexController::class, 'update'])->name('tasks.update');
    Route::delete('/{task}', [IndexController::class, 'delete'])->name('tasks.delete');
});
