<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainee;
use App\Models\TraineeStory;
use App\Models\Story;
use App\Models\TraineeTransaction;
use App\Models\Word;
use App\Models\Type;
use App\Models\Booster;
use Auth;

class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    var $totalSessions = array();
    var $boosterRange = array();
    var $user = null;
    public function __construct() {
      parent::__construct();
      $this->totalSessions = range(1, 10);
      $this->boosterRange = range(1, 3);
      $this->traineeCurrentPosition = (object) array('word_id'=>'', 'position'=>'tale', 'user_word_id'=>0, 'sentence'=>0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
      $user = Auth::user();
      $queryObj = Trainee::select('id', 'trainee_id','session_pin', 'session_type', 'session_number', 'session_current_position','session_state','completed');
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
      $boosterRange = $this->boosterRange;
      $types = Type::all();
      $booster = Booster::all();
      return view('kessler.trainee.create', compact('totalSessions', 'boosterRange' ,'types','booster'));
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
        'booster_id' => $request->get('booster_id'),
        'booster_range' => $request->get('booster_range'),
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
      // $types = Type::all();
      // $booster = Booster::all();
      // $totalSessions = $this->totalSessions;
      $state = $request->get('state');
      return view('kessler.trainee.edit', compact('trainee','state'));
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
        'state'=>'required'
      ]);
      $trainee = Trainee::find($id);
      $trainee->session_state = $request->get('state');
      if ($trainee->session_state === 'start')  {
        $trainee->session_current_position = null;
        $trainee->round = 1;
        $trainee->completed = 0;
        //$trainee->session_state = 'start';
        TraineeTransaction::where('story_id', $trainee['session_number'])->where('trainee_id', $trainee['trainee_id'])->where('session_pin', $trainee['session_pin'])->delete();
        if ( $trainee['session_number'] > 4 &&  $trainee['session_number'] < 11) {
          TraineeStory::where('story_id', $trainee['session_number'])->where('trainee_id', $trainee['trainee_id'])->where('session_pin', $trainee['session_pin'])->delete();
        }
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
      $trainee = Trainee::find($id);
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
        //$storyWords = Word::select('id', 'word')->where('story_id', $trainee->session_number)->get();
        $storyWords = $this->getWordAndIDObj($trainee);
        $queryObj = TraineeTransaction::select('id', 'word_id', 'trainee_id', 'session_pin', 'type', 'answer', 'correct_or_wrong','round','time_taken')->where('trainee_id', $trainee->trainee_id)->where('session_pin', $trainee->session_pin);
        $allStoryWords = $storyWords->pluck('word')->toArray();
  
        if ($trainee->round > 1) {
          $roundOneReport = with(clone $queryObj)->where('round', '=', '1')->get();
          if ($roundOneReport) {
            $recallWords = $roundOneReport->shift();
            $recallReport[] = $this->_recallReport($recallWords, $allStoryWords);
            //$roundOneReport->where('type', 'contextual')->sum('time_taken');
            $roundOneReport = $roundOneReport->groupBy('word_id', 'type');
            //$this->pr($roundOneReport->toArray());
            // $contextual = $roundOneReport->map(function ($item, $key) {
            //   return ["total" => $item->where('type', 'contextual')->sum('time_taken')];
            // });
            $contextual = $this->_totalTime( $roundOneReport, 'contextual');
            $categorical = $this->_totalTime( $roundOneReport, 'categorical');
            //exit;
            //$contextual = $contextual->sum('total');
            // $categorical = $roundOneReport->map(function ($item, $key) {
            //   return ["total" => $item->where('type', 'contextual')->sum('time_taken')];
            // });
            // $roundOneTotal['contextual'] = gmdate('i : s', $roundOneReport->where('type', 'contextual')->sum('time_taken'));
            // $roundOneTotal['categorical'] = gmdate('i : s', $roundOneReport->where('type', 'categorical')->sum('time_taken'));
            $roundOneTotal['contextual'] = gmdate('i : s', $contextual);
            $roundOneTotal['categorical'] = gmdate('i : s', $categorical);
            //$this->pr($roundOneReport->toArray());
            //exit;
            
            //$roundOneReport = $roundOneReport->map('array_values', $roundOneReport->toArray());
            $roundOneReport = collect(array_map('array_values', $roundOneReport->toArray()));
            //$this->pr($roundOneReport);
            //exit;
          }
        }
       /*$this->pr($roundOneReport->toArray());
        exit;*/
        if ($trainee->round > 1 && $trainee->completed == 1 ) {
          $roundTwoReport = with(clone $queryObj)->where('round', '=', '2')->get();

          if ($roundTwoReport) {
            $recallWords = $roundTwoReport->shift();
            $recallReport[] = $this->_recallReport($recallWords, $allStoryWords);
            $roundTwoReport = $roundTwoReport->groupBy('word_id', 'type');
            $contextual = $this->_totalTime( $roundTwoReport, 'contextual');
            $categorical = $this->_totalTime( $roundTwoReport, 'categorical');
            //$roundTwoTotal['contextual'] = gmdate('i : s', $roundTwoReport->where('type', 'contextual')->sum('time_taken'));
            //$roundTwoTotal['categorical'] = gmdate('i : s', $roundTwoReport->where('type', 'categorical')->sum('time_taken'));
            $roundTwoTotal['contextual'] = gmdate('i : s', $contextual);
            $roundTwoTotal['categorical'] = gmdate('i : s', $categorical);
            
            $roundTwoReport = collect(array_map('array_values', $roundTwoReport->toArray()));
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
        $recallReport['words'] = implode(' ', $recallReport['words']).' ('.gmdate('i : s', $timeTaken).' secs)';
      }
      //$this->pr($recallReport);
      return $recallReport;
    }

    private function _totalTime($roundOneReport, $type) {
      $total = 0;
      $contextual = $roundOneReport->map(function ($item, $key) use ($type) {
        return ["total" => $item->where('type', "$type")->sum('time_taken')];
      });
      return $total = $contextual->sum('total');
    }
    

     /**
     * Review the story of the trainee from session 5 to 8
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function review($id) {
      $trainee = Trainee::find($id);
      $traineeStory = TraineeStory::select('id', 'trainee_id', 'story_id', 'session_pin', 'original_story','round')->where('story_id', $trainee->session_number)->where('session_pin', $trainee->session_pin)->where('round', $trainee->round)->first();
      //$this->pr($trainee->toArray()); exit();
      return view('kessler.trainee.approve', compact('traineeStory'));
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
      //$this->pr($traineeStory->toArray());
      if ($traineeStory) {
        $traineeObj = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type', 'round', 'completed', 'booster_id', 'booster_range')->where('trainee_id', $traineeStory->trainee_id)->where('session_pin', $traineeStory->session_pin)->first();
        //$this->pr($traineeObj->toArray());
        // exit;
        $storyWords = $this->getWordAndIDObj($traineeObj);
        $storyWords = $storyWords->pluck('word', 'id');
        //$this->pr($storyWords);
        $story = $request->get('story');
        $fullStory = strtolower($story);
        $sentences = preg_split('/([.?!]+)/', $fullStory, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $newString = '';
        foreach ($sentences as $key => $sentence) {
          $newString .= ($key & 1) == 0 ? ucfirst(strtolower(trim($sentence))) : $sentence.' ';
        }
        foreach($storyWords as $word) {
          $searchWord = strtolower($word);
          //$newString = str_replace($searchWord, $word, $newString);
          $findWord = '/\b'.$searchWord.'\b/i';
          $newString = preg_replace($findWord, $word, $newString, 1);
        }
        //echo $newString;
        preg_match_all('/\b([A-Z-]+)\b/', $newString, $userWords);
        $storyWords = $storyWords->toArray();
        $userStoryWords = array();
        if ($userWords) {
          foreach($userWords[0] as $word) {
            $word = strtoupper($word);
            if (in_array($word, $storyWords)) {
              $userStoryWords[] = $word;
            }
          }
        }
        //$this->pr($userStoryWords);
        //exit;
        $traineeStory->updated_story = $newString;
        $traineeStory->user_story_words = $userStoryWords;
        // $this->pr($traineeStory->toArray());
        // exit;
        $traineeStory->reviewed = 1;
        if ($traineeStory->save()) {
          $traineeRecord = Trainee::where('session_pin', $traineeStory->session_pin)->first();
          if ($traineeRecord) {
            $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
            $traineeRecord->save();
          }
        }
        return redirect('/trainee')->with('success', 'Trainee story has been reviewed Successfully!');
      } else {
        redirect('/trainee')->with('error', 'Invalid request!');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $id) {
      $trainee = Trainee::find($id);
      $totalSessions = $this->totalSessions;
      $boosterRange = $this->boosterRange;
      $types = Type::all();
      $booster = Booster::all();
      return view('kessler.trainee.add', compact('trainee', 'totalSessions', 'boosterRange' ,'types','booster'));
    }
    
}
