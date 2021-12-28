<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Type;
use Auth;

class StoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * @return \Illuminate\Http\Response
     */
    var $totalSessions = array();
    private $pageStory = '/story';
    public function __construct() {
      $this->totalSessions = range(1, 18);
      $this->middleware('auth');
      parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $story = Story::all();
      return view('kessler.story.index', compact('story'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $types = Type::all();
      return view('kessler.story.create', array('totalSessions'=>$this->totalSessions,'types'=>$types));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $request->validate([
        'session_type' => 'required',
        'session_number' => 'required',
        'story' => 'required'
      ]);
      
      $story = new Story([
        'session_type' => $request->get('session_type'),
        'session_number' => $request->get('session_number'),
        'story' => $request->get('story')
      ]);
      $story->save();
      return redirect($this->pageStory)->with('success', 'STORY SAVED!');
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
      $story = Story::find($id);
      $types = Type::all();
      return view('kessler.story.edit', array('story'=>$story, 'types'=>$types, 'totalSessions'=>$this->totalSessions));
        
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
        'story'=>'required'
      ]);
      $story = Story::find($id);
      $story->story = $request->get('story');
      $story->save();
      return redirect($this->pageStory)->with('success', 'STORY UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $story = Story::find($id);
      $story->delete();
      return redirect($this->pageStory)->with('success', 'STORY DELETED!');
    }

    public function getStory(Request $request){
      
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length");
      
      $search_arr = $request->get('search');
      $searchValue = $search_arr['value'];
      $csrf = csrf_token();
      $totalRecords = Story::select('*')->count();
      
      
      $totalRecordswithFilters = Story::select('*')->Where('id', 'like', '%' .$searchValue . '%')->orWhere('story', 'like', '%' .$searchValue . '%');

      $totalRecordswithFilter = with(clone $totalRecordswithFilters)->count();
  
        // Fetch records
      $queryObj = with(clone $totalRecordswithFilters)->skip($start)->take($rowperpage);
      
      $stories = $queryObj->get();
      
      $data_arr =  array();

      foreach ($stories as $records) {
        $records->id;
        $records->story;

        
        $edit = route('story.edit', $records->id);
        $delete = route('story.destroy', $records->id);
        
        $action = "<a href='$edit' class='btn btn-primary' role='button' title='Edit'><i class='fas fa-edit' title='Edit'></i> Edit</a>&nbsp;";
        $action .="<form action='$delete' method='post' class='d-inline' id='jsStatusForm-$records->id'>
                  <input type='hidden' name='_token' value='$csrf'>
                  <input type='hidden' name='_method' value='delete'>
                  <button class='btn btn-danger jsConfirmButton' type='button' data-value='$records->id' title='Delete'><i class='fa fa-trash' title='Delete'></i> Delete</button>
                </form>";
                
        $data_arr[] = array(
          "id" => $records->id, 
          "story" => $records->story,
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