<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxCrudController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('ajaxCrud');
// });
// Route::get('/user', [UserController::class, 'index']);

Route::get('/', [AjaxCrudController::class, 'index']);
// Route::get('todos/{todo}/edit',[AjaxCrudController::class, 'edit']);
Route::get('todos/{todo}/edit', [AjaxCrudController::class, 'edit']);
// Route::get('todos/store', [AjaxCrudController::class, 'store']);
Route::post('todos/store', [AjaxCrudController::class, 'store']);
// Route::delete('todos/destroy/{todo}', [AjaxCrudController::class, 'destroy']);
Route::delete('todos/destroy/{id}', [AjaxCrudController::class, 'destroy']);