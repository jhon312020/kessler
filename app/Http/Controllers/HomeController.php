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
      $kessler = Auth::user();
      //$this->pr($kessler->toArray()); exit();
      $trainerID = Trainee::select('trainer_id')->where('trainer_id', $kessler->id)->get();
      //$this->pr($trainerID->toArray()); exit();
      $trainer = User::where('role', 'TA')->get();
      //$this->pr($trainer->toArray()); exit();
      $trainerCount = $trainer->count();
      //$this->pr($trainee->toArray()); exit();
      $trainee = Trainee::where('trainer_id', $kessler->id)->get();
      //$this->pr($trainerCount->toArray()); exit();
      $traineeCount = $trainee->count();
      //$this->pr($traineeCount->toArray()); exit();
      $traineeInProgress = Trainee::where('completed', 0)->where('trainer_id', $kessler->id)->get();
      //$this->pr($traineeInProgress->toArray()); exit();
      $traineeInProgressCount = $traineeInProgress->count();
      //$this->pr($traineeInProgressCount->toArray()); exit();
      $traineeCompleted = Trainee::where('completed', 1)->where('trainer_id', $kessler->id)->get();
      //$this->pr($traineeCompleted->toArray()); exit();
      $traineeCompletedCount = $traineeCompleted->count();
      //$this->pr($traineeCompletedCount->toArray()); exit();
      return view('kessler.admin.dashboard',compact('kessler','trainer','trainerCount','trainee','traineeCount', 'traineeInProgressCount', 'traineeCompletedCount'));
    }

    public function logout() {
      Auth::logout();
      return redirect('/login');
    }
}
