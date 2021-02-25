<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TraineeSessionController;
use App\Http\Controllers\BoosterController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\ToDoController;

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
//Trainer Admin
Route::group(['middleware' => 'auth'], function() {
  Route::resource('/trainee', TraineeController::class);
	Route::get('/trainee/view/{id}', [TraineeController::class, 'view']);
	Route::post('/trainee/add/{id}', [TraineeController::class, 'add'])->name('trainee.add');
	Route::get('/trainee/add/{id}', [TraineeController::class, 'add']);
	Route::get('/trainee/report/{id}', [TraineeController::class, 'report']);
	Route::get('/trainee/approve/{id}', [TraineeController::class, 'review']);
	Route::post('/trainee/approve/{id}', [TraineeController::class, 'review']);
	Route::post('/trainee/approve/{id}', [TraineeController::class, 'revise']);
});
//Super Admin Role
Route::group(['middleware' => 'App\Http\Middleware\SuperAdminMiddleware'], function() {

	Route::resource('/trainer', TrainerController::class);
	Route::post('/trainer/status/{id}', [TrainerController::class, 'status'])->name('trainer.status');
	Route::resource('/overview', OverviewController::class);
	Route::resource('/instruction', InstructionController::class);
	Route::resource('/story', StoryController::class);
	Route::resource('/word', WordController::class);
	Route::resource('/type', TypeController::class);
	Route::resource('/booster', BoosterController::class);
	Route::resource('/quiz', QuizController::class);
	Route::resource('/shopping', ShoppingController::class);
	Route::resource('/direction', DirectionController::class);
	Route::resource('/todo', ToDoController::class);
});

// ---------------------------------------- ./ ADMIN ----------------------------------------------------------- //

// ---------------------------------------- / SESSIONS 1-4 /---------------------------------------------------- //
Route::get('/', [TraineeSessionController::class, 'index'])->name('/');
Route::post('/', [TraineeSessionController::class, 'index']);
Route::get('/home', [TraineeSessionController::class, 'index'])->name('home');
Route::post('/home', [TraineeSessionController::class, 'index']);
Route::post('/index', [TraineeSessionController::class, 'index'])->name('index');;
Route::get('/index', [TraineeSessionController::class, 'index']);
Route::get('/sessions',[TraineeSessionController::class, 'sessions']);
Route::get('/recallwords', [TraineeSessionController::class, 'remember']);
Route::post('/sessions', [TraineeSessionController::class,'store']);
Route::post('/next', [AjaxController::class,'store']);
Route::get('/complete', [TraineeSessionController::class,'complete']);
// ---------------------------------------- ./ SESSIONS 1-4 / -------------------------------------------------- //

// ---------------------------------------- / SESSIONS 5-8 /---------------------------------------------------- //
Route::get('/write',[TraineeSessionController::class, 'writing']);
Route::get('/review',[TraineeSessionController::class, 'review']);
Route::post('/read',[TraineeSessionController::class, 'writeup']);
Route::get('/recallword', [TraineeSessionController::class, 'recollect']);
Route::post('/cue', [TraineeSessionController::class,'save']);
Route::get('/cue', [TraineeSessionController::class,'cue']);
Route::post('/after', [AjaxController::class,'save']);
//Route::get('/finish', [TraineeSessionController::class,'finish']);
// ---------------------------------------- ./ SESSIONS 5-8 /--------------------------------------------------- //
