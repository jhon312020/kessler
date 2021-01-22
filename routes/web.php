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

Auth::routes();

Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout']);
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// ---------------------------------------- ./ ADMIN --------------------------------------------- //
Route::resource('/traineejourney', 'App\Http\Controllers\TraineeJourneyController');
Route::get('/traineejourney/view/{id}', [TraineeJourneyController::class, 'view']);
Route::resource('/overviews', 'App\Http\Controllers\OverviewsController');
Route::resource('/instructions', 'App\Http\Controllers\InstructionsController');
Route::resource('/story', 'App\Http\Controllers\StoryController');
Route::resource('/words', 'App\Http\Controllers\WordsController');
// ---------------------------------------- ./ ADMIN --------------------------------------------- //

// ---------------------------------------- / SESSIONS /--------------------------------------------- //
Route::post('/home', [SessionsController::class, 'index']);
Route::get('/home', [SessionsController::class, 'index']);
Route::get('/sessions',[SessionsController::class, 'sessions']);
Route::get('/recallwords', [SessionsController::class, 'recall']);
Route::post('/sessions', [SessionsController::class,'store']);
Route::post('/next', [AjaxController::class,'store']);
Route::get('/complete', [SessionsController::class,'complete']);
// ---------------------------------------- ./ SESSIONS / ----------------------------------------- //