<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TraineeTransaction;
use App\Models\TraineeJourney;
use Redirect,Response;
use Auth;
use DB;
use App\Models\Story;
use App\Models\Words;
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

    public function index(Request $request){

        //return view ('msmt.user.home');
      $validator = [];
         if ($request->isMethod('post')) {
          $validator = Validator::make($request->all(), [
            'sessionpin' => 'required'
            
        ]);

        if (!$validator->fails()) {
            $record = TraineeJourney::select('id', 'trainee_id', 'session_pin', 'session_number', 'session_type')->where('session_pin', $request->sessionpin)->first();
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
        $msmt = Story::select('*')->where('id', $trainee['session_number'])->get(); 
        return view('msmt.sessions.sessionstories')->with('msmt',$msmt);
      } else {
        return redirect('home');
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
        $traineeTransaction['time_taken'] = $timeTaken;
        $traineeTransaction['type'] = 'Recall';
        TraineeTransaction::insert($traineeTransaction);
        //$story = Story::select('id', 'story')->where('id', $trainee['session_number'])->first();
        $wordID = 1;
        $word = Words::select('id', 'word', 'question')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();
        //$this->pr($word->toArray());
        if ($word) {
          $question = $word['question'];
          $findWord = $word['word'];
          $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$wordID."' id='answer'>", $question);
          $question = str_replace("$$", str_repeat("_", 15), $question);
        } 
        return view('msmt.sessions.questions.sessionquestions')->with('question',$question);
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
        return view('msmt.sessions.questions.complete');
      }
       return redirect('home');
    }
}