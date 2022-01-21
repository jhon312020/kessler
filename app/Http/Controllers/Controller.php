<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Task;
use App\Models\Word;
use App\Models\Booster;
use App\Models\General;
use App\Models\Contextual;

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
   
    switch ($trainee['session_type']) {
      case '4':
        $wordObj = Task::select('task as word', 'question', 'words')->where('booster_id', $trainee['booster_id'])->where('booster_range', $trainee['booster_range'])->get();
        break;
      case '3':
        $type = strtolower($this->booster[$trainee['booster_id']]);
        
        $wordObj = General::select('word', 'contextual_cue', 'question', 'words')->where('story_id', $trainee['session_number'])->where('type', "$type")->get('word');
      break;
      case '2':
        $wordObj = Contextual::select('word')->where('story_id', $trainee['session_number'])->get('word');
      break;
      default:
        $wordObj = Word::select('word')->where('story_id', $trainee['session_number'])->get('word');
      break;
    }
   
    //dd($wordObj);    
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
    switch ($trainee['session_type']) {
      case '4':
        $wordObj = Task::where('booster_id', $trainee['booster_id'])->where('booster_range', $trainee['booster_range'])->pluck($this->wordsAs, 'id');
      break;
      
      case '3':
        $type = strtolower($this->booster[$trainee['booster_id']]);
        $wordObj = General::where('story_id', $trainee['session_number'])->where('type', "$type")->orderBy('id', 'asc')->pluck('words', 'id');
      break;

      case '2':
        $wordObj = Contextual::where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->pluck('word', 'id');
      break;

      default:
        $wordObj = Word::where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->pluck('word', 'id');
        break;
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
    switch ($trainee['session_type']) {
      case '4':
        $wordObj = Task::select('id', $this->wordsAs, 'task as question', 'categorical_cue')->where('booster_id', $trainee['booster_id'])->where('id', $wordID)->where('booster_range', $trainee['booster_range'])->first();
      break;

      case '3':
        $type = strtolower($this->booster[$trainee['booster_id']]);
        $wordObj = General::select('id', $this->wordsAs, 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->where('type', "$type")->first();
      break;

      case '2':
        $wordObj = Contextual::select('id', 'word', 'words', 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();
      break;

      default:
        $wordObj = Word::select('id', 'word', 'words', 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();
      break;
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
    switch ($traineeObj['session_type']) {
      case '4':
        $wordObj = Task::select('id', $this->wordsAs)->where('booster_id', $traineeObj->booster_id)->where('booster_range', $traineeObj->booster_range)->get();
        break;
      
      case '3':
        $type = strtolower($this->booster[$traineeObj['booster_id']]);
        $wordObj = General::select('id', $this->wordsAs)->where('story_id', $traineeObj['session_number'])->where('type', "$type")->orderBy('id', 'asc')->get();
      break;

      case '2':
        $wordObj = Contextual::select('id', 'word')->where('story_id', $traineeObj['session_number'])->orderBy('id', 'asc')->get();
      break;

      default:
        $wordObj = Word::select('id', 'word')->where('story_id', $traineeObj['session_number'])->orderBy('id', 'asc')->get();
      break;
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
        if ($story_id > 8 && $story_id < 17) {
          $wordObj = Contextual::select($this->wordsAs)->where('id', $transactionDetail->word_id)->firstOrFail('word');
        } else if ($story_id = 17 || $story_id = 18) {
          $wordObj = General::select($this->wordsAs)->where('id', $transactionDetail->word_id)->firstOrFail('word');
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
      
      /*return array( "query" => $queryObj,
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "items" => $items,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr);*/
      
        // Fetch records
      /*$queryObj = with(clone $totalRecordswithFilters)->skip($start)->take($rowperpage);

      $items = $queryObj->where('booster_id',$boosterID)->get();
      $data_arr =  array();

      foreach ($items as $records) {
        $records->id;
        $records->task;
        $records->categorical_cue;
        
        $edit = route($editRoute, $records->id);
        $delete = route($deleteRoute, $records->id);
        
        $action = "<a href='$edit' class='btn btn-primary' role='button' title='Edit'><i class='fas fa-edit' title='Edit'></i> Edit</a>&nbsp;";
        $action .="<form action='$delete' method='post' class='d-inline' id='jsSubmitForm-$records->id'>
                  <input type='hidden' name='_token' value='$csrf'>
                  <input type='hidden' name='_method' value='delete'>
                  <button class='btn btn-danger jsConfirmButton' type='button' data-value='$records->id' title='Delete'><i class='fa fa-trash' title='Delete'></i> Delete</button>
                </form>";
                
        $data_arr[] = array(
          "item" => $records->task,
          "categorical_cue" => $records->categorical_cue,
          "action" => $action
          );
        }
        
        $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr                                 
        );*/
         
  }
}
