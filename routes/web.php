<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TraineeSessionController;
use App\Http\Controllers\StorySessionController;
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

// ---------------------------------------- ./ ADMIN ---------------------------------------------------- //
Route::resource('/trainee', TraineeController::class);
Route::get('/trainee/view/{id}', [TraineeController::class, 'view']);
Route::resource('/overviews', OverviewController::class);
Route::resource('/instructions', InstructionController::class);
Route::resource('/story', StoryController::class);
Route::resource('/words', WordsController::class);
Route::resource('/StorySession', StorySessionController::class);

// ---------------------------------------- ./ ADMIN --------------------------------------------- //

// ---------------------------------------- / SESSIONS PIN /--------------------------------------------- //
Route::post('/index', [TraineeSessionController::class, 'index']);
Route::get('/index', [TraineeSessionController::class, 'index']);
Route::get('/', [TraineeSessionController::class, 'index']);
// ---------------------------------------- / SESSIONS PIN /--------------------------------------------- //

// ---------------------------------------- / SESSIONS 1-4 /--------------------------------------------- //
Route::get('/trainee/sessions',[TraineeSessionController::class, 'sessions']);
Route::get('/recallwords', [TraineeSessionController::class, 'recall']);
Route::post('/sessions', [TraineeSessionController::class,'store']);
Route::post('/next', [AjaxController::class,'store']);
Route::get('/complete', [TraineeSessionController::class,'complete']);
// ---------------------------------------- ./ SESSIONS 1-4 / ------------------------------------------- //

// ---------------------------------------- / SESSIONS 5-8 /--------------------------------------------- //
Route::get('/writings',[TraineeSessionController::class, 'writings']);
Route::post('/story',[TraineeSessionController::class, 'writeup']);
Route::get('/recallwords', [TraineeSessionController::class, 'recall']);
Route::post('/cue', [TraineeSessionController::class,'save']);
Route::get('/cue', [TraineeSessionController::class,'save']);
Route::post('/after', [AjaxController::class,'save']);

// ---------------------------------------- ./ SESSIONS 5-8 /-------------------------------------------- //
