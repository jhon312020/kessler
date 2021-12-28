<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Type;
use Auth;

class ShoppingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $shoppingPage = '/shopping'; 
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
      $shopping = Task::where('booster_id','2')->get();
      $types = Type::pluck('type', 'id');
      return view('kessler.shopping.index', compact('shopping', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $types = Task::all();
      return view('kessler.shopping.create', array('types'=>$types, 'boosterRange'=>$this->boosterRange));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
          'item'=>'required'
        ]);
        $booster_id = 2;
        $booster_range = 3;
        $shoppings = new Task([
          'booster_id' => $booster_id,
          'booster_range' => $booster_range,
          'task' => $request->get('item'),
          'categorical_cue' => $request->get('categorical_cue')
        ]);
        $shoppings->save();
        return redirect($this->shoppingPage)->with('success', 'Shopping Item SAVED!');
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
      $shopping = Task::find($id);
      $types = Type::all();
      return view('kessler.shopping.edit', compact('shopping', 'types'));
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
        'item'=>'required'
      ]);
      $shopping = Task::find($id);
      $shopping->task = $request->get('item');
      $shopping->categorical_cue = $request->get('categorical_cue');
      $shopping->save();
      return redirect($this->shoppingPage)->with('success', 'Shopping Item UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $shopping = Task::find($id);
      $shopping->delete();
      return redirect($this->shoppingPage)->with('success', 'Shopping Item DELETED!');
    }

    public function getItem(Request $request){
      
      /*$draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length");
      
      $search_arr = $request->get('search');
      $searchValue = $search_arr['value'];
      $csrf = csrf_token();
      $totalRecords = Task::select('*')->Where('booster_id','2')->count();
      
      $totalRecordswithFilters = Task::select('*')->where('booster_id','2')->when($searchValue, function($search ,$searchValue){
        $search->Where('task', 'like', '%' .$searchValue . '%')->orWhere('words', 'like', '%' .$searchValue . '%');
         });

      $totalRecordswithFilter = with(clone $totalRecordswithFilters)->count();
  
        // Fetch records
      $queryObj = with(clone $totalRecordswithFilters)->skip($start)->take($rowperpage);

      $items = $queryObj->where('booster_id','2')->get();
      $data_arr =  array();

      foreach ($items as $records) {
        $records->id;
        $records->task;
        $records->categorical_cue;
        
        $edit = route('shopping.edit', $records->id);
        $delete = route('shopping.destroy', $records->id);
        
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
        );
        
        echo json_encode($response);
        exit;*/
      $draw = $request->get('draw');
      $csrf = csrf_token();

      $result = $this->rowsOfTable($request,2);
      extract($result);
      //print_r($result);
      
      $items = $queryObj;

      /*print_r($items);
      exit();*/
      $data_arr = array();
      /*print_r($items);
      exit();*/
      foreach ($items as $records) {
        $records->id;
        $records->task;
        $records->categorical_cue;
        
        $edit = route('shopping.edit', $records->id);
        $delete = route('shopping.destroy', $records->id);
        
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
        );

        echo json_encode($response);
        exit;  

    }
}
