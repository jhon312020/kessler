<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Task;
use App\Models\Word;
use App\Models\Booster;
class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  private $boosterSession = 'booster';
  private $booster = array();
  public function __construct() {
	$sideMenu = array('dashboard'=>array('name'=>'Dashboard', 'url'=>'/dashboard','icon'=>'fa-tachometer-alt', 'role'=>''),
                'trainee'=>array('name'=>'Trainee Information', 'url'=>'/trainee','icon'=>'fa-table', 'role'=>''), 
                'trainer'=>array('name'=>'Trainer', 'url'=>'/trainer','icon'=>'fa-table', 'role'=>'SA'), 
                'overview'=>array('name'=>'Overview', 'url'=>'/overview','icon'=>'fa-table', 'role'=>'SA'),
                'instruction'=>array('name'=>'Instruction', 'url'=>'/instruction','icon'=>'fa-table', 'role'=>'SA'),
                'story'=>array('name'=>'Story', 'url'=>'/story','icon'=>'fa-table', 'role'=>'SA'),
                'word'=>array('name'=>'Word', 'url'=>'/word','icon'=>'fa-table', 'role'=>'SA'),
                'type'=>array('name'=>'Session Type', 'url'=>'/type','icon'=>'fa-table', 'role'=>'SA'),
                'booster'=>array('name'=>'Booster Category', 'url'=>'/booster','icon'=>'fa-table', 'role'=>'SA'),
               // 'quiz'=>array('name'=>'Quiz', 'url'=>'/quiz','icon'=>'fa-table', 'role'=>'SA'),
                'Booster Section'=>array('name'=>'Booster Session', 'url'=>'#', 'icon'=>'fa-columns', 'role'=>'SA', 'subitems'=>array('direction'=>array('name'=>'Direction', 'url'=>'/direction', 'icon'=>'fa-table', 'role'=>'SA',), 'shopping'=>array('name'=>'Shopping', 'url'=>'/shopping','icon'=>'fa-table','role'=>'SA'), 'to-do'=>array('name'=>'To-Do', 'url'=>'/todo','icon'=>'fa-table', 'role'=>'SA')))
              );

  	\View::share('sideMenu', $sideMenu);
    
  }

  /**
   * Common function to print the array values
   * in a user understanding form
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Contracts\Support\Renderable
   */
  
  function pr($data) {
  	echo '<pre>';
  	print_r($data);
  	echo '</pre>';
  }

  /**
   * Get the words for story building, based on the 
   * trainee session details
   *
   * @param  $trainee
   * @return array
   */
  function getWords($trainee) {
    $this->booster = Booster::pluck('category','id');
    //$this->pr($trainee);
    
    if (strtolower($trainee['session_number']) === $this->boosterSession) {
      //echo 'came in';
      $wordObj = Task::select('task as word', 'words')->where('booster_id', $trainee['booster_id'])->where('booster_range', $trainee['booster_range'])->get();
    } else {

      if ($trainee['booster_id']) {
        $type = strtolower($this->booster[$trainee['booster_id']]);
        
        //$wordObj = Word::where('story_id', $trainee['session_number'])->where('type', "$type")->pluck('word');
        $wordObj = Word::select('word', 'contextual_cue', 'question', 'sentence_type')->where('story_id', $trainee['session_number'])->where('type', "$type")->get('word');
      } else {

        $wordObj = Word::select('word')->where('story_id', $trainee['session_number'])->get('word');
    //     echo $trainee;
    // exit;
      }
      
    }
    return $wordObj;
  }

  /**
   * Get the words for story building, based on the 
   * trainee session details
   *
   * @param  $trainee
   * @return array
   */                                                                                                                      
  function getWordAndID($trainee) {
    $this->booster = Booster::pluck('category','id');
    if (strtolower($trainee['session_number']) == $this->boosterSession) {
      $wordObj = Task::where('booster_id', $trainee['booster_id'])->where('booster_range', $trainee['booster_range'])->pluck('task as word', 'id');
    } else {
      if ($trainee['booster_id']) {
        $type = strtolower($this->booster[$trainee['booster_id']]);
        $wordObj = Word::where('story_id', $trainee['session_number'])->where('type', "$type")->orderBy('id', 'asc')->pluck('words', 'id');
      } else {
        $wordObj = Word::where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->pluck('word', 'id');
      }
      
    }
    return $wordObj;
  }

  /**
   * Get the words for story building, based on the 
   * trainee session details
   *
   * @param  $trainee
   * @return array
   */
  function getCurrentWord($trainee, $wordID) {
    $this->booster = Booster::pluck('category','id');
    if ($trainee['session_number'] == $this->boosterSession) {
      $wordObj = Task::select('id', 'task as word', 'task as question', 'categorical_cue')->where('booster_id', $trainee['booster_id'])->where('id', $wordID)->where('booster_range', $trainee['booster_range'])->first();
    } else {
      if ($trainee['booster_id']) {
        $type = strtolower($this->booster[$trainee['booster_id']]);
        $wordObj = Word::select('id', 'words as word', 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->where('type', "$type")->first();
      } else {
        $wordObj = Word::select('id', 'word', 'words', 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();
      }
      
    }
    return $wordObj;
  }

  /**
   * Get the words for story building, based on the 
   * trainee session details
   *
   * @param  $trainee
   * @return array
   */
  function getWordAndIDObj($traineeObj) {
    $this->booster = Booster::pluck('category','id');
    if (strtolower($traineeObj['session_number']) === $this->boosterSession) {
      $wordObj = Task::select('id', 'task as word')->where('booster_id', $traineeObj->booster_id)->where('booster_range', $traineeObj->booster_range)->get();
    } else {
      if ($traineeObj['booster_id']) {
        $type = strtolower($this->booster[$traineeObj['booster_id']]);
        $wordObj = Word::select('id', 'words as word')->where('story_id', $traineeObj['session_number'])->where('type', "$type")->orderBy('id', 'asc')->get();
      } else {
        $wordObj = Word::select('id', 'word')->where('story_id', $traineeObj['session_number'])->orderBy('id', 'asc')->get();
      }
      
    }
    return $wordObj;
  }
  /**
   * Get the words for story building, based on the 
   * trainee session details
   *
   * @param  $trainee
   * @return array
   */
  function getStoryWords($trainee, $storyWords) {
    if ($trainee['booster_id']) {
      $storyWords = $storyWords->pluck('words');
    } else {
      $storyWords = $storyWords->pluck('word');
    }
    return $storyWords;
  }

}
