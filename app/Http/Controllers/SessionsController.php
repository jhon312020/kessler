<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TraineeTransaction;
use App\Models\Trainee;
use Redirect,Response;
use Auth;
use DB;
use App\Models\Story;
use App\Models\Word;
use Illuminate\Support\Facades\Validator;

class SessionsController extends Controller
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
      $validator = [];
       if ($request->isMethod('post')) {
          $validator = Validator::make($request->all(), [
            'sessionpin' => 'required'    
          ]);

        if (!$validator->fails()) {
          $record = Trainee::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type', 'round', 'completed')->where('session_pin', $request->sessionpin)->where('completed', 0)->first();
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
        $story = Story::select('*')->where('id', $trainee['session_number'])->first(); 
        return view('msmt.sessions.story')->with('story', $story);
      } else {
        return redirect('/');
      }
    }

    /**
     * On continuation with the story the next step is to recall words from the story
     * @return \Illuminate\Http\Response
     */
    public function recall(){
      return view('msmt.sessions.recallwords.index');
    }

    /**
     * Store the recorded list of words
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */   
    public function store(Request $request) {
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
        $word = Word::select('id', 'word', 'question')->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
        //$this->pr($word->toArray());
        if ($word) {
          $wordID = $word['id'];
          $question = $word['question'];
          $findWord = $word['word'];
          $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$wordID."' id='answer'>", $question);
          $question = str_replace("$$", str_repeat("_", 15), $question);
        } 
        return view('msmt.sessions.questions.show')->with('question', $question);
      } else {
        return redirect('home');
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