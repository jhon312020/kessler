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
  private $wordsAs = 'words as word';
  private $booster = array();
  public $directionBoosterID;
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
   
    if (strtolower($trainee['session_number']) === $this->boosterSession) {
   
      $wordObj = Task::select('task as word', 'question', 'words')->where('booster_id', $trainee['booster_id'])->where('booster_range', $trainee['booster_range'])->get();
    } else {
      
      if ($trainee['booster_id']) {

        $type = strtolower($this->booster[$trainee['booster_id']]);
        
        $wordObj = Word::select('word', 'contextual_cue', 'question', 'words')->where('story_id', $trainee['session_number'])->where('type', "$type")->get('word');

      } else {
           
        $wordObj = Word::select('word')->where('story_id', $trainee['session_number'])->get('word');

    
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
      
      $wordObj = Task::where('booster_id', $trainee['booster_id'])->where('booster_range', $trainee['booster_range'])->pluck($this->wordsAs, 'id');
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
    if (strtolower($trainee['session_number']) == $this->boosterSession) {
      $wordObj = Task::select('id', $this->wordsAs, 'task as question', 'categorical_cue')->where('booster_id', $trainee['booster_id'])->where('id', $wordID)->where('booster_range', $trainee['booster_range'])->first();
    } else {
      if ($trainee['booster_id']) {
        $type = strtolower($this->booster[$trainee['booster_id']]);
        $wordObj = Word::select('id', $this->wordsAs, 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->where('type', "$type")->first();
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
      $wordObj = Task::select('id', $this->wordsAs)->where('booster_id', $traineeObj->booster_id)->where('booster_range', $traineeObj->booster_range)->get();
      
    } else {
      if ($traineeObj['booster_id']) {
        $type = strtolower($this->booster[$traineeObj['booster_id']]);
        $wordObj = Word::select('id', $this->wordsAs)->where('story_id', $traineeObj['session_number'])->where('type', "$type")->orderBy('id', 'asc')->get();
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

  /**
   * Get the sentenceKey of story, based on the 
   * words array
   *
   * @params  $sentences, $words
   * @return integer
   */
  function getSentenceKey($sentences, $words) {
    $detecedKey = 0;
    foreach ($sentences as $sentenceKey=>$sentence) {
      
      $newSentence = $sentence;
      foreach($words as $wordkey=>$word) {
        $pos = strpos($newSentence, $word);
        if ($pos !== false) {
          $length = $pos + strlen($word);
          $newSentence = substr($sentence, $length);
          unset($words[$wordkey]);
        }
      }
      $wordCount = count($words);
      if ($wordCount == 0) {
        $detecedKey = $sentenceKey;
        break;
      }
    }
    return $detecedKey;
  }

  /**
   * Get the sentenceKey of story, based on the 
   * words array
   *
   * @params  $sentences, $words
   * @return integer
   */
  function getRevisedStoryForDirection($storyWords, $userStory) {
    $revisedStory = '';
    foreach($storyWords as $word) {
      $searchWord = strtolower($word);
      $findWord = '/\b'.$searchWord.'\b/i';
      $userStory = preg_replace($findWord, $word, $userStory, 1);
      $wordPosition = stripos($userStory, $searchWord);
      $strLen = strlen($searchWord);
      $copyPosition = $wordPosition + $strLen;
      $revisedStory .= subStr($userStory, 0, $copyPosition);
      $userStory = substr($userStory, $copyPosition);
    }
    return $revisedStory;
  }

   /**
   * Get the sentenceKey of story, based on the 
   * words array
   *
   * @params  $sentences, $words
   * @return integer
   */
  function getRevisedStory($storyWords, $userStory) {
    foreach($storyWords as $word) {
      $searchWord = strtolower($word);
      $findWord = '/\b'.$searchWord.'\b/i';
      $userStory = preg_replace($findWord, $word, $userStory, 1);
    }
    return $userStory;
  }

   /**
   * Get the storyword, based on the 
   * word id
   *
   * @params  $transactionDetail
   * @return objet
   */
  function getWord($transactionDetail) {
    $wordObj = null;
    try {
      if (strtolower($transactionDetail->story_id) === $this->boosterSession) {
        $wordObj = Task::select($this->wordsAs)->where('id',$transactionDetail->word_id)->firstOrFail();
      } else {
        $story_id = (int)$transactionDetail['story_id'];
        if ($story_id > 8) {
          $wordObj = Word::select($this->wordsAs)->where('id', $transactionDetail->word_id)->firstOrFail('word');
        } else {
          $wordObj = Word::select('word')->where('id', $transactionDetail->word_id)->firstOrFail('word');
        }
      }
    } catch(\Exception $e) {
      Log::error($e);
    }
    return $wordObj;
  }

  function rowsOfTable($request, $boosterID)
  {
      $start = $request->get("start");
      $rowperpage = $request->get("length");    
      $search_arr = $request->get('search');   
      $searchValue = $search_arr['value'];
      $totalRecords = Task::select('*')->Where('booster_id',$boosterID)->count();
      
      $totalRecordswithFilters = Task::select('*')->where('booster_id',$boosterID)->where(function($search) use ($searchValue){
                          $search->where('task', 'like', '%' .$searchValue . '%')->orWhere('words', 'like', '%' .$searchValue . '%');
                      });


      $totalRecordswithFilter = with(clone $totalRecordswithFilters)->count();
      $queryObj = with(clone $totalRecordswithFilters)->skip($start)->take($rowperpage)->get();


      return compact('queryObj', 'totalRecordswithFilter', 'totalRecords');   
  }
}
