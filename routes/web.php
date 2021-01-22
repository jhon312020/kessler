<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OverviewsController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\InstructionsController;
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
Route::resource('/overviews', OverviewsController::class);
Route::resource('/instructions', InstructionsController::class);
Route::resource('/story', StoryController::class);
Route::resource('/words', WordsController::class);
// ---------------------------------------- ./ ADMIN --------------------------------------------- //

// ---------------------------------------- / SESSIONS /--------------------------------------------- //
Route::post('/index', [SessionsController::class, 'index']);
Route::get('/', [SessionsController::class, 'index']);
Route::get('/sessions',[SessionsController::class, 'sessions']);
Route::get('/recallwords', [SessionsController::class, 'recall']);
Route::post('/sessions', [SessionsController::class,'store']);
Route::post('/next', [AjaxController::class,'store']);
Route::get('/complete', [SessionsController::class,'complete']);
// ---------------------------------------- ./ SESSIONS / ----------------------------------------- //