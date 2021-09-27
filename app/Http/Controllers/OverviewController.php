<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overview;
use Auth;

class OverviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
      $this->middleware('auth');
      parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $overview = Overview::all();
      return view('kessler.overview.index', compact('overview'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('kessler.overview.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $request->validate([
        'overview'=>'required'
      ]);
      
      $overview = new Overview([
        'overview' => $request->get('overview')
      ]);
      $overview->save();
      return redirect('/overview')->with('success', 'OVERVIEW SAVED!');
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
      $overview = Overview::find($id);
      return view('kessler.overview.edit', compact('overview'));
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
        'overview'=>'required'
      ]);
      $overview = Overview::find($id);
      $overview->overview = $request->get('overview');
      $overview->save();
      return redirect('/overview')->with('success', 'OVERVIEW UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $overview = Overview::find($id);
      $overview->delete();
      return redirect('/overview')->with('success', 'OVERVIEW DELETED!');
    }

    public function getOverview(Request $request){
      $user = Auth::user();
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length");
      $columnName_arr = $request->get('columns');
      $search_arr = $request->get('search');
      $searchValue = $search_arr['value'];
      $csrf = csrf_token();
      $totalRecords = Overview::select('*')->count();
      /*$this->pr($totalRecords);
      die();*/
      
      $totalRecordswithFilters = Overview::select('*')->Where('overview', 'like', '%' .$searchValue . '%');

      $totalRecordswithFilter = with(clone $totalRecordswithFilters)->count();
  
        // Fetch records
      $queryObj = with(clone $totalRecordswithFilters)->skip($start)->take($rowperpage);

      $overviews = $queryObj->get();
      /*$this->pr($trainers->toArray());
      die();*/
      $data_arr =  array();

      foreach ($overviews as $records) {
        $records->overview;
        
        $edit = route('overview.edit', $records->id);
        $delete = route('overview.destroy', $records->id);
        
        $action = "<a href='$edit' class='btn btn-primary' role='button' title='Edit'><i class='fas fa-edit' title='Edit'></i> Edit</a>&nbsp;";
        $action .="<form action='$delete' method='post' class='d-inline' id='jsStatusForm-$records->id'>
                  <input type='hidden' name='_token' value='$csrf'>
                  <input type='hidden' name='_method' value='delete'>
                  <button class='btn btn-danger jsConfirmButton' type='button' data-value='$records->id' title='Delete'><i class='fa fa-trash' title='Delete'></i> Delete</button>
                </form>";
                
        $data_arr[] = array(
          "overview" => $records->overview,
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