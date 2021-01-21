<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AdminController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/home', [SessionsController::class, 'index']);
Route::get('/home', [SessionsController::class, 'index']);
Route::get('/sessions',[SessionsController::class, 'sessions']);
Route::get('/recallwords', [SessionsController::class, 'recall']);
Route::post('/sessions', [SessionsController::class,'store']);
Route::post('/next', [AjaxController::class,'store']);
Route::get('/complete', [SessionsController::class,'complete']);
Route::get('/admin', [AdminController::class,'index']);