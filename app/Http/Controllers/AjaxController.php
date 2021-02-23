<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TraineeTransaction;
use App\Models\TraineeJourney;
use App\Models\TraineeStory;
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
     * Create a new controller instance.
     *
     * @return void
     */
    private $traineeCurrentPosition;
    public function __construct() {
      $this->traineeCurrentPosition = (object) array('word_id'=>'', 'position'=>'', 'user_word_id'=>0, 'sentence'=>0);
    }
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
            $answer = strtoupper(trim($answer));
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
            if ($word['word'] == $answer ) {
              $traineeTransaction['correct_or_wrong'] = 1;
              $iconWrongORRight = '<i class="fa fa-check" style="color:#155724"></i>';
              $showAnswer = 1;
              $response['answer'] = 'Wow your answer is correct : '.$word['word'];
              $response['is_answer_correct'] = 1;
            } else if($request->categoryCue && $word['word'] != $answer) {
              $response['answer'] = 'Oops sorry! The Right answer is : '.$word['word'];
              $response['is_answer_correct'] = 0;
            }

            if ($request->categoryCue) {
              $showAnswer = 1;
              $traineeTransaction['type'] = 'categorical';
            }
            TraineeTransaction::insert($traineeTransaction);
          }
          if (!$showAnswer && $request->showedAnswer) {
            $word = Word::select('id', 'word', 'question')->where('id','>', $wordID)->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->first();
          } 
        }
        if ($word) {
          // if ($word['id'] > 2) {
          //   echo $traineeRecord->session_current_position = $word['id'];
          // }
          $this->traineeCurrentPosition->word_id = $word['id'];
          $this->traineeCurrentPosition->position = 'answer';
          $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
          $traineeRecord->save();
          $question = $word['question'];
          $findWord = $word['word'];
          if ($showAnswer) {
            $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$word['id']."' id='answer' value='".$answer."' readonly autocomplete='off'> $iconWrongORRight", $question);
          } else {
            $question = str_replace($word['word'], "<input class='fill-ups' name='answer-".$word['id']."' id='answer' autocomplete='off'>", $question);
          }
          $question = str_replace("$$", str_repeat("_", 15), $question);
          //$pattern = '/(\w+) (\d+), (\d+)/i';
          //$replacement = '${1}1,$3';
         //echo preg_replace($pattern, $replacement, $string);
          $response['question'] = $question;
          $response['categorical_cue'] = null;
          $response['reload'] = false;
          $response['show_answer'] = $showAnswer;
          if ($wordID == $word['id']) {
            $response['categorical_cue'] = '<span class="wrong">Your response is incorrect!</span> Try again <br/>"'.$word['categorical_cue'].'"';
            //$word['categorical_cue'];
          }
          return $response;
        } else if ($wordID == $lastWord->id) {
          $traineeRecord->session_current_position = null;
          //$traineeRecord->state = 0;
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
        $traineeRecord = Trainee::where('session_pin', $trainee['session_pin'])->first();
        $traineeCurrentPosition = json_decode($traineeRecord->session_current_position);
        $remove = ['_token', '_method', 'endTime', 'startTime', 'categoryCue', 'showedAnswer'];
        $traineeAnswer = array_diff_key($request->all(), array_flip($remove));
        $sentenceKey = 0;
        foreach($traineeAnswer as $key=>$answer) {
          $wordKey = explode('-', $key);
          $wordID = array_pop($wordKey);
          $answer = $answer;
        }
        //$lastWord = Word::select('id')->where('story_id', $trainee['session_number'])->orderBy('id', 'desc')->first();
        //$allStoryWords = Word::select('id', 'word')->where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->pluck('word', 'id')->all();
        $allStoryWords = $this->getWordAndID($trainee)->all();
        //$currentWord = Word::select('id', 'word', 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();
        $currentWord = $this->getCurrentWord($trainee, $wordID);
        $story = TraineeStory::select('updated_story', 'user_story_words')->where('trainee_id', $trainee['trainee_id'])->where('story_id', $trainee['session_number'])->where('session_pin', $trainee['session_pin'])->where('round', $trainee['round'])->orderBy('id', 'desc')->first();
        $userStoryWords = array();
        $totalUsersWords = 0;
        $userWordKey = 0;
        $addedInputBox = false;
        $storySentences = explode('. ',$story->updated_story);
        if ($story) {
          $userStoryWords = json_decode($story->user_story_words);
          //$userStoryWords = array_values(array_unique($userStoryWords));
          $totalUsersWords = count($userStoryWords);
          //$userWordKey = array_search($currentWord->word, $userStoryWords);
          $userWordKey = $traineeCurrentPosition->user_word_id ? $traineeCurrentPosition->user_word_id : array_search($currentWord->word, $userStoryWords);
          $sentenceKey = $traineeCurrentPosition->sentence ? $traineeCurrentPosition->sentence : 0;
          $this->traineeCurrentPosition->position = 'answer';
        }
        if ($currentWord) {
          $fillUpWord = $currentWord->word;
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
            if ($currentWord['word'] == strtoupper($answer) ) {
              $traineeTransaction['correct_or_wrong'] = 1;
              $iconWrongORRight = '<i class="fa fa-check" style="color:#155724"></i>';
              $showAnswer = 1;
              $response['answer'] = 'Wow your answer is correct : '.$currentWord['word'];
              $response['is_answer_correct'] = 1;
            } else if($request->categoryCue && $currentWord['word'] != strtoupper($answer)) {
              $response['answer'] = 'Oops sorry! The Right answer is : '.$currentWord['word'];
              $response['is_answer_correct'] = 0;
            }

            if ($request->categoryCue) {
              $showAnswer = 1;
              $traineeTransaction['type'] = 'categorical';
              
            }
            TraineeTransaction::insert($traineeTransaction);
          }
          if (!$showAnswer && $request->showedAnswer) {   
            if ($userWordKey !== false) {
              $userWordKey++;
              $this->traineeCurrentPosition->user_word_id =  $userWordKey;
              if ($userWordKey < $totalUsersWords ) {
                $fillUpWord = $userStoryWords[$userWordKey];
              } else {
                $fillUpWord = '';
              }
              
            }
          } 
        }
        
        if ($story && $fillUpWord) {
          $breakParentLoop = false;
          $counter =1;
          $count = 0;
          $sentenceKey = 0;
          foreach (array_slice($storySentences, $sentenceKey) as $sentenceKey=>$currentSentence) {
            //echo $currentSentence.'--'.$this->pr($userStoryWords);
            foreach(array_slice($userStoryWords, $userWordKey, null, true) as $wordKey=>$word) {
              $findWord = '/\b'.$word.'\b/';
              //echo '<br/>'.$findWord.'--'.$wordKey.'--userWordkey--'.$userWordKey.'--fillupword--'.$fillUpWord.'---CurrentWord'.$word;
              if ($fillUpWord === $word && !$addedInputBox) {
                $storyWordID = array_search($word, $allStoryWords);
                $this->traineeCurrentPosition->sentence = $sentenceKey;
                //echo 'came in';
                if ($showAnswer) {
                  $currentSentence = preg_replace($findWord, "<input class='fill-ups' name='answer-".$storyWordID."' id='answer' value='".$answer."' readonly autocomplete='off'> $iconWrongORRight", $currentSentence, 1, $count);
                  //echo '<br/>'.$currentSentence.'<br/>';
                  //If replacements happens we are breaking the parent loop
                  if ($count) {
                    $addedInputBox = true;
                    $breakParentLoop = true;
                  }
                } else {
                  
                  $currentSentence = preg_replace($findWord, "<input id='answer' class='fill-ups' name='answer-".$storyWordID."'>", $currentSentence, 1, $count);
                  //If replacements happens we are breaking the parent loop
                  if ($count) {
                    $breakParentLoop = true;
                    $addedInputBox = true;
                  }
                }
                
              } else {
                $currentSentence = preg_replace($findWord, str_repeat("_", 15), $currentSentence, -1, $count);
              }
            }
            if ($breakParentLoop) {
              break;
            } 
            $counter++;
          }
        }
        //$this->pr($traineeRecord->toArray());
        //$this->pr($this->traineeCurrentPosition);
        //echo $currentSentence;
        //   foreach($userStoryWords as $wordKey=>$word) {
        //     $findWord = $word;
        //     if ($wordKey < $userWordKey) {
        //       continue;
        //     } else if ($fillUpWord === $word && !$addedInputBox) {
        //       $addedInputBox = true;
        //       $storyWordID = array_search($word, $allStoryWords);
        //       if ($showAnswer) {
        //         $story->updated_story = str_replace($findWord, "<input class='fill-ups' name='answer-".$storyWordID."' id='answer' value='".$answer."' readonly autocomplete='off'> $iconWrongORRight", $story->updated_story);
        //       } else {
        //         $story->updated_story = str_replace($findWord, "<input id='answer' class='fill-ups' name='answer-".$storyWordID."'>", $story->updated_story);
        //       }
        //     } else {
        //       $story->updated_story = str_replace($findWord, str_repeat("_", 15), $story->updated_story);
        //     }
        //   }
        // }
        if ($fillUpWord) {
          $traineeRecord->session_current_position = json_encode($this->traineeCurrentPosition);
          $response['question'] = $currentSentence;
          $response['categorical_cue'] = null;
          $response['reload'] = false;
          $response['show_answer'] = $showAnswer;
          if ($fillUpWord === $currentWord['word']) {
            $response['categorical_cue'] = '<span class="wrong">Your response is incorrect!</span> Try again <br/> "'.$currentWord['categorical_cue'].'"';
          }
        } else if ($userWordKey >= $totalUsersWords) {
          $traineeRecord->session_current_position = null;
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
}