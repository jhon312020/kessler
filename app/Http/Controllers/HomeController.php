<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Trainee;
use DB;
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
      $users = User::all();
      $kessler = Auth::user();
      $active = User::where('role', 'TA')->where('status', 1);
      $inactive = User::where('role', 'TA')->where('status', 0);
      $complete = Trainee::where('completed', 1);
      $incomplete = Trainee::where('completed', 0); 
      $kesslerTraineeCount = Trainee::select('trainee_id')->distinct('trainee_id')->count();
      $kesslerInProgressCount = $incomplete->count();
      $kesslerCompletedCount = $complete->count();
      $trainerCount = User::where('role', 'TA')->count();
      $trainerActiveCount = $active->count();
      $trainerInActiveCount = $inactive->count();
      $traineeCount = Trainee::select('trainee_id')->distinct('trainee_id')->where('trainer_id', $kessler->id)->count('trainee_id');
      $traineeInProgressCount = $incomplete->where('trainer_id', $kessler->id)->count();
      $traineeCompletedCount = $complete->where('trainer_id', $kessler->id)->count();
      $traineeTrainer = Trainee::select('trainer_id',DB::raw('count(DISTINCT trainee_id) AS trainee'))->groupBy('trainer_id')->pluck('trainee', 'trainer_id');
      // $this->pr($traineeTrainer->toArray()); exit();
      return view('kessler.admin.dashboard',compact('kessler','kesslerTraineeCount','kesslerInProgressCount', 'kesslerCompletedCount','trainerCount','trainerActiveCount', 'trainerInActiveCount','traineeCount', 'traineeInProgressCount', 'traineeCompletedCount', 'users', 'traineeTrainer'));
    }

    public function logout() {
      Auth::logout();
      return redirect('/login');
    }
}
