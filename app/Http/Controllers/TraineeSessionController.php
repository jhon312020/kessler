<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TraineeTransaction;
use App\Models\TraineeStory;
use App\Models\Trainee;
use Redirect,Response;
use Auth;
use DB;
use App\Models\Story;
use App\Models\Word;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;

class TraineeSessionController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $traineeCurrentPosition;
    public function __construct() {
      $this->traineeCurrentPosition = (object)array('word_id'=>'', 'position'=>'', 'user_word_id'=>'', 'sentence'=>'');
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
          $record = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type', 'round', 'completed', 'session_current_position', 'booster_id', 'booster_range')->where('session_pin', $request->sessionpin)->where('completed', 0)->first();
          if ($record) {
            $request->session()->put('trainee', $record);
            if ($record['session_number'] <= 4) {
              return redirect('sessions');
            } else {
              return redirect('write');
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
            $findWord = $word['word'];
            $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$wordID."' id='answer' autocomplete='off'>", $question);
            $question = str_replace("$$", str_repeat("_", 15), $question);
            $submitURL = url('next');
            return view('msmt.sessions.questions.show', compact('question', 'showTraineeMessage', 'submitURL'));
          }
        }
      } else {
        return redirect('/index');
      }
    }

    /**
     * Story writing by trainee
     * @return \Illuminate\Http\Response
     */
    public function writing(Request $request) {
     if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee');
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        if ($traineeRecord) {
          $traineeCurrentPosition = $traineeRecord->session_current_position !== null?json_decode($traineeRecord->session_current_position):$this->traineeCurrentPosition;
          $wordStory = $this->getWords($traineeRecord);
          //$this->pr($traineeRecord);
          $allWords = $words = $wordStory->toArray();
          //$this->pr($allWords);
          if ($traineeCurrentPosition->position === 'review' || $traineeCurrentPosition->position === 'tale' ) {
            return redirect('/review');
          } else if ($traineeCurrentPosition->position === 'recall' ) {
            $allWords = count($allWords);
            $submitURL = url('cue');
            return view('msmt.sessions.recallwords.remember', compact('allWords','traineeRecord', 'submitURL'));
          } else if ($traineeCurrentPosition->position === 'answer') {
            return redirect('/cue');
          } else {
            $allWords = implode(',',$allWords);
            $words = array_chunk($words, 5, true);
            return view('msmt.sessions.word', compact('words', 'allWords'));
          }
        } else {
          return redirect('/index');
        }
      } else {
        return redirect('/index');
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
        //$storyWords = Word::where('story_id', $trainee['session_number'])->pluck('word');
        $storyWords = $this->getWords($trainee);
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
        // $this->pr($userWords);
        // $this->pr($userStoryWords);
        // exit;
        $traineeStory['trainee_id'] = $trainee['trainee_id'];
        $traineeStory['story_id'] = $trainee['session_number'];
        $traineeStory['session_pin'] = $trainee['session_pin'];
        $traineeStory['round'] = $trainee['round'];
        $traineeStory['original_story'] = $story;
        $traineeStory['updated_story'] = $newString;
        $userStoryWords = array_values(array_unique($userStoryWords));
        $traineeStory['user_story_words'] = json_encode($userStoryWords);
        $this->traineeCurrentPosition->position = 'review';
        if (TraineeStory::insert($traineeStory)) {
          $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
          $traineeRecord->session_state = 'continue';
          $traineeRecord->save();
        }
        return redirect('/review');
      } else {
        return redirect('/index');
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
        //$this->pr($trainee);
        $story = TraineeStory::select('updated_story as story', 'reviewed')->where('trainee_id', $trainee['trainee_id'])->where('story_id', $trainee['session_number'])->where('session_pin', $trainee['session_pin'])->where('round', $trainee['round'])->orderBy('id', 'desc')->first();
        if ($story && $story['reviewed']) {
          //$storyWords = Word::where('story_id', $trainee['session_number'])->pluck('word');
          $storyWords = $this->getWords($trainee);
          foreach ($storyWords as $word) {
            $story->story = str_replace($word, "<span class='emboss'>$word</span>", $story->story);
          }
          $linkURL = url('recallword');
          return view('msmt.sessions.story', compact('story', 'trainee', 'linkURL'));
        } else {
          return view('msmt.sessions.review');
        }
      }
      return redirect('/index');
    }

    /**
     * On continuation with the story the next step is to recall words from the story
     * @return \Illuminate\Http\Response
     */
    public function remember(Request $request) {
      if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee'); 
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        //$wordStory = Word::where('story_id', $trainee['session_number'])->pluck('word');
        $wordStory = $this->getWords($trainee);
        $allWords = $words = $wordStory->toArray();
        $allWords = count($allWords);
        $traineeCurrentPosition = $traineeRecord->session_current_position?json_decode($traineeRecord->session_current_position):$this->traineeCurrentPosition;
        if ($traineeCurrentPosition->position === 'recall' || $traineeCurrentPosition->position === '') {
           $this->traineeCurrentPosition->position = 'recall';
          $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
          $traineeRecord->session_state = 'continue';
          $traineeRecord->save();
          $submitURL = url('sessions');
          return view('msmt.sessions.recallwords.remember', compact('allWords','traineeRecord', 'submitURL'));
        } 
      }
      return redirect('/index');
    }

    public function recollect(Request $request) {
      if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee'); 
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        //$wordStory = Word::where('story_id', $trainee['session_number'])->pluck('word');
        $wordStory = $this->getWords($trainee);
        $allWords = $words = $wordStory->toArray();
        $allWords = count($allWords);
        $traineeCurrentPosition = $traineeRecord->session_current_position?json_decode($traineeRecord->session_current_position):$this->traineeCurrentPosition;
        //$this->pr($allWords);
        if ($traineeCurrentPosition->position === 'recall' || $traineeCurrentPosition->position === 'tale') {
          $this->traineeCurrentPosition->position = 'recall';
          $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
          $traineeRecord->save();
          $submitURL = url('cue');
          return view('msmt.sessions.recallwords.remember', compact('allWords','traineeRecord', 'submitURL'));
        } 
      }
      return redirect('/index');
    }

    /**
     * Store the recorded list of words of session 1-4
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */   
    public function store(Request $request) {
      if ($request->session()->has('trainee')) {
        $timeTaken = (int)(($request->endTime - $request->startTime)/1000);
        $trainee = $request->session()->get('trainee');
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        //$this->pr($trainee);
        $data = $request->only('words');
        $traineeTransaction['answer'] = json_encode($data);
        $traineeTransaction['trainee_id'] = $trainee['trainee_id'];
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
          $findWord = $word['word'];
          $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$wordID."' id='answer' autocomplete='off'>", $question);
          $question = str_replace("$$", str_repeat("_", 15), $question);
        } 
        $submitURL = url('next');
        return view('msmt.sessions.questions.show', compact('question', 'showTraineeMessage', 'submitURL'));
      } else {
        return redirect('/index');
      }
    }

    /**
     * Save the recorded list of words of session 5 - 8
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
          //$this->pr($trainee);
          $data = $request->only('words');
          $traineeTransaction['answer'] = json_encode($data);
          $traineeTransaction['trainee_id'] = $trainee['trainee_id'];
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
        return redirect('/index');
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
          return redirect('/index');
        }
        $userStoryWords = json_decode($story->user_story_words);
        $totalUsersWords = count($userStoryWords);
        $userWordKey = $traineeCurrentPosition->user_word_id;
        $sentenceKey = $traineeCurrentPosition->sentence;
        $fillUpWord = $userStoryWords[$userWordKey];
      }
      $breakParentLoop = false;
      $showTraineeMessage = ($userWordKey)?false:true;
      foreach (array_slice($storySentences, $sentenceKey) as $question) {
        foreach(array_slice($userStoryWords, $userWordKey) as $wordKey=>$word) {
          $findWord = '/\b'.$word.'\b/';
          if ($fillUpWord === $word) {
            $storyWordID = array_search($word, $allStoryWords);
            $question = preg_replace($findWord, "<input id='answer' class='fill-ups' autocomplete='off' name='answer-".$storyWordID."'>", $question, 1, $count);
            $breakParentLoop = true;
          } else {
            $question = preg_replace($findWord, str_repeat("_", 15), $question, 1);
          }
        }
        if ($breakParentLoop) {
          break;
        }
      }
      //return view('msmt.sessions.questions.cue', compact('story', 'question', 'showTraineeMessage'));
      $submitURL = url('after');
      return view('msmt.sessions.questions.show', compact('question', 'showTraineeMessage', 'submitURL'));
    } else {
      return redirect('/index');
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
      $traineeObj = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type', 'round', 'completed')->where('id', $trainee->id)->first();
      if ($traineeObj) {
        switch($traineeObj->round) {
          case 1:
            $traineeObj->round = 2;
            $round = 'first';
          break;
          case 2:
            $traineeObj->completed = 1;
            $round = 'second';
          break;
        }
        $sessionNumber = $traineeObj->session_number;
        $traineeObj->save();
      }
      return view('msmt.sessions.questions.complete', compact('round', 'sessionNumber', 'homeURL'));
    }
     return redirect('/index');
  }

  /**
   * On completting the session story the user is redirected to completion page.
   * @return \Illuminate\Http\Response
   */
  // public function finish(Request $request) {
  //   if ($request->session()->has('completed')) {
  //     $sessionNumber = '';
  //     $request->session()->forget('completed');
  //     $trainee = $request->session()->get('trainee');
  //     $traineeObj = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type', 'round', 'completed')->where('id', $trainee->id)->first();
  //     if ($traineeObj) {
  //       switch($traineeObj->round) {
  //         case 1:
  //           $traineeObj->round = 2;
  //           $round = 'first';
  //         break;
  //         case 2:
  //           $traineeObj->completed = 1;
  //           $round = 'second';
  //         break;
  //       }
  //       $sessionNumber = $traineeObj->session_number;
  //       $traineeObj->save();
  //     }
  //     return view('msmt.sessions.questions.complete', compact('round', 'sessionNumber'));
  //   }
  //    return redirect('/index');
  // }
}