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
use Exception;
use Illuminate\Support\Facades\DB;


class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    var $totalSessions = array();
    var $boosterRange = array();
    
    private $dateFormat = 'm/d/Y h:i a';
    public $traineePage = '/trainee';
    private $error = 'errors.404';
    private $times = '<i class="fa fa-times" aria-hidden="true">&nbsp;</i>';
    public $timeFormat = 'i : s';
    public function __construct() {
      $this->middleware('auth');
      parent::__construct();
      $this->totalSessions = range(1, 10);
      $this->totalSessions[] = 'Booster';
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
      $trainee_id = null;
      $oldDate = null;
      $trainee_id = $request->get('trainee_id');
      $oldDate = $request->get('oldDate');
      $date = $request->get('date');
      $queryObj = Trainee::select('id', 'trainee_id','session_pin', 'session_type', 'session_number', 'session_current_position', 'session_start_time', 'session_end_time', 'session_state','completed');
      if ($user->role != "SA") {
        $queryObj = $queryObj->where('trainer_id', $user->id);
        $traineesOfTrainer = Trainee::select('trainee_id')->distinct('trainee_id')->where('trainer_id', $user->id)->groupBy('trainee_id')->get();
      } else {
        $traineesOfTrainer = Trainee::select('trainee_id')->distinct('trainee_id')->groupBy('trainee_id')->get();
      }
      if ($date != '') {
        $queryObj = $queryObj->whereDate('created_at', $date);
      }
      if ($trainee_id != '') {
        $queryObj = $queryObj->where('trainee_id', $trainee_id);
      }
      $trainees = $queryObj->orderBy('id', 'desc')->get();
      $types = Type::pluck('type', 'id');
      return view('kessler.trainee.index', compact('user', 'trainees', 'types', 'traineesOfTrainer', 'trainee_id', 'oldDate'));
    }


    /**
     * View table via datatable AJAX.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTrainee(Request $request) {
        $user = Auth::user();
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        
        $search_arr = $request->get('search');
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = Trainee::select('*')->count();
        $totalRecordswithFilters = Trainee::select('*')->Where('trainee_id', 'like', '%' .$searchValue . '%')->orWhere('trainees.session_pin', 'like', '%' .$searchValue . '%')->orWhere('trainees.session_type', 'like', '%' .$searchValue . '%')->orWhere('trainees.session_number', 'like', '%' .$searchValue . '%')->orWhere('trainees.session_start_time', 'like', '%' .$searchValue . '%')->orWhere('trainees.session_end_time', 'like', '%' .$searchValue . '%')->orWhere('trainees.session_state', 'like', '%' .$searchValue . '%');

        $totalRecordswithFilter = with(clone $totalRecordswithFilters)->count();
  
        // Fetch records
        $queryObj = with(clone $totalRecordswithFilters)->skip($start)->take($rowperpage);
        if ($user->role != "SA") {
          $queryObj->where('trainer_id', $user->id);
          $queryObj->toSql();
        } else {
           $queryObj = $queryObj->orderBy('id', 'desc');
        }
       $trainees = $queryObj->get();
        $data_arr =  array();
        
        foreach ($trainees as $records) {
          $trainee_id = $records->trainee_id;
          $session_pin = $records->session_pin;
          $session_type = $records->session_type;
          $session_number = $records->session_number;
          $session_start_time = '';
          $session_end_time = '';
          $sessionStartTime = isset($records->session_start_time)?json_decode($records->session_start_time): null;
          $sessionEndTime = isset($records->session_end_time)?json_decode($records->session_end_time): null;
            if ($sessionStartTime) {
                $session_start_time =  date($this->dateFormat, strtotime($sessionStartTime->roundOne));
            }
            if ($sessionEndTime && $records->round === 1) {
                $session_end_time =  date($this->dateFormat, strtotime($sessionEndTime->roundOne));
            } 
            if ($sessionEndTime && $records->completed === 1) {
                $session_end_time =  date($this->dateFormat, strtotime($sessionEndTime->roundTwo));
            }

          $session_state = $records->session_state;
          $add = route('trainee.add', $records->id);
          $view = url('trainee/view', $records->id);
          $edit = route('trainee.edit', $records->id);
          $delete = route('trainee.destroy', $records->id);
          $report = url('trainee/report', $records->id);
          $approve = url('trainee/approve', $records->id);
          $csrf = csrf_token();
          $id = $records->id;
          $action =  "<a href='$add' class='btn btn-primary' role='button' title='Add'><i class='fas fa-plus' title='Add'></i></a>&nbsp;";
           $action .= "<a href='$view' class='btn btn-primary' role='button' title='View'><i class='fas fa-eye' title='View'></i></a>&nbsp;";
           if (($records->session_number > 4 || strtolower($records->session_number) == 'booster') && $records->session_type == "A") {
            $traineeCurrentPosition = json_decode($records->session_current_position);
            if ($traineeCurrentPosition && $traineeCurrentPosition->position == 'review') {
            $action .= "<a href='$approve' class='btn btn-primary' role='button' title='Approve'><i class='fas fa-book' title='Approve'></i></a>&nbsp;";
            }       
          }
          if ($records->completed == 0) {
            $action .= "<a href='$edit' class='btn btn-primary' role='button' title='Edit'><i class='fas fa-edit' title='Edit'></i></a>&nbsp;";
            $action .= "<form action='$delete' method='post' class='d-inline' id='jsSubmitForm-$id'>
                      <input type='hidden' name='_token' value='$csrf' />
                      <input type='hidden' name='_method' value='delete'>
                      <button class='btn btn-danger jsConfirmButton' type='button' data-value='$id' title='Delete'><i class='fa fa-trash' title='Delete'></i></button></form>";  
          }elseif ($records->completed == 1) {
            $action .= "<a href='$report' class='btn btn-primary' role='button' title='Report'><i class='fas fa-chart-pie' title='Report'></i></a>&nbsp;";
          }
          
          $data_arr[] = array(
          "trainee_id" => $trainee_id,
          "session_pin" => $session_pin,
          "session_type" => $session_type,
          "session_number" => $session_number,
          "session_start_time" => $session_start_time,
          "session_end_time" => $session_end_time,
          "session_state" => $session_state,
          "action" => $action,
          );
        }
          $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
          );
          echo json_encode($response);
          exit;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $types = Type::all();
      $booster = Booster::all();
      return view('kessler.trainee.create', array('types'=>$types, 'boosterRange'=>$this->boosterRange,'totalSessions'=>$this->totalSessions,'booster'=>$booster));
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
        'session_number'=>'required'
      ]);
      $session_pin = random_int(100000, 999999);
      $trainee = new Trainee([
        'trainee_id' => $request->get('trainee_id'),
        'session_type' => 'A',
        'session_number' => $request->get('session_number'),
        'booster_id' => $request->get('booster_id'),
        'booster_range' => $request->get('booster_range'),
        'session_pin' => $session_pin,
        'trainer_id' => Auth::id()
      ]);  
      $trainee->save();
      return redirect($this->traineePage)->with('success', 'Trainee information has been saved succesfully!');
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
       $user = Auth::user();
       if ($trainee->trainer_id == $user->id || $user->role == 'SA') {
          $state = $request->get('state');
          return view('kessler.trainee.edit', compact('trainee','state'));
        } else {
          return view($this->error);
        }
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
        $trainee->session_start_time = null;
        $trainee->session_end_time = null;
        $trainee->session_current_position = null;
        $trainee->round = 1;
        $trainee->completed = 0;
        TraineeTransaction::where('story_id', $trainee['session_number'])->where('trainee_id', $trainee['trainee_id'])->where('session_pin', $trainee['session_pin'])->delete();
        if ( $trainee['session_number'] > 4 &&  $trainee['session_number'] < 11) {
          TraineeStory::where('story_id', $trainee['session_number'])->where('trainee_id', $trainee['trainee_id'])->where('session_pin', $trainee['session_pin'])->delete();
        }
      }
      $trainee->save();
      return redirect($this->traineePage)->with('success', 'Trainee information has been updated succesfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $trainee = Trainee::find($id);
      $user = Auth::user();
      if ($trainee->trainer_id == $user->id || $user->role == 'SA') {
        $trainee->delete();
        return redirect($this->traineePage)->with('success', 'Trainee has been deleted succesfully!');
      } else {
          return view($this->error);
        }
    }

     /**
     * View report of the trainee for the session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id) {  
      $trainee = Trainee::find($id);
      $user = Auth::user();
      if ($trainee->trainer_id == $user->id || $user->role == 'SA') {
        $trainer_traines = Trainee::where('trainer_id', $user->id)->pluck('id', 'id')->all();
        $trainee = Trainee::find($id);
        $roundOneReport = array();
        $roundTwoReport = array();
        $recallReport = array();
        $roundOneTotal = array();
        $roundTwoTotal = array();
        $storyWords = array();
        $roundOneTimeTaken = 0;
        $roundTwoTimeTaken = 0;
        $traineeReport = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'booster_id', 'session_type', 'round', 'completed')->where('id', $trainee->id)->first();

        $traineeID = $traineeReport->trainee_id;
        $sessionNumber = $traineeReport->session_number;

        if ($trainee && ($user->role == 'SA' || in_array($trainee->id, $trainer_traines))) {
          $storyWords = $this->getWordAndIDObj($trainee);

          $queryObj = TraineeTransaction::select('id', 'word_id', 'trainee_id', 'session_pin', 'type', 'answer', 'correct_or_wrong','round','time_taken')->where('trainee_id', $trainee->trainee_id)->where('session_pin', $trainee->session_pin);
          $allStoryWords = $storyWords->pluck('word')->toArray();
          
          
          $timeOverall = with(clone $queryObj);
          $overallTotal = $timeOverall->sum('time_taken');
          $sessionTime = gmdate($this->timeFormat, $overallTotal).' sec';
          if ($trainee->round > 1) {
            $roundOneReport = with(clone $queryObj)->where('round', '=', '1')->get();

            if ($roundOneReport) {
              $roundOneTime = $roundOneReport->sum('time_taken');
              $roundOneTimeTaken = gmdate($this->timeFormat, $roundOneTime).' sec';

              $recallWords = $roundOneReport->shift();
              if ($traineeReport->booster_id == 1) {
                $recallReport[] = $this->_directionsRecallReport($recallWords, $allStoryWords);
              } else {
                $recallReport[] = $this->_recallReport($recallWords, $allStoryWords);
              }
              
              $roundOneReport = $roundOneReport->groupBy('word_id', 'type');
              $contextual = $this->_totalTime( $roundOneReport, 'contextual');
              $categorical = $this->_totalTime( $roundOneReport, 'categorical');
              $roundOneTotal['contextual'] = gmdate($this->timeFormat, $contextual).' sec';
              $roundOneTotal['categorical'] = gmdate($this->timeFormat, $categorical).' sec';
              $roundOneReport = collect(array_map('array_values', $roundOneReport->toArray()));
              }
          }
         
          if ($trainee->round > 1 && $trainee->completed == 1 ) {
            $roundTwoReport = with(clone $queryObj)->where('round', '=', '2')->get();
            if ($roundTwoReport) {
              $roundTwoTime = $roundTwoReport->sum('time_taken');
              $roundTwoTimeTaken = gmdate($this->timeFormat, $roundTwoTime).' sec';
              $recallWords = $roundTwoReport->shift();
              $recallReport[] = $this->_recallReport($recallWords, $allStoryWords);
              
              $roundTwoReport = $roundTwoReport->groupBy('word_id', 'type');
              $contextual = $this->_totalTime( $roundTwoReport, 'contextual');
              $categorical = $this->_totalTime( $roundTwoReport, 'categorical');
              $roundTwoTotal['contextual'] = gmdate($this->timeFormat, $contextual).' sec';
              $roundTwoTotal['categorical'] = gmdate($this->timeFormat, $categorical).' sec';
               
              $roundTwoReport = collect(array_map('array_values', $roundTwoReport->toArray()));
            }
          }
        }
        $submitURL = url('/trainee/answerSave');
        
        return view('kessler.trainee.view')->with(compact('roundOneReport', 'recallReport', 'roundOneTotal', 'roundTwoReport', 'roundTwoTotal', 'storyWords','traineeID','sessionNumber', 'roundOneTimeTaken', 'roundTwoTimeTaken', 'sessionTime','submitURL'));
        } else {
           return view($this->error);
        }
      
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
      if ($recallWords) {
        $timeTaken = $recallWords->time_taken;
        $recallAnwers = json_decode($recallWords->answer);
        $recallWords = explode(' ', $recallAnwers->words);
        $recallWords = array_unique($recallWords);
        
        $foundWords = array_intersect($allStoryWords, $recallWords);
        foreach($recallWords as $key=>$recallWord) {
          if (in_array($recallWord, $foundWords)) {
            $recallReport['words'][$key] = '<span class="correct"><i class="fa fa-check" aria-hidden="true">&nbsp;</i> '.$recallWord.'</span>';
          } else {
            $recallReport['words'][$key] = '<span class="wrong"> '.$this->times.$recallWord.'</span>';
          }
        }
        $recallReport['found_count'] = count($foundWords);
        $recallReport['unfound_count'] = count($allStoryWords) - count($foundWords);
        $recallReport['words'] = implode(' ', $recallReport['words']).' ('.gmdate($this->timeFormat, $timeTaken).' sec)';
      }
      
      return $recallReport;
    }

    private function _directionsRecallReport($recallWords, $allStoryWords) {
      $recallReport = array();
      if ($recallWords) {
        $timeTaken = $recallWords->time_taken;
        $recallAnwers = json_decode($recallWords->answer);
        $recallWords = explode(' ', $recallAnwers->words);

        $wordsCount = array_count_values($allStoryWords);
        $foundWords = 0;
        foreach($recallWords as $key=>$recallWord) {
          if (in_array($recallWord, $allStoryWords)) {
            if ($wordsCount[$recallWord] > 0) {
              $recallReport['words'][$key] = '<span class="correct"><i class="fa fa-check" aria-hidden="true">&nbsp;</i> '.$recallWord.'</span>';
              $wordsCount[$recallWord]--;
              $foundWords++;
            } else {
              $recallReport['words'][$key] = '<span class="wrong">'.$this->times.$recallWord.'</span>';
            }
            
          } else {
            $recallReport['words'][$key] = '<span class="wrong">'.$this->times.$recallWord.'</span>';
          }
        }        

        $unFoundWords = count($allStoryWords) - $foundWords;
        $recallReport['found_count'] = $foundWords;
        $recallReport['unfound_count'] = $unFoundWords;
        $recallReport['words'] = implode(' ', $recallReport['words']).' ('.gmdate($this->timeFormat, $timeTaken).' sec)';
      }

      return $recallReport;
    }

    private function _totalTime($roundReport, $type) {
      $total = 0;
      $collectionObj = $roundReport->map(function ($item, $key) use ($type) {
        return ["total" => $item->where('type', "$type")->sum('time_taken')];
      });
      return $total = $collectionObj->sum('total');
    }
    

     /**
     * Review the story of the trainee from session 5 to 8
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function review($id) {
      $trainee = Trainee::find($id);
      $user = Auth::user();
      if ($trainee->trainer_id == $user->id || $user->role == 'SA') {
        $traineeStory = TraineeStory::select('id', 'trainee_id', 'story_id', 'session_pin', 'original_story','round')->where('story_id', $trainee->session_number)->where('session_pin', $trainee->session_pin)->where('round', $trainee->round)->first();
        return view('kessler.trainee.approve', compact('traineeStory'));
      } else {
        return view($this->error);
      }
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

      if ($traineeStory) {
        $traineeObj = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type', 'round', 'completed', 'booster_id', 'booster_range')->where('trainee_id', $traineeStory->trainee_id)->where('session_pin', $traineeStory->session_pin)->first();
        $storyWords = $this->getWordAndIDObj($traineeObj);
        $storyWords = $storyWords->pluck('word', 'id');
        $story = $request->get('story');
        $fullStory = strtolower($story);
        //Removing new-line characters
        $fullStory = str_replace("\r\n", "\n", $fullStory);
        $fullStory = str_replace("\r", "\n", $fullStory); 
        //Removing extra spaces.
        $fullStory = trim(preg_replace('/\s+/', ' ', $fullStory));
        $sentences = preg_split('/([.?!]+( ))/', $fullStory, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $sentences = array_values(array_filter($sentences, 'trim'));
        
        $newString = '';

        foreach ($sentences as $key => $sentence) {
          $newString .= ($key & 1) == 0 ? ucfirst(strtolower(trim($sentence))) : $sentence.' ';
        }
        
        if ($traineeObj->booster_id != 1) {
          $revisedStory = $this->getRevisedStory($storyWords, $newString);
          preg_match_all('/\b([A-Z-]+)\b/', $revisedStory, $userWords);
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
        } else {
          $revisedStory = $this->getRevisedStoryForDirection($storyWords, $newString);
          $userStoryWords = array_values($storyWords->toArray());
        }
        $traineeStory->updated_story = $revisedStory;
        $traineeStory->user_story_words = $userStoryWords;
        $traineeStory->reviewed = 1;
        if ($traineeStory->save()) {
          $traineeRecord = Trainee::where('session_pin', $traineeStory->session_pin)->first();
          if ($traineeRecord) {
            $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
            $traineeRecord->save();
          }
        }
        return redirect($this->traineePage)->with('success', 'Trainee story has been reviewed Successfully!');
      } else {
        redirect($this->traineePage)->with('error', 'Invalid request!');
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $id) {
      $trainee = Trainee::find($id);
      $user = Auth::user();
      if ($trainee->trainer_id == $user->id || $user->role == 'SA') {
        
        $types = Type::all();
        $booster = Booster::all();
        return view('kessler.trainee.add', array('trainee'=>$trainee, 'totalSessions'=>$this->totalSessions, 'boosterRange'=>$this->boosterRange ,'types'=>$types,'booster'=>$booster));
      } else {
          return view($this->error);
        }
      
    }

    /**
     * Graph report of trainee session
     *
     * @return \Illuminate\Http\Response
     */
    public function report($id) {
      $trainee = Trainee::find($id);
      $user = Auth::user();
      if ($trainee->trainer_id == $user->id || $user->role == 'SA') {
        $traineeReport = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type', 'round', 'completed','session_start_time', 'session_end_time')->where('id', $trainee->id)->first();
      $traineeID = $traineeReport->trainee_id;
      $sessionNumber = $traineeReport->session_number;
      
      $startTime = $traineeReport->session_start_time;
      $endTime = $traineeReport->session_end_time;
      $queryObj = TraineeTransaction::select('id', 'word_id', 'trainee_id', 'session_pin', 'type', 'answer', 'correct_or_wrong','round','time_taken')->where('trainee_id', $trainee->trainee_id)->where('session_pin', $trainee->session_pin);
      if ($trainee->round > 1) {
          $roundOneReport = with(clone $queryObj)->where('round', '=', '1')->get();
          if ($roundOneReport) {
            $recallRoundOne = $roundOneReport->where('type','recall')->first();
            $storyWords = $this->getWordAndIDObj($trainee);
            $allStoryWords = $storyWords->pluck('word')->toArray();
            $recallRoundOneCount = array();
            $recallRoundOneCount = $this->_recallReport($recallRoundOne, $allStoryWords);
            $contextualRoundOne = $roundOneReport->where('type', 'contextual')->where('correct_or_wrong', 1)->groupBy('word_id');
            $contextualRoundOneCount = $contextualRoundOne->count();
            $categoricalRoundOne = $roundOneReport->where('type', 'categorical')->where('correct_or_wrong', 1)->groupBy('word_id');
            $categoricalRoundOneCount = $categoricalRoundOne->count();
            $roundOneTotal = $roundOneReport->sum('time_taken');
            $roundOneTotalTime = gmdate('i', $roundOneTotal)." mins : ".gmdate('s', $roundOneTotal)." sec";
          }
        }
      if ($trainee->round > 1 && $trainee->completed == 1 ) {
          $roundTwoReport = with(clone $queryObj)->where('round', '=', '2')->get();
          if ($roundTwoReport) {
            $recallRoundTwo = $roundTwoReport->where('type','recall')->first();
            $storyWords = $this->getWordAndIDObj($trainee);
            $allStoryWords = $storyWords->pluck('word')->toArray();
            $recallRoundTwoCount = array();
            $recallRoundTwoCount = $this->_recallReport($recallRoundTwo, $allStoryWords);
            $contextualRoundTwo = $roundTwoReport->where('type', 'contextual')->where('correct_or_wrong', 1)->groupBy('word_id');
            $contextualRoundTwoCount = $contextualRoundTwo->count();
            $categoricalRoundTwo = $roundTwoReport->where('type', 'categorical')->where('correct_or_wrong', 1)->groupBy('word_id');
            $categoricalRoundTwoCount = $categoricalRoundTwo->count();
            $roundTwoTotal = $roundTwoReport->sum('time_taken');
            $roundTwoTotalTime = gmdate('i', $roundTwoTotal)." mins : ".gmdate('s', $roundTwoTotal)." sec";
          }
        }
            
            $storyWords = $this->getWordAndIDObj($trainee);
            $allStoryWords = $storyWords->pluck('word')->toArray();
            $totalWords = count($allStoryWords);
            $recallRoundOneCount = array();
            $recallRoundOneCount = $this->_recallReport($recallRoundOne, $allStoryWords);
            $recallRoundTwoCount = array();
            $recallRoundTwoCount = $this->_recallReport($recallRoundTwo, $allStoryWords);
            $recallOverallCount = $recallRoundOneCount['found_count'] + $recallRoundTwoCount['found_count'];
            
            $contextualOverallCount = $contextualRoundOneCount + $contextualRoundTwoCount;
            $categoricalOverallCount = $categoricalRoundOneCount + $categoricalRoundTwoCount;
            $timeOverall = with(clone $queryObj);
            $overallTotal = $timeOverall->sum('time_taken');
            $overallTotalTime = gmdate('i', $overallTotal)." mins : ".gmdate('s', $overallTotal)." sec";
            return view('kessler.trainee.report', compact('sessionNumber','traineeID', 'contextualRoundOneCount','categoricalRoundOneCount', 'recallRoundOneCount','contextualRoundTwoCount','categoricalRoundTwoCount', 'recallRoundTwoCount', 'recallOverallCount', 'contextualOverallCount', 'categoricalOverallCount', 'roundOneTotalTime', 'roundTwoTotalTime', 'overallTotalTime','startTime', 'endTime','totalWords'));
          } else {
            return view($this->error);
          }
      
    }

    /**
     * Updating useranswer by trainer
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxAnswerSave(Request $request) {
      $response['reload'] = false;
      $response['message'] = 'Invalid request!';
       if ($request->ajax()) {
        $remove = ['_token', '_method'];
        $correctedAnswer = array_diff_key($request->all(), array_flip($remove));
        foreach($correctedAnswer as $key=>$answer) {
          $wordKey = explode('-', $key);
          $transactionID = array_pop($wordKey);
          $answer = strtoupper($answer);
        }
        if ($transactionID) { 
          try {
            $transactionDetail = TraineeTransaction::where('id', $transactionID)->firstOrFail();
            
            $wordObj = $this->getWord($transactionDetail);
            if ($wordObj['word'] === $answer) {
              if ($transactionDetail->type == 'contextual') {
                 TraineeTransaction::where('trainee_id', '=', "$transactionDetail->trainee_id")->where('session_pin','=',"$transactionDetail->session_pin")->where('word_id', '=', $transactionDetail->word_id)->where('round','=',$transactionDetail->round)->where('type', '=', 'categorical')->delete();
              }
              $transactionDetail->correct_or_wrong = 1;
              $transactionDetail->answer = $answer;
              if ($transactionDetail->save()) {
                $response['reload'] = true;
              } else {
                $response['message'] = 'Some server error! Please try after sometimes!';
              }
            } else {
              $response['message'] = 'Invalid answer!';
            }
            
          } catch(\Exception $e) {
            Log::error($e);
          }
        } else {
          $response['message'] = 'Invalid transactionid!';
        } 
       } 
       return $response;
    }

    public function editWord(Request $request, $id){
        $submitURL = url('/editword/').'/'.$id;
        $errorMessage = '';
        $transactionDetail = TraineeTransaction::where('id',$id)->firstOrFail();
        try {
        $wordObj = $this->getWord($transactionDetail);
        $userans = $transactionDetail->answer;
        $userans = strtoupper($userans);
        if ($request->isMethod('post')) {
          $userans = strtoupper(trim($request['word']));
          if ($wordObj['word'] === $userans) {
            if ($transactionDetail->type == 'contextual') {
                TraineeTransaction::where('trainee_id', '=', "$transactionDetail->trainee_id")->where('session_pin','=',"$transactionDetail->session_pin")->where('word_id', '=', $transactionDetail->word_id)->where('round','=',$transactionDetail->round)->where('type', '=', 'categorical')->delete();
            }
            $transactionDetail->correct_or_wrong = 1;
            $transactionDetail->answer = $userans;

            $detail = Trainee::select('session_pin' , 'id')->where('session_pin' , $transactionDetail->session_pin)->firstOrFail();
            $tid = $detail->id;
            if ($transactionDetail->save()) {
                return redirect()->route('trainee.view', ['id' => $tid]);
              } else {
                $errorMessage = 'Some server error! Please try after sometimes!';
              }
            } else {
                $errorMessage = 'Invalid answer';
            }
        }
        }catch(\Exception $e) {
            Log::error($e);
          }
        return view ('kessler.trainee.words', compact('wordObj','userans','submitURL','errorMessage'));
        
    } 

    
}
