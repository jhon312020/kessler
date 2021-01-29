<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\WordsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/logout', [HomeController::class, 'logout']);
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

// ---------------------------------------- ./ ADMIN --------------------------------------------- //
Route::resource('/trainee', TraineeController::class);
Route::get('/trainee/view/{id}', [TraineeController::class, 'view']);
Route::resource('/overviews', OverviewController::class);
Route::resource('/instructions', InstructionController::class);
Route::resource('/story', StoryController::class);
Route::resource('/words', WordsController::class);
// ---------------------------------------- ./ ADMIN --------------------------------------------- //

// ---------------------------------------- / SESSIONS /--------------------------------------------- //
Route::post('/index', [SessionController::class, 'index']);
Route::get('/index', [SessionController::class, 'index']);
Route::get('/', [SessionController::class, 'index']);
Route::get('/sessions',[SessionController::class, 'sessions']);
Route::get('/writings',[SessionController::class, 'writings']);
Route::post('/session',[SessionController::class, 'writeup']);
Route::get('/recallwords', [SessionController::class, 'recall']);
Route::post('/sessions', [SessionController::class,'store']);
Route::post('/session', [SessionController::class,'save']);
Route::get('/session', [SessionController::class,'save']);
Route::post('/next', [AjaxController::class,'store']);
Route::post('/after', [AjaxController::class,'save']);
Route::get('/complete', [SessionController::class,'complete']);
// ---------------------------------------- ./ SESSIONS / ----------------------------------------- //
