<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Trainee;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
      $this->middleware('auth');
      parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
      $kessler = User::where('role', 'SA')->get();
      //$this->pr($kessler->toArray()); //exit();
      $user = Auth::user();
      $trainerID = Trainee::select('trainer_id')->where('trainer_id', $user->id)->get();
      //$this->pr($trainerID->toArray()); exit();
      $trainer = User::where('role', 'TA')->get();
      //$this->pr($trainer->toArray()); exit();
      $trainerCount = $trainer->count();
      $trainee = Trainee::where('trainer_id', $user->id)->get();
      //$this->pr($trainee->toArray()); exit();
      $traineeCount = $trainee->count();
      $traineeInProgress = Trainee::where('completed', 0)->where('trainer_id', $user->id)->get();
      $traineeInProgressCount = $traineeInProgress->count();
      $traineeCompleted = Trainee::where('completed', 1)->where('trainer_id', $user->id)->get();
      $traineeCompletedCount = $traineeCompleted->count();
      return view('kessler.admin.dashboard',compact('kessler','trainer','trainerCount','trainee','traineeCount', 'traineeInProgressCount', 'traineeCompletedCount'));
    }

    public function logout() {
      Auth::logout();
      return redirect('/login');
    }
}
