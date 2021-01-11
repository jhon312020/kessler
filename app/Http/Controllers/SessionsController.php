<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainee;
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
        $trainee = $request->session()->get('trainee');
        //$this->pr($trainee);
        $data = $request->only('words');
        $traineeRecall['recall_words'] = json_encode($data);
        $traineeRecall['trainee_id'] = $trainee['trainee_id'];
        $traineeRecall['session_pin'] = $trainee['session_pin'];
        Trainee::insert($traineeRecall);
        $msmt = Story::select('id', 'story')->where('id', $trainee['session_number'])->get();
        if ($msmt) {
          $this->pr($msmt->toArray());
          $sessionStory = $msmt[0]['story'];
          $sessionStory = explode('.', $sessionStory);
          echo $sentence = $sessionStory[0];
          preg_match_all("/[A-Z][a-z]*/",$sentence, $op);
          print_r($op);
          echo $output;
        }
        

        //$msmt = Words::select('contextual_cue')->where('story_id', $trainee['session_number'])->get(); 
        return view('msmt.sessions.questions.sessionquestions')->with('msmt',$msmt);
      } else {
        return redirect('home');
      }
  }
}