<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainee;
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
    public function __construct() {
      $this->middleware('auth');
      parent::__construct();
      $this->totalSessions = range(1, 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $trainees = Trainee::all();
      return view('kessler.trainee.index', compact('trainees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $totalSessions = $this->totalSessions;
      $type = Type::all();
      return view('kessler.trainee.create', compact('totalSessions','type'));
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
      $trainee = new trainee([
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
    public function edit($id) {
      $trainee = Trainee::find($id);
      $type = Type::find($id);
      $totalSessions = $this->totalSessions;
      return view('kessler.trainee.edit', compact('trainee', 'totalSessions','type'));
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
      $trainee = Trainee::find($id);
      $storyWords = Word::select('id', 'word')->where('story_id', $trainee['session_number'])->get();
      //$this->pr($storyWords->toArray());
      $roundOneReport = TraineeTransaction::select('id', 'word_id', 'trainee_id', 'session_pin', 'type', 'answer', 'correct_or_wrong','round','time_taken')->where('trainee_id', $trainee['trainee_id'])->where('session_pin', $trainee['session_pin'])->where('round', '=', '1')->get();
      $allStoryWords = $storyWords->pluck('word')->toArray();
      $recallReport = array();
      if ($roundOneReport) {
        $recallWords = $roundOneReport->shift();
        $recallReport[] = $this->_recallReport($recallWords, $allStoryWords);
        $this->pr($roundOneReport->where('type', 'contextual')->sum('time_taken'));
        echo $roundOneTotal['contextual'] = gmdate('i : s', $roundOneReport->where('type', 'contextual')->sum('time_taken'));
        $roundOneTotal['categorical'] = gmdate('i : s', $roundOneReport->where('type', 'categorical')->sum('time_taken'));
        $roundOneReport = $roundOneReport->groupBy('word_id');
      }
  
     /*$this->pr($roundOneReport->toArray());
      exit;*/
      $roundTwoReport = TraineeTransaction::select('id', 'word_id', 'trainee_id', 'session_pin', 'type', 'answer', 'correct_or_wrong','round','time_taken')->where('trainee_id', $trainee['trainee_id'])->where('session_pin', $trainee['session_pin'])->where('round', '=', '2')->get();

      if ($roundTwoReport) {
        $recallWords = $roundTwoReport->shift();
        $recallReport[] = $this->_recallReport($recallWords, $allStoryWords);
        $roundTwoTotal['contextual'] = gmdate('i : s', $roundTwoReport->where('type', 'contextual')->sum('time_taken'));
        $roundTwoTotal['categorical'] = gmdate('i : s', $roundTwoReport->where('type', 'categorical')->sum('time_taken'));
        $roundTwoReport = $roundTwoReport->groupBy('word_id');
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
    
}
