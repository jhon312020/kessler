<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Type;
use Auth;

class DirectionController extends Controller
{
    public $dir = '/direction';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    var $boosterRange = array();
    public function __construct() {
      $this->middleware('auth');
      $this->boosterRange = range(1, 3);
      parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $direction = Task::where('booster_id','1')->get();
      $types = Type::all();
      return view('kessler.direction.index', compact('direction','types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $types = Type::all();
      return view('kessler.direction.create', array('types'=>$types, 'boosterRange'=>$this->boosterRange));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
          'direction'=>'required'
        ]);
        $booster_id = 1;
        $booster_range = 3;
        $directions = new Task([
          'booster_id' => $booster_id,
          'booster_range' => $booster_range,
          'task' => $request->get('direction'),
          'categorical_cue' => $request->get('categorical_cue')
        ]);
        $directions->save();
        return redirect($this->dir)->with('success', 'Direction SAVED!');
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
      $direction = Task::find($id);
      $types = Type::all();
      return view('kessler.direction.edit', compact('direction','types'));
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
        'direction'=>'required'
      ]);
      $direction = Task::find($id);
      $direction->task = $request->get('direction');
      $direction->categorical_cue = $request->get('categorical_cue');
      $direction->save();
      return redirect($this->dir)->with('success', 'Direction UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $direction = Task::find($id);
      $direction->delete();
      return redirect($this->dir)->with('success', 'Direction DELETED!');
    }

    public function getDirection(Request $request){
      
      $draw = $request->get('draw');
      $csrf = csrf_token();

      $result = $this->rowsOfTable($request,1);
      extract($result);
      
      $directions = $queryObj;
      
      $data_arr = array();

      foreach ($directions as $records) {
        $records->id;
        $records->task;
        $records->categorical_cue;
        
        $edit = route('direction.edit', $records->id);
        $delete = route('direction.destroy', $records->id);
        
        $action = "<a href='$edit' class='btn btn-primary' role='button' title='Edit'><i class='fas fa-edit' title='Edit'></i> Edit</a>&nbsp;";
        $action .="<form action='$delete' method='post' class='d-inline' id='jsSubmitForm-$records->id'>
                  <input type='hidden' name='_token' value='$csrf'>
                  <input type='hidden' name='_method' value='delete'>
                  <button class='btn btn-danger jsConfirmButton' type='button' data-value='$records->id' title='Delete'><i class='fa fa-trash' title='Delete'></i> Delete</button>
                </form>";
                
        $data_arr[] = array(
          "direction" => $records->task,
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
