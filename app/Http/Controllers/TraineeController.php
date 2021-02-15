<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainee;
use App\Models\TraineeStory;
use App\Models\Story;
use App\Models\TraineeTransaction;
use App\Models\Word;
use App\Models\Type;
use Auth;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    var $totalSessions = array();
    var $user = null;
    public function __construct() {
      parent::__construct();
      $this->totalSessions = range(1, 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
      $user = Auth::user();
      $queryObj = Trainee::select('id', 'trainee_id','session_pin', 'session_type', 'session_number', 'session_current_position','session_state');
      if ($user->role != "SA") {
        $queryObj = $queryObj->where('trainer_id', $user->id);
      }
      $trainees = $queryObj->get();
      $types = Type::pluck('type', 'id');
      return view('kessler.trainee.index', compact('trainees', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $totalSessions = $this->totalSessions;
      $types = Type::all();
      return view('kessler.trainee.create', compact('totalSessions','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
      $request->validate([
        'trainee_id'=>'required',
        'session_type'=>'required',
        'session_number'=>'required'
      ]);
      $session_pin = mt_rand(100000, 999999);
      $trainee = new Trainee([
        'trainee_id' => $request->get('trainee_id'),
        'session_type' => $request->get('session_type'),
        'session_number' => $request->get('session_number'),
        'session_pin' => $session_pin,
        'trainer_id' => Auth::id()
      ]);  
      $trainee->save();
      return redirect('/trainee')->with('success', 'Trainee information has been saved succesfully!');
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {
      $trainee = Trainee::find($id);
      $types = Type::all();
      $totalSessions = $this->totalSessions;
      $state = $request->get('state');
      return view('kessler.trainee.edit', compact('trainee', 'totalSessions','types','state'));
    } 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
      $request->validate([
        'session_type'=>'required',
        'session_number'=>'required'
      ]);
      $trainee = Trainee::find($id);
      $trainee->session_type = $request->get('session_type');
      $trainee->session_number = $request->get('session_number');
      if($trainee->session_state = 'start')  {
        $trainee->session_current_position = null;
        $trainee->round = 1;
        $trainee->completed = 0;
      } if ($trainee->session_state = 'continue') {
        $trainee['session_current_position'] = $trainee->session_current_position;
      }
      $trainee->save();
      return redirect('/trainee')->with('success', 'Trainee information has been updated succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $trainee = trainee::find($id);
      $trainee->delete();
      return redirect('/trainee')->with('success', 'Trainee has been deleted succesfully!');
    }

     /**
     * View report of the trainee for the session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id) {  
      $user = Auth::user();
      $trainer_traines = Trainee::where('trainer_id', $user->id)->pluck('id', 'id')->all();
      $trainee = Trainee::find($id);
      $roundOneReport = array();
      $roundTwoReport = array();
      $recallReport = array();
      $roundOneTotal = array();
      $roundTwoTotal = array();
      $storyWords = array();

      if ($trainee && ($user->role == 'SA' || in_array($trainee->id, $trainer_traines))) {
        $storyWords = Word::select('id', 'word')->where('story_id', $trainee->session_number)->get();
        //$this->pr($storyWords->toArray());
        $queryObj = TraineeTransaction::select('id', 'word_id', 'trainee_id', 'session_pin', 'type', 'answer', 'correct_or_wrong','round','time_taken')->where('trainee_id', $trainee->trainee_id)->where('session_pin', $trainee->session_pin);
        $allStoryWords = $storyWords->pluck('word')->toArray();
  
        if ($trainee->round > 1) {
          $roundOneReport = with(clone $queryObj)->where('round', '=', '1')->get();
          if ($roundOneReport) {
            $recallWords = $roundOneReport->shift();
            $recallReport[] = $this->_recallReport($recallWords, $allStoryWords);
            $roundOneReport->where('type', 'contextual')->sum('time_taken');
            $roundOneTotal['contextual'] = gmdate('i : s', $roundOneReport->where('type', 'contextual')->sum('time_taken'));
            $roundOneTotal['categorical'] = gmdate('i : s', $roundOneReport->where('type', 'categorical')->sum('time_taken'));
            $roundOneReport = $roundOneReport->groupBy('word_id');
          }
        }
       /*$this->pr($roundOneReport->toArray());
        exit;*/
        if ($trainee->round > 1 && $trainee->completed == 1 ) {
          $roundTwoReport = with(clone $queryObj)->where('round', '=', '2')->get();

          if ($roundTwoReport) {
            $recallWords = $roundTwoReport->shift();
            $recallReport[] = $this->_recallReport($recallWords, $allStoryWords);
            $roundTwoTotal['contextual'] = gmdate('i : s', $roundTwoReport->where('type', 'contextual')->sum('time_taken'));
            $roundTwoTotal['categorical'] = gmdate('i : s', $roundTwoReport->where('type', 'categorical')->sum('time_taken'));
            $roundTwoReport = $roundTwoReport->groupBy('word_id');
          }
        }
      }

      //$this->pr($roundTwoReport->toArray());
      //exit;
      return view('kessler.trainee.view')->with(compact('roundOneReport', 'recallReport', 'roundOneTotal', 'roundTwoReport', 'roundTwoTotal', 'storyWords'));
    }

    /**
     * Private function to generate recall words report for round 1 and round 2.
     *
     * @param  object $recallWords
     * @param  array $allStoryWords
     * @return \Illuminate\Http\Response
     */
    private function _recallReport($recallWords, $allStoryWords) {
      $recallReport = array();
      //$this->pr($recallWords->toArray());
      if ($recallWords) {
        $timeTaken = $recallWords->time_taken;
        $recallAnwers = json_decode($recallWords->answer);
        $recallWords = explode(' ', $recallAnwers->words);
        $recallWords = array_unique($recallWords);
        $unFoundWords = array_diff($allStoryWords, $recallWords);
        $foundWords = array_intersect($allStoryWords, $recallWords);
        foreach($recallWords as $key=>$recallWord) {
          if (in_array($recallWord, $foundWords)) {
            $recallReport['words'][$key] = '<span class="correct"><i class="fa fa-check" aria-hidden="true">&nbsp;</i> '.$recallWord.'</span>';
          } else {
            $recallReport['words'][$key] = '<span class="wrong"><i class="fa fa-times" aria-hidden="true">&nbsp;</i> '.$recallWord.'</span>';
          }
        }
        $recallReport['found_count'] = count($foundWords);
        $recallReport['unfound_count'] = count($allStoryWords) - count($foundWords);
        $recallReport['words'] = implode(' ', $recallReport['words']).' ('.$timeTaken.' secs)';
      }
      //$this->pr($recallReport);
      return $recallReport;
    }

     /**
     * Review the story of the trainee from session 5 to 8
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function review($id) {
      $trainee = Trainee::find($id);
      $traineeStory = TraineeStory::select('id', 'trainee_id', 'story_id', 'session_pin', 'original_story')->where('story_id', $trainee->session_number)->where('session_pin', $trainee->session_pin)->first();
      //$this->pr($trainee->toArray()); exit();
      return view('kessler.trainee.review', compact('traineeStory'));
    }

    /**
     * Revise trainee story 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function revise(Request $request, $id) {
      $traineeStory = TraineeStory::find($id);
      $traineeStory->updated_story = $request->get('story');
      $traineeStory->reviewed = 1;
      $traineeStory->save();
      return redirect('/trainee')->with('success', 'TRAINEE STORY REVISED!');
    }
    
}
