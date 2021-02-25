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
      $kesslerTrainee = Trainee::all();
      //$this->pr($kesslerTrainee->toArray()); exit();
      $kesslerTraineeCount = $kesslerTrainee->count();
      //$this->pr($kesslerTraineeCount); //exit();
      $kesslerInProgress = Trainee::where('completed', 0)->get();
      //$this->pr($kesslerInProgress->toArray()); exit();
      $kesslerInProgressCount = $kesslerInProgress->count();
      //$this->pr($kesslerInProgressCount); //exit();
      $kesslerCompleted = Trainee::where('completed', 1)->get();
      //$this->pr($kesslerInProgress->toArray()); exit();
      $kesslerCompletedCount = $kesslerCompleted->count();
      //$this->pr($kesslerCompletedCount); exit();
      $trainerID = Trainee::select('trainer_id')->where('trainer_id', $kessler->id)->get();
      //$this->pr($trainerID->toArray()); exit();
      $trainer = User::where('role', 'TA')->get();
      //$this->pr($trainer->toArray()); exit();
      $trainerCount = $trainer->count();
      //$this->pr($trainerCount); exit();
      $trainerActive = User::where('role', 'TA')->where('status', 1)->get();
      //$this->pr($trainerActive->toArray()); exit();
      $trainerInActive = User::where('role', 'TA')->where('status', 0)->get();
      //$this->pr($trainerInActive->toArray()); exit();
      $trainerActiveCount = $trainerActive->count();
      //$this->pr($trainerActiveCount); exit();
      $trainerInActiveCount = $trainerInActive->count();
      //$this->pr($trainerInActiveCount); exit();
      $trainee = Trainee::where('trainer_id', $kessler->id)->get();
      //$this->pr($trainee->toArray()); exit();
      $traineeCount = $trainee->count();
      //$this->pr($traineeCount); exit();
      $traineeInProgress = Trainee::where('completed', 0)->where('trainer_id', $kessler->id)->get();
      //$this->pr($traineeInProgress->toArray()); exit();
      $traineeInProgressCount = $traineeInProgress->count();
      //$this->pr($traineeInProgressCount); exit();
      $traineeCompleted = Trainee::where('completed', 1)->where('trainer_id', $kessler->id)->get();
      //$this->pr($traineeCompleted->toArray()); exit();
      $traineeCompletedCount = $traineeCompleted->count();
      //$this->pr($traineeCompletedCount); exit();
      return view('kessler.admin.dashboard',compact('kessler','kesslerTraineeCount','kesslerInProgressCount', 'kesslerCompletedCount', 'trainer','trainerCount','trainerActiveCount', 'trainerInActiveCount','trainee','traineeCount', 'traineeInProgressCount', 'traineeCompletedCount'));
    }

    public function logout() {
      Auth::logout();
      return redirect('/login');
    }
}
