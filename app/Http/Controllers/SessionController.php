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
use Illuminate\Support\Facades\Validator;

class SessionController extends Controller
{
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
          $record = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type', 'round', 'completed', 'session_current_position')->where('session_pin', $request->sessionpin)->where('completed', 0)->first();
          if ($record) {
            $request->session()->put('trainee', $record);
            return redirect('sessions');
          } else {
             $validator->errors()->add('sessionpin', 'INVALID PIN! Please contact your trainer..');
          } 
        } 
      } 
      return view('msmt.user.home')->withErrors($validator);
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
         if ($traineeRecord->session_current_position == 'recall' || $traineeRecord->session_current_position == '') {
            $story = Story::select('*')->where('id', $trainee['session_number'])->first(); 
            return view('msmt.sessions.story')->with('story', $story);
         } else {
          $startWord = Word::select('id', 'word', 'question')->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
          $word = Word::select('id', 'word', 'question')->where('story_id', $trainee['session_number'])->where('id', $traineeRecord->session_current_position)->orderBy('id', 'asc')->first();
            if ($word) {
              TraineeTransaction::where('story_id', $trainee['session_number'])->where('word_id', $traineeRecord->session_current_position)->where('round', $traineeRecord->round)->delete();
              $showTraineeMessage = ($startWord['id']==$word['id'])?true:false;
              $traineeRecord->session_current_position = $word['id'];
              $traineeRecord->save();
              $wordID = $word['id'];
              $question = $word['question'];
              $findWord = $word['word'];
              $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$wordID."' id='answer'>", $question);
              $question = str_replace("$$", str_repeat("_", 15), $question);
              return view('msmt.sessions.questions.show', compact('question', 'showTraineeMessage'));
            }
         }
      } else {
        return redirect('/');
      }
    }

    /**
     * Story writing by trainee
     * @return \Illuminate\Http\Response
     */
    public function writings(Request $request) {
     if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee'); 
        $wordStory = Word::select('word')->where('story_id', $trainee['session_number'])->get();
        return view('msmt.sessions.word')->with('wordStory', $wordStory);
      } else {
        return redirect('/');
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
        //$wordStory = Word::select('word')->where('story_id', $trainee['session_number'])->get();
        /*$this->pr($wordStory->toArray());
        exit();*/
        $story = $request->get('story');
        $traineeStory['trainee_id'] = $trainee['trainee_id'];
        $traineeStory['story_id'] = $trainee['session_number'];
        $traineeStory['session_pin'] = $trainee['session_pin'];
        $traineeStory['round'] = $trainee['round'];
        $traineeStory['story'] = $story;
        TraineeStory::insert($traineeStory);
        /*$this->pr($traineeStory);
        exit();*/
        $story = TraineeStory::select('story')->where('trainee_id', $trainee['trainee_id'])->where('story_id', $trainee['session_number'])->where('session_pin', $trainee['session_pin'])->first();
        return view('msmt.sessions.story')->with('story', $story);
      } else {
        return redirect('/');
      }
    }

    /**
     * On continuation with the story the next step is to recall words from the story
     * @return \Illuminate\Http\Response
     */
    public function recall(Request $request) {
      if ($request->session()->has('trainee')) {
        $trainee = $request->session()->get('trainee'); 
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        if ($traineeRecord->session_current_position == 'recall' || $traineeRecord->session_current_position == '') {
          $traineeRecord->session_current_position = 'recall';
          $traineeRecord->save();
          return view('msmt.sessions.recallwords.index');
        } 
      }
      return redirect('/');
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
        //$record = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type', 'round', 'completed', 'session_completed_position')->where('session_pin', $request->sessionpin)->where('completed', 0)->first();
        //$story = Story::select('id', 'story')->where('id', $trainee['session_number'])->first();
        //$word = Word::select('id', 'word', 'question')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();
        $word = Word::select('id', 'word', 'question')->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
        //$this->pr($word->toArray());
        if ($word) {
          $showTraineeMessage = true;
          $traineeRecord->session_current_position = $word['id'];
          $traineeRecord->save();
          $wordID = $word['id'];
          $question = $word['question'];
          $findWord = $word['word'];
          $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$wordID."' id='answer'>", $question);
          $question = str_replace("$$", str_repeat("_", 15), $question);
        } 
        return view('msmt.sessions.questions.show', compact('question', 'showTraineeMessage'));
      } else {
        return redirect('/');
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
        $timeTaken = (int)(($request->endTime - $request->startTime)/1000);
        $trainee = $request->session()->get('trainee');
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
        //$story = Story::select('id', 'story')->where('id', $trainee['session_number'])->first();
        //$word = Word::select('id', 'word', 'question')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();
        $story = TraineeStory::select('story')->where('trainee_id', $trainee['trainee_id'])->where('story_id', $trainee['session_number'])->where('session_pin', $trainee['session_pin'])->get();
        $word = Word::select('id', 'word', 'question')->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
        //$this->pr($word->toArray());
        if ($word) {
          $wordID = $word['id'];
          $question = $word['question'];
          $findWord = $word['word'];
          $question = str_replace($word['word'], "<input id='answer' class='fill-ups'>", $question);
          $question = str_replace("<input id='answer' class='fill-ups'>", str_repeat("_", 15), $question);
        } 
        return view('msmt.sessions.questions.cue')->with('story', $story);
      } else {
        return redirect('/');
      }
    }

  /**
   * On completting the session story the user is redirected to completion page.
   * @return \Illuminate\Http\Response
   */
  public function complete(Request $request) {
    if ($request->session()->has('completed')) {
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
        $traineeObj->save();
      }
      return view('msmt.sessions.questions.complete')->with('round', $round);
    }
     return redirect('/');
  }
}