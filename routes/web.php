<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

 Route::get('/', [TaskController::class, 'index']);
 Route::prefix('task/')->name('task.')->group(function () {
 Route::post('store',  [TaskController::class, 'store'])->name('store');
 Route::get('edit/{id}',  [TaskController::class, 'edit'])->name('edit');
 //my update is supposed to be a PUT request but i had to use post for some reason
 Route::post('update/{id}',  [TaskController::class, 'update'])->name('update');
 Route::get('list',  [TaskController::class, 'list'])->name('list');
 Route::get('filter/{id}',  [TaskController::class, 'filter'])->name('filter');
 Route::delete('destroy/{id}',  [TaskController::class, 'destroy'])->name('destroy');
});
