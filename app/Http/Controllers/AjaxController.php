<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TraineeTransaction;
use App\Models\TraineeJourney;
use Redirect,Response;
use Auth;
use DB;
use App\Models\Story;
use App\Models\Word;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    /**
     * Store the recorded list of words
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */   
    public function store(Request $request) {
      $response['reload'] = true;
      //$this->pr($request->all());
      if ($request->session()->has('trainee')) {
        $timeTaken = (int)(($request->endTime - $request->startTime)/1000);
        $trainee = $request->session()->get('trainee');
        $remove = ['_token', '_method', 'endTime', 'startTime', 'categoryCue'];
        $traineeAnswer = array_diff_key($request->all(), array_flip($remove));
        foreach($traineeAnswer as $key=>$answer) {
          $wordKey = explode('-', $key);
          $wordID = array_pop($wordKey);
          $answer = $answer;
        }

        $word = Word::select('id', 'word', 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();
        if ($word) {
          $traineeTransaction['correct_or_wrong'] = 0;
          $traineeTransaction['round'] = 1;
          $traineeTransaction['trainee_id'] = $trainee['trainee_id'];
          $traineeTransaction['story_id'] = $trainee['session_number'];
          $traineeTransaction['session_pin'] = $trainee['session_pin'];
          $traineeTransaction['time_taken'] = $timeTaken;
          $traineeTransaction['type'] = 'Contextual';
          $traineeTransaction['answer'] = $answer;
          if ($word['word'] == strtoupper($answer)) {
            $traineeTransaction['correct_or_wrong'] = 1;
          }
          if ($request->categoryCue) {
            $traineeTransaction['type'] = 'Categorical';
          }
          if ($word['word'] == strtoupper($answer) || $request->categoryCue) {
            $word = Word::select('id', 'word', 'question')->where('id','>', $wordID)->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
            
          } 
          TraineeTransaction::insert($traineeTransaction);
        }
        if ($word) {
          //$this->pr($word->toArray());
          $question = $word['question'];
          $findWord = $word['word'];
          $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$word['id']."' id='answer'>", $question);
          $question = str_replace("$$", str_repeat("_", 15), $question);
          $response['question'] = $question;
          $response['categorical_cue'] = null;
          $response['reload'] = false;
          if ($wordID == $word['id']) {
            $response['categorical_cue'] = $word['categorical_cue'];
          } 
          return $response;
        }
      } else {
        return $respone;
      }
  }
}