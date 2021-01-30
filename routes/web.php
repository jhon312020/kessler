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
use App\Http\Controllers\WordController;

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

// ---------------------------------------- ./ ADMIN ----------------------------------------------------------- //
Route::resource('/trainee', TraineeController::class);
Route::get('/trainee/view/{id}', [TraineeController::class, 'view']);
Route::resource('/overview', OverviewController::class);
Route::resource('/instruction', InstructionController::class);
Route::resource('/story', StoryController::class);
Route::resource('/word', WordController::class);
Route::resource('/StorySession', StorySessionController::class);

// ---------------------------------------- ./ ADMIN ----------------------------------------------------------- //

// ---------------------------------------- / SESSIONS PIN /---------------------------------------------------- //
Route::post('/', [TraineeSessionController::class, 'index']);
Route::get('/', [TraineeSessionController::class, 'index']);
// ---------------------------------------- / SESSIONS PIN /---------------------------------------------------- //

// ---------------------------------------- / SESSIONS 1-4 /---------------------------------------------------- //
Route::get('/sessions',[TraineeSessionController::class, 'sessions']);
Route::get('/recallwords', [TraineeSessionController::class, 'remember']);
Route::post('/sessions', [TraineeSessionController::class,'store']);
Route::post('/next', [AjaxController::class,'store']);
Route::get('/complete', [TraineeSessionController::class,'complete']);
// ---------------------------------------- ./ SESSIONS 1-4 / -------------------------------------------------- //

// ---------------------------------------- / SESSIONS 5-8 /---------------------------------------------------- //
Route::get('/writing',[TraineeSessionController::class, 'writing']);
Route::post('/story',[TraineeSessionController::class, 'writeup']);
Route::get('/recallword', [TraineeSessionController::class, 'recollect']);
Route::post('/cue', [TraineeSessionController::class,'save']);
Route::get('/cue', [TraineeSessionController::class,'save']);
Route::post('/after', [AjaxController::class,'save']);
Route::get('/complete', [TraineeSessionController::class,'complete']);
// ---------------------------------------- ./ SESSIONS 5-8 /--------------------------------------------------- //
