<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use Auth;

class WordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * @return \Illuminate\Http\Response
     */
    private $pageWord = '/word';
    var $totalSessions = array();
    public function __construct() {
      $this->totalSessions = range(1, 10);
      $this->middleware('auth');
      parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $word = Word::all();
      return view('kessler.word.index', compact('word'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      
      return view('kessler.word.create', array('totalSessions'=>$this->totalSessions));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
          'story_id' => 'required',
          'word'=>'required',
          'categorical_cue'=>'required'
        ]);
        
        $words = new Word([
          'story_id' => $request->get('story_id'),
          'word' => $request->get('word'),
          'contextual_cue' => $request->get('contextual_cue'),
          'categorical_cue' => $request->get('categorical_cue')
        ]);
        $words->save();
        return redirect($this->pageWord)->with('success', 'WORD SAVED!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      $word = Word::find($id);
      
      return view('kessler.word.edit', array('word'=>$word, 'totalSessions'=>$this->totalSessions));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
      $request->validate([
        'story_id' => 'required',
        'word'=>'required',
        'categorical_cue'=>'required'
      ]);
      $word = Word::find($id);
      $word->story_id = $request->get('story_id');
      $word->word = $request->get('word');
      $word->contextual_cue = $request->get('contextual_cue');
      $word->categorical_cue = $request->get('categorical_cue');
      $word->save();
      return redirect($this->pageWord)->with('success', 'WORD UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $word = Word::find($id);
      $word->delete();
      return redirect($this->pageWord)->with('success', 'WORD DELETED!');
    }

    public function getStoryWord(Request $request){
      
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length");
      
      $search_arr = $request->get('search');
      $searchValue = $search_arr['value'];
      $csrf = csrf_token();
      $totalRecords = Word::select('*')->count();
      $totalRecordswithFilters = Word::select('*')->Where('id', 'like', '%' .$searchValue . '%')->orWhere('word', 'like', '%' .$searchValue . '%')->orWhere('contextual_cue', 'like', '%' .$searchValue . '%')->orWhere('categorical_cue', 'like', '%' .$searchValue . '%');

      $totalRecordswithFilter = with(clone $totalRecordswithFilters)->count();
  
        // Fetch records
      $queryObj = with(clone $totalRecordswithFilters)->skip($start)->take($rowperpage);

      $words = $queryObj->get();
      $data_arr =  array();

      foreach ($words as $records) {
        $records->id;
        $records->word;
        $records->categorical_cue;
        $records->contextual_cue;
        
        $edit = route('word.edit', $records->id);
        $delete = route('word.destroy', $records->id);
        
        $action = "<a href='$edit' class='btn btn-primary' role='button' title='Edit'><i class='fas fa-edit' title='Edit'></i> Edit</a>&nbsp;";
        $action .="<form action='$delete' method='post' class='d-inline' id='jsSubmitForm-$records->id'>
                  <input type='hidden' name='_token' value='$csrf'>
                  <input type='hidden' name='_method' value='delete'>
                  <button class='btn btn-danger jsConfirmButton' type='button' data-value='$records->id' title='Delete'><i class='fa fa-trash' title='Delete'></i> Delete</button>
                </form>";
                
        $data_arr[] = array(
          "id" => $records->id,
          "word" => $records->word,
          "contextual_cue" => $records->contextual_cue,
          "categorical_cue" => $records->categorical_cue,
          "action" => $action
          );
        }
        $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr
        );
        
        echo json_encode($response);
        exit;
    }
}
