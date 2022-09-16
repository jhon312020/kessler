<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TraineeTransaction;
use App\Models\TraineeStory;
use App\Models\Trainee;
use App\Models\ControlWord;
use App\Models\ControlStory;
use Redirect,Response;
use Auth;
use DB;
use App\Models\Story;
use App\Models\Word;
use App\Models\Task;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;

class TraineeSessionController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $traineeCurrentPosition;
    private $index = '/index';
    private $queshow = 'msmt.sessions.questions.show';
    private $recallRem = 'msmt.sessions.recallwords.remember';
    private $recallControlRem = 'msmt.sessions.controlsessions.remember';

    public function __construct() {
      parent::__construct();
      $this->traineeCurrentPosition = (object)array('word_id'=>'', 'position'=>'', 'user_word_id'=>'', 'sentence'=>'');
      $this->sessionStartTime = (object)array('roundOne'=>'', 'roundTwo'=>'');
      $this->sessionEndTime = (object)array('roundOne'=>'', 'roundTwo'=>'');
      $this->directionBoosterID = $this->commonConfigValue['DIRECTION_BOOSTER_ID'];
      $this->minSession = $this->commonConfigValue['MIN_SESSION_NO'];
      $this->minWrite = $this->commonConfigValue['MIN_WRITE_NO'];
      $this->maxSession =$this->commonConfigValue['MAX_SESSION_NO'];
    }
    /**
     * Show the application dashboard.
     * Get session pin, validate as required if submitted empty else invalid if wrong pin
     * After successfully validation of pin the sessions for the trainee starts by on submit button click
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request) {
      $request->session()->forget('trainee');
      $validator = [];
       if ($request->isMethod('post')) {
          $validator = Validator::make($request->all(), [
            'sessionpin' => 'required'    
          ]);
        if (!$validator->fails()) {
          echo $request->sessionpin;
          echo $record = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type', 'round', 'completed', 'session_current_position', 'session_start_time', 'booster_id', 'booster_range')->where('session_pin', $request->sessionpin)->where('completed', 0)->toSql();
          exit;
          if ($record) {
            $sessionStartTime = $record->session_start_time? json_decode($record->session_start_time): $this->sessionStartTime;
            switch($record->round) {
              case 1:
                $sessionStartTime->roundOne = now();
              break;
              case 2:
                $sessionStartTime->roundTwo = now();
              break;
            }
            $record->session_start_time = json_encode($sessionStartTime);
            $record->save(); 
            $request->session()->put('trainee', $record);
            
            if($record['session_type'] == '1' ){
              return redirect('/sessions');
            } elseif($record['session_type'] == '5') {
              return redirect('/controlsessions');
            }else{
              return redirect('/write');
            }

          } else {
             $validator->errors()->add('sessionpin', 'INVALID PIN! Please contact your trainer..');
          } 
        } 
      } 
      $page  = 'index'; 
      return view('msmt.user.index', compact('page'))->withErrors($validator);
    }


    /**
     * Show the session page.
     * Session begins by matching the session pin of the session number. 
     * Next the story is viewed which depends on the session number
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sessions(Request $request) {
      if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee'); 
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        
        /*if($traineeRecord['session_type'] == '2' && $traineeRecord['session_type']== '3' && $traineeRecord['session_type'] == '4')*/
        if($traineeRecord['session_type'] == '2' || $traineeRecord['session_type']== '3' || $traineeRecord['session_type'] == '4'){
          return redirect('/write');
        }/*elseif($traineeRecord['session_type'] == '5'){
            return redirect('/controlsessions');
        }*/

        $traineeCurrentPosition = $traineeRecord->session_current_position?json_decode($traineeRecord->session_current_position):$this->traineeCurrentPosition;
        if ($traineeCurrentPosition->position === 'recall' || $traineeCurrentPosition->position === '') {
          $allWords = Word::where('story_id', $trainee['session_number'])->pluck('word');
          $story = Story::select('story')->where('id', $trainee['session_number'])->first(); 
          foreach ($allWords as $word) {
            $story->story = str_replace($word, "<span class='emboss'>$word</span>", $story->story);
          }
          $linkURL = url('recallwords');
          return view('msmt.sessions.story', compact('story', 'trainee', 'linkURL'));
        } else {
          $startWord = Word::select('id', 'word', 'question')->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
          $word = Word::select('id', 'word', 'question')->where('story_id', $trainee['session_number'])->where('id', $traineeCurrentPosition->word_id)->orderBy('id', 'asc')->first();
          if ($word) {
            TraineeTransaction::where('story_id', $trainee['session_number'])->where('word_id', $traineeCurrentPosition->word_id)->where('round', $traineeRecord->round)->delete();
            $showTraineeMessage = ($startWord['id']==$word['id']) ? true : false;
            $this->traineeCurrentPosition->word_id = $word['id'];
            $this->traineeCurrentPosition->position = 'answer';
            $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
            $traineeRecord->session_state = 'continue';
            $traineeRecord->save();
            $wordID = $word['id'];
            $question = $word['question'];
            
            $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$wordID."' id='answer' autocomplete='off'>", $question);
            $question = str_replace("$$", str_repeat("_", 15), $question);
            $submitURL = url('next');
            return view($this->queshow, compact('question','showTraineeMessage', 'submitURL'));
          }
        }
      } else {
        return redirect($this->index);
      }
    }

    /**
     * Control Session
     * @return \Illuminate\Http\Response
     */
    public function controlSession(Request $request){
      $instructions = '<p>You are going to see a story, which will stay on the screen for a set period of time. Please pay careful attention, as we will be asking you questions about it later. </p>';
      if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee');
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        /*$story = ControlStory::select('story')->where('id', $trainee['session_number'])->first();
        dd($story);
        exit();*/
        /*if($traineeRecord['session_type'] == '5') {
            return redirect('/controlsessions');
          }*/
      $traineeCurrentPosition = $traineeRecord->session_current_position?json_decode($traineeRecord->session_current_position):$this->traineeCurrentPosition;
      
        if ($traineeCurrentPosition->position === 'recall' || $traineeCurrentPosition->position === '') {
          $allWords = ControlWord::where('story_id', $trainee['session_number'])->pluck('answers');
          $story = ControlStory::select('story')->where('id', $trainee['session_number'])->first(); 
          /*foreach ($allWords as $word) {
            $story->story = str_replace($word, "<span class='emboss'>$word</span>", $story->story);
          }*/
          $linkURL = url('recallwords');
          return view('msmt.sessions.controlstory', compact('story', 'trainee', 'linkURL','instructions'));
        } else {
          $startWord = ControlWord::select('id', 'answers', 'questions')->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
          $word = ControlWord::select('id', 'answers', 'questions')->where('story_id', $trainee['session_number'])->where('id', $traineeCurrentPosition->word_id)->orderBy('id', 'asc')->first();
          if ($word) {
            TraineeTransaction::where('story_id', $trainee['session_number'])->where('word_id', $traineeCurrentPosition->word_id)->where('round', $traineeRecord->round)->delete();
            $showTraineeMessage = ($startWord['id']==$word['id']) ? true : false;
            $this->traineeCurrentPosition->word_id = $word['id'];
            $this->traineeCurrentPosition->position = 'answer';
            $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
            $traineeRecord->session_state = 'continue';
            $traineeRecord->save();
            $wordID = $word['id'];
            $question = $word['questions'];
            $question .= "<br/><input class='control-textbox fill-ups' name='answer-".$wordID."' id='answer' autocomplete='off'>";
            $session_type = $traineeRecord->session_type;
            //$question = str_replace($word['answers'], "<input class='fill-ups' name='answer-".$wordID."' id='answer' autocomplete='off'>", $question);
            //$question = str_replace("$$", str_repeat("_", 15), $question);
            $submitURL = url('controlnext');
            return view('msmt.sessions.questions.controlshow', compact('question', 'session_type', 'showTraineeMessage', 'submitURL'));
          }
        }
      } else {
        return redirect($this->index);
      }    

          
    }
    /**
     * Story writing by trainee
     * @return \Illuminate\Http\Response
     */
    public function writing(Request $request) {
      $instructions = '<p>On the same page below you are going to see a set of 20 words. The words will be capitalized like <span class="emboss">THIS</span>. <p>Build a story of your own using these words. Try to use several of the words in each sentence. This story is to help you remember the capitalized words. Try to make a picture of each storyline in your head. </p>';
      
     if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee');
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();

          if($traineeRecord['session_type'] == '1') {
            return redirect('/sessions');
          }
          
        if($traineeRecord) {
          $traineeCurrentPosition = $traineeRecord->session_current_position !== null?json_decode($traineeRecord->session_current_position):$this->traineeCurrentPosition;
          $wordStory = $this->getWords($traineeRecord);
          $words = $wordStory->where('question', '<>', 'D')->pluck('word')->toArray();
          if ($traineeRecord['booster_id']) {
            $words = $wordStory->where('question', '<>', 'D')->pluck('word')->toArray();
            $sentenceWords = $wordStory->where('question', '<>', 'D')->pluck('question')->toArray();
            $allWords = $wordStory->pluck('words')->toArray();
          
          } else {
            $allWords = $wordStory->pluck('word')->toArray();
          }
          if ($traineeCurrentPosition->position === 'review' || $traineeCurrentPosition->position === 'tale' ) {
            return redirect('/review');
          } else if ($traineeCurrentPosition->position === 'recall' ) {
            $allWords = count($allWords);
            $submitURL = url('cue');
            return view($this->recallRem, compact('allWords','traineeRecord', 'submitURL'));
          } else if ($traineeCurrentPosition->position === 'answer') {
            return redirect('/cue');
          } else {
            $totalWords = count($words);
            $chunkLength = ceil ($totalWords / 5);
            $respClass = 'col-lg-3';
            switch($chunkLength) {
              case 2:
                $respClass = 'col-lg-6';
              break;
              
            }
            if ($traineeRecord['booster_id']) {
              $allWords = implode(',', $allWords);
              $words = array_chunk($words, 5, true);
              switch($traineeRecord['booster_id']) {
                case 1:
                   $instructions = '<p>Below you are going to see a list of directions, with capitalised word like <span class="emboss">THIS</span> in each item.</p><p>Use these words to make up a story of your own.  Remember to make up a story that is easy to picture in your mind.  Use what you have learned in previous sessions to visualise the story.  The visualisation will help you remember the words, which will then help you to remember the step in the directions.</p>';
                break;
                case 3:
                 $instructions = '<p>Below you are going to see a list of things to do, with capitalised word like <span class="emboss">THIS</span> in each item.</p><p>Use these words to make up a story of your own.  Remember to make up a story that is easy to picture in your mind.  Use what you have learned in previous sessions to visualise the story.  The visualisation will help you remember the words, which will then help you to remember the "to do" item.</p>';
                break;
              }
             
              if ($traineeRecord['booster_id'] == $this->directionBoosterID) {
                $respClass = 'col-lg-12';
                $settings = Setting::pluck('booster_id','active')->toArray();
                if ($settings && isset($settings[$traineeRecord['booster_id']]) && $settings[$traineeRecord['booster_id']] == 1) {
                  $viewName = 'msmt.sessions.directions-final-review';
                } else {
                  $viewName = 'msmt.sessions.directions';
                }
                $sentenceWords = implode('**', $sentenceWords);
                $type = "directions";
                return view($viewName, compact('words', 'allWords', 'respClass', 'type', 'sentenceWords', 'instructions'));
              } else {
                return view('msmt.sessions.word', compact('words', 'allWords', 'respClass', 'instructions'));
              }
              
            } else {
              $allWords = implode(',', $allWords);
              $words = array_chunk($words, 5, true);
              return view('msmt.sessions.word', compact('words', 'allWords', 'respClass', 'instructions'));
            }
            
          }
        } else {
          return redirect($this->index);
        }
      } else {
        return redirect($this->index);
      }
    }

    /**
     * Store by trainee
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function writeup(Request $request) {

      if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee'); 
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();

        $storyObj = $this->getWords($trainee);

        $storyWords = $this->getStoryWords($trainee, $storyObj);
        
        $story = $request->get('story');
        $fullStory = strtolower($story);
        //Removing new-line characters
        $fullStory = str_replace("\r\n", "\n", $fullStory);
        $fullStory = str_replace("\r", "\n", $fullStory); 
        //Removing extra spaces.
        $fullStory = trim(preg_replace('/\s+/', ' ', $fullStory));
        $sentences = preg_split('/([.?!]+)/', $fullStory, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
        $newString = '';
        foreach ($sentences as $key => $sentence) {
          $newString .= ($key & 1) == 0 ? ucfirst(strtolower(trim($sentence))) : $sentence.' ';
        }
        
        
        /*dd($resultValue);
        exit();*/
        foreach($storyWords as $word) {
          $searchWord = strtolower($word);
              
          $findWord = '/\b'.$searchWord.'\b/i';

          $newString = preg_replace($findWord, $word, $newString);
        }
        
        $wordsArr = $storyObj->pluck("word","question");
        
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
        //$userStoryWords = array_unique($userStoryWords);
        $userStoryWords = array_values(array_unique($userStoryWords));
        $traineeStory['trainee_id'] = $trainee['trainee_id'];
        $traineeStory['story_id'] = $trainee['session_number'];
        $traineeStory['session_pin'] = $trainee['session_pin'];
        $traineeStory['round'] = $trainee['round'];
        $traineeStory['original_story'] = $story;
        /*$traineeStory['updated_story'] = $newString;
        $userStoryWords = array_values(array_unique($userStoryWords));
        $traineeStory['user_story_words'] = json_encode($userStoryWords);*/
        $traineeStory['updated_story'] = $story;
        $traineeStory['user_story_words'] = json_encode($userStoryWords);
        /*dd($traineeStory);
        exit();*/
        $this->traineeCurrentPosition->position = 'review';
        if (TraineeStory::insert($traineeStory)) {
          $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
          $traineeRecord->session_state = 'continue';
          $traineeRecord->save();
        }
        return redirect('/review');
      } else {
        return redirect($this->index);
      }
    }

    /**
     * On continuation with the story the next step is the trainer has to review the story
     * @return \Illuminate\Http\Response
     */
    public function review(Request $request) {

      if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee');
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        
        $story = TraineeStory::select('updated_story as story', 'reviewed')->where('trainee_id', $trainee['trainee_id'])->where('story_id', $trainee['session_number'])->where('session_pin', $trainee['session_pin'])->where('round', $trainee['round'])->orderBy('id', 'desc')->first();
        if ($story && $story['reviewed']) {
          $storyObj = $this->getWords($trainee);
          $storyWords = $this->getStoryWords($trainee, $storyObj);

          foreach ($storyWords as $word) {
            $story->story = str_replace($word, "<span class='emboss'>$word</span>", $story->story);
          }
        
          $linkURL = url('recallword');
          return view('msmt.sessions.story', compact('story', 'trainee', 'linkURL'));
        } else {
          return view('msmt.sessions.review');
        }
      }
      return redirect($this->index);
    }

    /**
     * On continuation with the story the next step is to recall words from the story
     * @return \Illuminate\Http\Response
     */
    public function remember(Request $request) {
      if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee'); 
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        
        $wordStory = $this->getWords($trainee);
        $allWords = $wordStory->toArray();
        $allWords = count($allWords);
        $traineeCurrentPosition = $traineeRecord->session_current_position?json_decode($traineeRecord->session_current_position):$this->traineeCurrentPosition;
        if ($traineeCurrentPosition->position === 'recall' || $traineeCurrentPosition->position === '') {
          $this->traineeCurrentPosition->position = 'recall';
          $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
          $traineeRecord->session_state = 'continue';
          $traineeRecord->save();
          if($traineeRecord->session_type == '5') {
            $submitURL = url('controlsessions');
            return view($this->recallControlRem, compact('allWords','traineeRecord', 'submitURL'));
          } else {
            $submitURL = url('sessions');
            return view($this->recallRem, compact('allWords','traineeRecord', 'submitURL'));
          }
        } 
      }
      return redirect($this->index);
    }

    public function recollect(Request $request) {
      if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee'); 
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        
        $wordStory = $this->getWords($trainee);
        $allWords = $words = $wordStory->toArray();
        $allWords = count($allWords);
        $traineeCurrentPosition = $traineeRecord->session_current_position?json_decode($traineeRecord->session_current_position):$this->traineeCurrentPosition;
        
        if ($traineeCurrentPosition->position === 'recall' || $traineeCurrentPosition->position === 'tale') {
          $this->traineeCurrentPosition->position = 'recall';
          $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
          $traineeRecord->save();
          $submitURL = url('cue');
          return view($this->recallRem, compact('allWords','traineeRecord', 'submitURL'));
        } 
      }
      return redirect($this->index);
    }

    /**
     * Store the recorded list of words of session 1-8
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */   
    public function controlStore(Request $request) {
      if ($request->session()->has('trainee')) {
        $timeTaken = (int)(($request->endTime - $request->startTime)/1000);
        $trainee = $request->session()->get('trainee');
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        
        $data = $request->only('words');
        $traineeTransaction['answer'] = json_encode($data);
        $traineeTransaction['trainee_id'] = $trainee['trainee_id'];
        $traineeTransaction['category_id'] = $trainee['session_type'];
        $traineeTransaction['story_id'] = $trainee['session_number'];
        $traineeTransaction['session_pin'] = $trainee['session_pin'];
        $traineeTransaction['round'] = $trainee['round'];
        $traineeTransaction['time_taken'] = $timeTaken;
        $traineeTransaction['type'] = 'recall';
        TraineeTransaction::insert($traineeTransaction);
        $word = ControlWord::select('id', 'answers', 'questions')->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
        if ($word) {
          $showTraineeMessage = true;
          $this->traineeCurrentPosition->word_id = $word['id'];
          $this->traineeCurrentPosition->position = 'question';
          $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
          $traineeRecord->session_state = 'continue';
          $traineeRecord->save();
          $wordID = $word['id'];
          $question = $word['questions'];
          $session_type = $traineeRecord->session_type;
          $question .= "<br/><input class='fill-ups' name='answer-".$wordID."' id='answer' autocomplete='off'>";
        } 
        $submitURL = url('controlnext');
        return view('msmt.sessions.questions.controlshow', compact('question','session_type', 'showTraineeMessage', 'submitURL'));
      } else {
        return redirect($this->index);
      }
    }

    /**
     * Store the recorded list of words of session 1-8
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */   
    public function store(Request $request) {
      if ($request->session()->has('trainee')) {
        $timeTaken = (int)(($request->endTime - $request->startTime)/1000);
        $trainee = $request->session()->get('trainee');
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        
        $data = $request->only('words');
        $traineeTransaction['answer'] = json_encode($data);
        $traineeTransaction['trainee_id'] = $trainee['trainee_id'];
        $traineeTransaction['category_id'] = $trainee['session_type'];
        $traineeTransaction['story_id'] = $trainee['session_number'];
        $traineeTransaction['session_pin'] = $trainee['session_pin'];
        $traineeTransaction['round'] = $trainee['round'];
        $traineeTransaction['time_taken'] = $timeTaken;
        $traineeTransaction['type'] = 'recall';
        TraineeTransaction::insert($traineeTransaction);
        $word = Word::select('id', 'word', 'question')->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
        if ($word) {
          $showTraineeMessage = true;
          $this->traineeCurrentPosition->word_id = $word['id'];
          $this->traineeCurrentPosition->position = 'question';
          $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
          $traineeRecord->session_state = 'continue';
          $traineeRecord->save();
          $wordID = $word['id'];
          $question = $word['question'];
          
          $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$wordID."' id='answer' autocomplete='off'>", $question);
          $question = str_replace("$$", str_repeat("_", 15), $question);
        } 
        $submitURL = url('next');
        return view($this->queshow, compact('question', 'showTraineeMessage', 'submitURL'));
      } else {
        return redirect($this->index);
      }
    }

    /**
     * Save the recorded list of words of session 9 - 16
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */   
    public function save(Request $request) {
     
      if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee');
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        if ($request->isMethod('post')) {
          $timeTaken = (int)(($request->endTime - $request->startTime)/1000);
        
          
          $data = $request->only('words');
          
          $traineeTransaction['answer'] = json_encode($data);
          $traineeTransaction['trainee_id'] = $trainee['trainee_id'];
          $traineeTransaction['category_id'] = $trainee['session_type'];
          $traineeTransaction['story_id'] = $trainee['session_number'];
          $traineeTransaction['session_pin'] = $trainee['session_pin'];
          $traineeTransaction['round'] = $trainee['round'];
          $traineeTransaction['time_taken'] = $timeTaken;
          $traineeTransaction['type'] = 'recall';
          if (TraineeTransaction::insert($traineeTransaction)) {
            $this->traineeCurrentPosition->position = 'answer';
            $this->traineeCurrentPosition->user_word_id = 0;
            $this->traineeCurrentPosition->sentence = 0;
            $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
            $traineeRecord->session_state = 'continue';
            $traineeRecord->save();
          }
        }
        return redirect('/cue');
      } else {
        return redirect($this->index);
      }
    }



  /**
   * When user is in  5 to 8 session user is in answer postion he is redirected here.
   * @return \Illuminate\Http\Response
   */
  public function cue(Request $request) { 
    if ($request->session()->has('trainee')) {
      $trainee = $request->session()->get('trainee');
      $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
      
      $story = TraineeStory::select('updated_story', 'user_story_words')->where('trainee_id', $trainee['trainee_id'])->where('story_id', $trainee['session_number'])->where('session_pin', $trainee['session_pin'])->where('round', $trainee['round'])->orderBy('id', 'desc')->first();
      $storySentences = explode('. ',$story->updated_story);
      
      $wordStory = $this->getWordAndID($trainee);
      $allStoryWords = $wordStory->toArray();
      if ($story && $traineeRecord) {
        $traineeCurrentPosition = json_decode($traineeRecord->session_current_position);
        if (!$traineeCurrentPosition) {
          return redirect($this->index);
        }
        $userStoryWords = json_decode($story->user_story_words);
        
        $userWordKey = $traineeCurrentPosition->user_word_id;
        $nextWordKey = $userWordKey + 1;
        $completedWords = array_slice($userStoryWords, 0, $nextWordKey, true);
        $sentenceKey = $this->getSentenceKey($storySentences, $completedWords);
        $fillUpWord = $userStoryWords[$userWordKey];
        if ($traineeRecord['booster_id'] == $this->directionBoosterID) {
          $allStoryWords = array_slice($allStoryWords, $userWordKey, null, true);
        }
      }
      
      $storySentences = array_slice($storySentences, $sentenceKey, null, true);
      $breakParentLoop = false;
      $showTraineeMessage = ($userWordKey)?false:true;
      foreach ($storySentences as $question) {
        foreach(array_slice($userStoryWords, $userWordKey, null, true) as $wordKey=>$word) {
          $findWord = '/\b'.$word.'\b/';
          if ($fillUpWord === $word && !$breakParentLoop) {
            $storyWordID = array_search($word, $allStoryWords);
            $question = preg_replace($findWord, "<input id='answer' class='fill-ups' autocomplete='off' name='answer-".$storyWordID."'>", $question, 1, $count);
            if ($count) {
              $breakParentLoop = true;
            }
          } else {
            $question = preg_replace($findWord, str_repeat("_", 15), $question, 1);
          }
        }
        
        if ($breakParentLoop) {
          break;
        }
      }
      $submitURL = url('after');
      return view($this->queshow, compact('question', 'showTraineeMessage', 'submitURL'));
    } else {
      return redirect($this->index);
    }
  }
  /**
   * On completting the session story the user is redirected to completion page.
   * @return \Illuminate\Http\Response
   */
  public function complete(Request $request) {
    if ($request->session()->has('completed')) {
      $sessionNumber = '';
      $round = 'first';
      $homeURL = url('index');
      $request->session()->forget('completed');
      $trainee = $request->session()->get('trainee');
      $traineeObj = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type','session_state', 'round', 'completed', 'session_end_time')->where('id', $trainee->id)->first();
      if ($traineeObj) {
        $sessionEndTime = $traineeObj->session_end_time?json_decode($traineeObj->session_end_time):$this->sessionEndTime;
        switch($traineeObj->round) {
          case 1:
            $traineeObj->round = 2;
            $sessionEndTime->roundOne = now();
            $round = 'first';
          break;
          case 2:
            $traineeObj->completed = 1;
            $traineeObj->session_state = 'completed';
            $sessionEndTime->roundTwo = now();
            $round = 'second';
          break;
        }
        $sessionNumber = $traineeObj->session_number;
        $traineeObj->session_end_time = json_encode($sessionEndTime);
        $traineeObj->save();
      }
      return view('msmt.sessions.questions.complete', compact('round', 'sessionNumber', 'homeURL'));
    }
     return redirect($this->index);
  }

  /**
   * On completting the session story the user is redirected to completion page.
   * @return \Illuminate\Http\Response
   */
  
}