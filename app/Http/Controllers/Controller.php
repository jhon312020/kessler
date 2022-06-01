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
use App\Models\Category;
use App\Models\ControlWord;
use DB;
use Auth;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  private $boosterSession = 'booster';
  private $wordsAs = 'words as word';
  private $booster = array();
  public $directionBoosterID;
  private $selectTable = array();
  public $configValue = '';
  public $commonConfigValue = '';
  public $adminRoles = '';
  public function __construct() {
    $this->configValue =  \Config::get('constants.GA');
    $this->commonConfigValue =  \Config::get('constants.COMMON');
    $this->adminRoles = $this->commonConfigValue['ADMIN_ROLES'];
    $sideMenu = array('dashboard'=>array('name'=>'Dashboard', 'url'=>'/dashboard','icon'=>'fa-tachometer-alt', 'role'=>''),
                  'trainee'=>array('name'=>'Trainee Information', 'url'=>'/trainee','icon'=>'fa-table', 'role'=>''), 
                'trainer'=>array('name'=>'Trainer', 'url'=>'/trainer','icon'=>'fa-table', 'role'=>$this->adminRoles), 
                'overview'=>array('name'=>'Overview', 'url'=>'/overview','icon'=>'fa-table', 'role'=>$this->adminRoles),
                'instruction'=>array('name'=>'Instruction', 'url'=>'/instruction','icon'=>'fa-table', 'role'=>$this->adminRoles),
                'story'=>array('name'=>'Story', 'url'=>'/story','icon'=>'fa-table', 'role'=>$this->adminRoles),
                'word'=>array('name'=>'Word', 'url'=>'/word','icon'=>'fa-table', 'role'=>$this->adminRoles),
                'type'=>array('name'=>'Session Type', 'url'=>'/type','icon'=>'fa-table', 'role'=>$this->adminRoles),
                'booster'=>array('name'=>'Booster Category', 'url'=>'/booster','icon'=>'fa-table', 'role'=>$this->adminRoles),
               
                'Booster Section'=>array('name'=>'Booster Session', 'url'=>'#', 'icon'=>'fa-columns', 'role'=>$this->adminRoles, 'subitems'=>array('direction'=>array('name'=>'Direction', 'url'=>'/direction', 'icon'=>'fa-table', 'role'=>$this->adminRoles), 'shopping'=>array('name'=>'Shopping', 'url'=>'/shopping','icon'=>'fa-table','role'=>$this->adminRoles), 'to-do'=>array('name'=>'To-Do', 'url'=>'/todo','icon'=>'fa-table', 'role'=>$this->adminRoles)))
              );
    //$this->getRoleBasedConfig();
    
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
    $conditions = ['story_id'=>$trainee['session_number']];
    $selectFields = ['word'];
    //$name = 'Task';
    /*foreach ($names as $name) {*/
      //$this->selectTable = DB::table($names)->select('word')->where('story_id', $trainee['session_number'])->get('word');
    //$getWords = ->where('story_id', $trainee['session_number'])->get('word'); 
    //dd($res) DB::table($names[0]);
      //dd($name);
    switch ($trainee['session_type']) {
      case 5:
        $modelObj = new ControlWord();
        $selectFields = ['answers as word','questions'];
      break;
      case 4:
        $modelObj = new Task();
        $selectFields = ['task as word', 'question', 'words'];
        //$wordObj = Task::select()->get();
        $conditions = ['booster_id'=>$trainee['booster_id'], 'booster_range'=>$trainee['booster_range']];
      break;
      case 3:
        $modelObj = new General();
        $type = strtolower($this->booster[$trainee['booster_id']]);
        $conditions['type'] = $type;
        $selectFields = ['word', 'contextual_cue', 'question', 'words'];
        //$selectFields = "'".implode("','", $selectFields)."'";
        //$wordObj = $name::select()->get('word');
      break;
      case 2:
        $modelObj = new Contextual();
      break;
      default:
        $modelObj = new Word();
      break;
    }
    // $this->pr($modelObj);
    // $this->pr($conditions);
    // echo $selectFields;
    $wordObj = $modelObj::where($conditions)->get($selectFields);
    // $this->pr($wordObj->toArray()); 
    // exit;
    //
  /*} */
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
    $conditions = ['story_id'=>$trainee['session_number']];
    $selectField1 = 'word' ;
    $selectField2 = 'id';

    switch ($trainee['session_type']) {
      case 5:
        $modelObj = new ControlWord();
        $selectField1 = 'answers as word';
        $selectField2 = 'id';
      break;
      case 4:
        $modelObj = new Task();
        $conditions = ['booster_id'=> $trainee['booster_id'],'booster_range'=> $trainee['booster_range']];
        $selectField1 = $this->wordsAs;
        $selectField2 = 'id';
       //$wordObj = Task::where('booster_id', $trainee['booster_id'])->where('booster_range', $trainee['booster_range'])->pluck($this->wordsAs, 'id');
      break;
      
      case 3:
        $modelObj = new General();
        $type = strtolower($this->booster[$trainee['booster_id']]);
        $conditions['type'] =  $type;
        $selectField1 = 'words';
        $selectField2 = 'id';
        //$type = strtolower($this->booster[$trainee['booster_id']]);
        //$wordObj = General::where('story_id', $trainee['session_number'])->where('type', "$type")->orderBy('id', 'asc')->pluck('words', 'id');
        //dd($wordObj);
      break;

      case 2:
        $modelObj = new Contextual();
        
        //$wordObj = Contextual::where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->pluck('word', 'id');
        //dd($wordObj);
      break;

      default:
        $modelObj = new Word();
        //$wordObj = Word::where('story_id', $trainee['session_number'])->orderBy('id', 'asc')->pluck('word', 'id');
      break;
    }
    //$this->pr($modelObj);
    //$this->pr($conditions);
    //dd($selectFields);
    //echo $selectFields;
    $wordObj = $modelObj::where($conditions)->orderBy('id', 'asc')->pluck($selectField1,$selectField2);
    //dd($wordObj);
    //$this->pr($wordObj->toArray()); 
    //exit;
    
    
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
    $conditions = ['story_id' => $trainee['session_number'], 'id' => $wordID];
    $selectFields = ['id', 'word', 'words', 'question', 'categorical_cue'];

    switch ($trainee['session_type']) {
      case 5: 
        $modelObj = new ControlWord();
        $selectFields = ['id','answers as word','questions'];
      break;
      case 4:
        $modelObj = new Task();
        $selectFields = ['id', $this->wordsAs, 'task as question', 'categorical_cue'];
        $conditions = ['booster_id' => $trainee['booster_id'], 'booster_range' => $trainee['booster_range'], 'id' => $wordID];

        /*$wordObj = Task::select('id', $this->wordsAs, 'task as question', 'categorical_cue')->where('booster_id', $trainee['booster_id'])->where('id', $wordID)->where('booster_range', $trainee['booster_range'])->first();*/
      break;

      case 3:
        $modelObj = new General();
        $selectFields = ['id', $this->wordsAs, 'question', 'categorical_cue'];
        $type = strtolower($this->booster[$trainee['booster_id']]);
        $conditions['type'] = $type; 
        //$type = strtolower($this->booster[$trainee['booster_id']]);
        /*$wordObj = General::select('id', $this->wordsAs, 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->where('type', "$type")->first();*/
      break;

      case 2:
        $modelObj = new Contextual();
        /*$wordObj = Contextual::select('id', 'word', 'words', 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();*/
      break;

      default:
        $modelObj = new Word();
        /*$wordObj = Word::select('id', 'word', 'words', 'question', 'categorical_cue')->where('id', $wordID)->where('story_id', $trainee['session_number'])->first();*/
      break;
    }
    //dd($wordObj);
    $wordObj = $modelObj::select($selectFields)->where($conditions)->first();
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
    $selectFields = ['id','word'];
    $conditions = ['story_id' => $traineeObj['session_number']];
    
    switch ($traineeObj['session_type']) {

      case 5: 
        $modelObj = new ControlWord();
        $selectFields = ['id','answers as word'];
      break;
        //$conditions = ['story_id' => $traineeObj['session_number']];
        //$wordObj = ControlWord::select('id', 'answers')->where('story_id', $traineeObj['session_number'])->orderBy('id', 'asc')->get();
        
      case 4:
        $modelObj = new Task();
        $selectFields = ['id', $this->wordsAs];
        $conditions = ['booster_id' => $traineeObj->booster_id , 'booster_range'=> $traineeObj->booster_range];
        //$wordObj = Task::select('id', $this->wordsAs)->where('booster_id', $traineeObj->booster_id)->where('booster_range', $traineeObj->booster_range)->get();
      break;
      
      case 3:
        $modelObj = new General();
        $selectFields = ['id', $this->wordsAs];
        $type = strtolower($this->booster[$traineeObj['booster_id']]);
        $conditions['type'] = $type;
        //$wordObj = General::select('id', $this->wordsAs)->where('story_id', $traineeObj['session_number'])->where('type', "$type")->orderBy('id', 'asc')->get();
      break;

      case 2:
        $modelObj = new Contextual();
        //$wordObj = Contextual::select('id', 'word')->where('story_id', $traineeObj['session_number'])->orderBy('id', 'asc')->get();
      break;

      default:
        $modelObj = new Word();
        //$wordObj = Word::select('id', 'word')->where('story_id', $traineeObj['session_number'])->orderBy('id', 'asc')->get();
      break;
    }
    $wordObj = $modelObj::where($conditions)->orderBy('id', 'asc')->get($selectFields);

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
    $conditions = ['id' => $transactionDetail->word_id];
    $selectFields = 'word';

    try {
      switch ($transactionDetail['category_id']) {
        case 5:
          $modelObj = new ControlWord();
          $selectFields = 'answers as word';
        break;
        case 4:
          $modelObj = new Task();
          $selectFields = $this->wordsAs;

          //$wordObj = Task::select($this->wordsAs)->where('id',$transactionDetail->word_id)->firstOrFail();
        break;
        
        case 3:
          $modelObj = new General();
          $selectFields = $this->wordsAs;
          //$wordObj = General::select($this->wordsAs)->where('id', $transactionDetail->word_id)->firstOrFail();
        break;

        case 2:
          $modelObj = new Contextual();
          //$wordObj = Contextual::select('word')->where('id', $transactionDetail->word_id)->firstOrFail();
        break;

        default:
          $modelObj = new Word();
          //$wordObj = Word::select('word')->where('id', $transactionDetail->word_id)->firstOrFail();
        break;
      }
    } catch(\Exception $e) {
      Log::error($e);
    }
    //dd($modelObj);
    $wordObj = $modelObj::where($conditions)->firstOrFail($selectFields);
    //$this->pr($wordObj);
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

  function getRoleBasedConfig() {
    $user = Auth::user();
    $this->pr($user);
    exit;
    if ($user->role === "SA") {
      $this->configValue =  \Config::get('constants.SA');
    } else {
      $this->configValue =  \Config::get('constants.GA');
    }
  }
}
