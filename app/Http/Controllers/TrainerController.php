<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invite;
use App\Models\User;
use Auth;
use DB;


class TrainerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $pageTrainer = '/trainer';
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
      $trainers = User::where('role', 'TA')->get();
      return view('kessler.trainer.index', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('kessler.trainer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
          'name'=>'required',
          'email'=>'required'
        ]);
        $password = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstvwxyz"), 0, 8);
        $trainer = new User([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => Hash::make($password)
        ]);
        if ($trainer->save()) {
          $trainer->password = $password;
          Mail::to($trainer->email)->send(new Invite($trainer));
        }
        return redirect($this->pageTrainer)->with('success', 'TRAINER SAVED!');
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
      $trainer = User::find($id);
      return view('kessler.trainer.edit', compact('trainer'));
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
        'name'=>'required'
      ]);
      $trainer = User::find($id);
      $trainer->name = $request->get('name');
      $trainer->save();
      return redirect('/trainer/')->with('success', 'TRAINER UPDATED!');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $trainer = User::find($id);
      $trainer->delete();
      return redirect($this->pageTrainer)->with('success', 'TRAINER DELETED!');
    }

    /**
     * Status set to Active/Inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function status(Request $request, $id) {
      $trainer = User::find($id);
      if ($request->get('status')) {
        $trainer->status = 1;
      } else {
        $trainer->status = 0;
      }
      if($trainer->save()) {
        $message = 'TRAINER STATUS UPDATED';
      } else {
        $message = 'Some server error! Please try after sometimes!';
      }
      return response()->json(['message' => $message]);
      //return redirect('/trainer')->with('success', 'TRAINER STATUS UPDATED!');
    }

    public function getTrainers(Request $request){
      $user = Auth::user();
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length");
      $columnName_arr = $request->get('columns');
      $search_arr = $request->get('search');
      $searchValue = $search_arr['value'];
      $csrf = csrf_token();      
      $totalRecords = User::select('*')->Where('role','TA')->count();
      
      $totalRecordswithFilters = User::select('*')->where('role','TA')  
      ->when($searchValue, function($search ,$searchValue){
        $search->Where('name', 'like', '%' .$searchValue . '%')->orWhere('email', 'like', '%' .$searchValue . '%');
      });

      $totalRecordswithFilter = with(clone $totalRecordswithFilters)->count();
  
        // Fetch records
      $queryObj = with(clone $totalRecordswithFilters)->skip($start)->take($rowperpage);

      if ($user->role = "SA") {
          $queryObj->where('role', 'TA');
          $queryObj = $queryObj->orderBy('name', 'asc');
          $queryObj->toSql();
        } 
      
      $trainers = $queryObj->get();
      /*$this->pr($trainers->toArray());
      die();*/
      $data_arr =  array();

      foreach ($trainers as $records) {
        $records->name;
        $records->email;
        $activeOrInactiveUrl = url('trainer/status', $records->id).'?start='.$start;
        $edit = route('trainer.edit', $records->id).'?start='.$start;
        
        $checked = $records->status ? 'checked':'';
        $action = "<a onclick='openEditModal(this)' id = 'jsEditForm' data-id='$records->id' class='btn btn-primary' role='button' title='Edit'><i class='fas fa-edit' title='Edit'></i> Edit</a>&nbsp;";
        $action .="<form action='$activeOrInactiveUrl' method='post' class='d-inline' id='jsStatusForm-$records->id' >
                  <input type='hidden' name='_token' value='$csrf'>
                  <input type='hidden' name='_method' value='post'>
                  <input data-id='$records->id' name='status' value='$records->status' class='toggle-class jsStatus' type='checkbox' data-onstyle='success' data-offstyle='danger' data-toggle='toggle' data-on='Active' data-off='InActive' $checked>
                </form>";
               
        $data_arr[] = array(
          "name" => "<span class='jsname'> ".$records->name."</span>",
          "email" => $records->email,
          "action" => $action
          );
        }
        $response = array(
          "action" => $action,
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr
        );
        
        echo json_encode($response);
        exit;
    }

    public function editTrainer(Request $request) {
        
      $request->validate([
        'name'=>'required',
        'id'=>'required'
      ]);
      $trainer = User::find($request->id);
      $trainer->name = $request->name;

      if($trainer->save()) {
        $message = 'TRAINER UPDATED!';
      } else {
        $message = 'Some server error! Please try after sometimes!';
      }
      return response()->json(['message' => $message]);
    }
}
