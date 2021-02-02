<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TraineeTransaction;
use App\Models\TraineeJourney;
use App\Models\Trainee;
use Redirect, Response;
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
      $showAnswer = 0;
      $iconWrongORRight = '<i class="fa fa-times" style="color:#721c24"></i>';
      //$this->pr($request->all());
      if ($request->session()->has('trainee')) {
        $timeTaken = (int)(($request->endTime - $request->startTime)/1000);
        $trainee = $request->session()->get('trainee');
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        $remove = ['_token', '_method', 'endTime', 'startTime', 'categoryCue', 'showedAnswer'];
        $traineeAnswer = array_diff_key($request->all(), array_flip($remove));
        foreach($traineeAnswer as $key=>$answer) {
          $wordKey = explode('-', $key);
          $wordID = array_pop($wordKey);
          $answer = $answer;
        }
        $lastWord = Word::select('id')->where('story_id', $trainee['session_number'])->orderBy('id', 'desc')->first();
        $word = Word::select('id', 'word', 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();
        if ($word) {
          if (!$request->showedAnswer) {
            $traineeTransaction['correct_or_wrong'] = 0;
            $traineeTransaction['round'] = 1;
            $traineeTransaction['trainee_id'] = $trainee['trainee_id'];
            $traineeTransaction['story_id'] = $trainee['session_number'];
            $traineeTransaction['word_id'] = $wordID;
            $traineeTransaction['session_pin'] = $trainee['session_pin'];
            $traineeTransaction['time_taken'] = $timeTaken;
            $traineeTransaction['round'] = $trainee['round'];
            $traineeTransaction['type'] = 'contextual';
            $traineeTransaction['answer'] = $answer;
            if ($word['word'] == strtoupper($answer) ) {
              $traineeTransaction['correct_or_wrong'] = 1;
              $iconWrongORRight = '<i class="fa fa-check" style="color:#155724"></i>';
              $showAnswer = 1;
              $response['answer'] = 'Wow your answer is correct : '.$word['word'];
              $response['is_answer_correct'] = 1;
            } else if($request->categoryCue && $word['word'] != strtoupper($answer)) {
              $response['answer'] = 'Oops sorry! The Right answer is : '.$word['word'];
              $response['is_answer_correct'] = 0;
            }

            if ($request->categoryCue) {
              $showAnswer = 1;
              $traineeTransaction['type'] = 'categorical';
              
            }
            TraineeTransaction::insert($traineeTransaction);
          }
          // if ($word['word'] == strtoupper($answer) || $request->categoryCue) {
          //   $word = Word::select('id', 'word', 'question')->where('id','>', $wordID)->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
          // } 
          if (!$showAnswer && $request->showedAnswer) {
            $word = Word::select('id', 'word', 'question')->where('id','>', $wordID)->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
          } 
          
        }
        if ($word) {
          //$this->pr($word->toArray());
          $traineeRecord->session_current_position = $word['id'];
          $traineeRecord->state = 1;
          $traineeRecord->save();
          $question = $word['question'];
          $findWord = $word['word'];
          if ($showAnswer) {
            $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$word['id']."' id='answer' value='".$answer."' readonly autocomplete='off'> $iconWrongORRight", $question);
          } else {
            $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$word['id']."' id='answer' autocomplete='off'>", $question);
          }
          $question = str_replace("$$", str_repeat("_", 15), $question);
          $response['question'] = $question;
          $response['categorical_cue'] = null;
          $response['reload'] = false;
          $response['show_answer'] = $showAnswer;
          if ($wordID == $word['id']) {
            $response['categorical_cue'] = $word['categorical_cue'];
          }
          return $response;
        } else if ($wordID == $lastWord->id) {
          $traineeRecord->session_current_position = null;
          $traineeRecord->state = 0;
          $response['completed'] = true;
          $response['redirectURL'] = url("/complete");
          $request->session()->put('completed', true);
        }
        $traineeRecord->save();
        return $response;
      } else {
        return $respone;
      }
  }

    /**
     * Store the recorded list of words
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */   
    public function save(Request $request) {
      $response['reload'] = true;
      $showAnswer = 0;
      $iconWrongORRight = '<i class="fa fa-times" style="color:#721c24"></i>';
      //$this->pr($request->all());
      if ($request->session()->has('trainee')) {
        $timeTaken = (int)(($request->endTime - $request->startTime)/1000);
        $trainee = $request->session()->get('trainee');
        $remove = ['_token', '_method', 'endTime', 'startTime', 'categoryCue', 'showedAnswer'];
        $traineeAnswer = array_diff_key($request->all(), array_flip($remove));
        foreach($traineeAnswer as $key=>$answer) {
          $wordKey = explode('-', $key);
          $wordID = array_pop($wordKey);
          $answer = $answer;
        }
        $lastWord = Word::select('id')->where('story_id', $trainee['session_number'])->orderBy('id', 'desc')->first();
        $word = Word::select('id', 'word', 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();
        if ($word) {
          if (!$request->showedAnswer) {
            $traineeTransaction['correct_or_wrong'] = 0;
            $traineeTransaction['round'] = 1;
            $traineeTransaction['trainee_id'] = $trainee['trainee_id'];
            $traineeTransaction['story_id'] = $trainee['session_number'];
            $traineeTransaction['word_id'] = $wordID;
            $traineeTransaction['session_pin'] = $trainee['session_pin'];
            $traineeTransaction['time_taken'] = $timeTaken;
            $traineeTransaction['round'] = $trainee['round'];
            $traineeTransaction['type'] = 'contextual';
            $traineeTransaction['answer'] = $answer;
            if ($word['word'] == strtoupper($answer) ) {
              $traineeTransaction['correct_or_wrong'] = 1;
              $iconWrongORRight = '<i class="fa fa-check" style="color:#155724"></i>';
              $showAnswer = 1;
              $response['answer'] = 'Wow your answer is correct : '.$word['word'];
              $response['is_answer_correct'] = 1;
            } else if($request->categoryCue && $word['word'] != strtoupper($answer)) {
              $response['answer'] = 'Oops sorry! The Right answer is : '.$word['word'];
              $response['is_answer_correct'] = 0;
            }

            if ($request->categoryCue) {
              $showAnswer = 1;
              $traineeTransaction['type'] = 'categorical';
              
            }
            TraineeTransaction::insert($traineeTransaction);
          }
          // if ($word['word'] == strtoupper($answer) || $request->categoryCue) {
          //   $word = Word::select('id', 'word', 'question')->where('id','>', $wordID)->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
          // } 
          if (!$showAnswer && $request->showedAnswer) {
            $word = Word::select('id', 'word', 'question')->where('id','>', $wordID)->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
          } 
          
        }
        if ($word) {
          //$this->pr($word->toArray());
          $question = $word['question'];
          $findWord = $word['word'];
          if ($showAnswer) {
            $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$word['id']."' id='answer' value='".$answer."' readonly autocomplete='off'> $iconWrongORRight", $question);
          } else {
            $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$word['id']."' id='answer' autocomplete='off'>", $question);
          }
          
          $question = str_replace("<input id='answer' class='fill-ups'>", str_repeat("_", 15), $question);
          $response['question'] = $question;
          $response['categorical_cue'] = null;
          $response['reload'] = false;
          $response['show_answer'] = $showAnswer;
          if ($wordID == $word['id']) {
            $response['categorical_cue'] = $word['categorical_cue'];
          }
          return $response;
        } else if ($wordID == $lastWord->id) {
          $response['completed'] = true;
          $response['redirectURL'] = url("/complete");
          $request->session()->put('completed', true);
        }
        return $response;
      } else {
        return $respone;
      }
  }
}