<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invite;
use App\Models\User;
use App\Models\Category;
use App\Models\Booster;
use Auth;
use DB;

use Illuminate\Validation\Rule;
 



class TrainerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $pageTrainer = '/trainer';
    var $storySession = array();
    protected $userInfo;
    public function __construct() {
      $this->middleware('auth');
      parent::__construct();
      //$this->selectSessions = (object)array('story'=>'', 'contextual'=>'', 'general'=>'', 'booster'=>'');
      $this->storySession = $this->configValue['STORY'];
      $this->writeSession = $this->configValue['WRITE'];
      $this->generalSession = $this->configValue['GENERAL'];
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
      $categories = Category::all();
      $storySession = $this->storySession;
      $writeSession = $this->writeSession;
      $generalSession = $this->generalSession;
      $boosterSession = Booster::all();
      $user = Auth::user();
      if ($user->role === "SA") {
        $viewName= 'kessler.trainer.sacreate';
      } else {
        $viewName= 'kessler.trainer.create';
      }
      return view($viewName, compact('categories','storySession','writeSession','generalSession','boosterSession'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      //echo '<pre>'; print_r($request->all()); echo '</pre>'; //exit;
        $user = Auth::user();
        $session = [];
        $required = array (
          'name'=>'required',
          'email'=>'required|unique:users',
        );
        $errorMessages = array (
          'name.required'=>'Please enter the name',
          'email.required'=>'Please enter the email',
          'email.unique'=>'The email ID already exists',
        );
        if ($user->role === "SA") {
          $this->configValue =  \Config::get('constants.SA');
          $saRequired = array (
            'story'  => 'required_if:1.*,in:category|min:1',
            'contextual'  => 'required_if:2.*,in:category|min:1',
            'general'  => 'required_if:3.*,in:category|min:1',
            'booster'  => 'required_if:4.*,in:category|min:1'
          );
          $saErrorMessages = array (
            'category.required'=>'Please select the category',
            'story.required'=>'Please select the story session',
            'contextual.required'=>'Please select the contextual session',
            'general.required'=>'Please select the general session',
            'booster.required'=>'Please select the booster session'
          );
          $required = array_merge($required, $saRequired);
          $errorMessages = array_merge($errorMessages, $saErrorMessages);
          $category = $request->get('category');
        
          $session[] = [
            'stories' => $request->get('story'),
            'contextual' => $request->get('contextual'),
            'general' => $request->get('general'),
            'booster' => $request->get('booster'),
          ];
        } else {
          $category = $request->get('category');
        
          $session[] = array (
            'stories' => $request->get('story'),
            'contextual' => $request->get('contextual'),
            'general' => $request->get('general'),
            'booster' => $request->get('booster')
          );
        }
        $request->validate($required, $errorMessages);
        /*$request->validate([
          'name'=>'required',
          'email'=>'required|unique:users',
          'category' => 'required|array|min:1',
          

          'story'  => 'required_if:1.*,in:category|min:1',
          'contextual'  => 'required_if:2.*,in:category|min:1',
          'general'  => 'required_if:3.*,in:category|min:1',
          'booster'  => 'required_if:4.*,in:category|min:1',
          /*'story' => 'array',
          'story.0'=>Rule::requiredIf(function() use ($request) {
                      return in_array(1, $request->category);
                    }),
          'contextual' => 'array',
          'contextual.0'=>Rule::requiredIf(function() use ($request) {
                      return in_array(2, $request->category);
                    }),
          'general' => 'array',
          'general.0'=>Rule::requiredIf(function() use ($request) {
                      return in_array(3, $request->category);
                    }),
          'booster' => 'array',
          'booster.0'=>Rule::requiredIf(function() use ($request) {
                      return in_array(4, $request->category);
                    }),
        ],
        [
          'name.required'=>'Please enter the name',
          'email.required'=>'Please enter the email',
          'email.unique'=>'The email ID already exists',
          'category.required'=>'Please select the category',
          'story.required'=>'Please select the story session',
          'contextual.required'=>'Please select the contextual session',
          'general.required'=>'Please select the general session',
          'booster.required'=>'Please select the booster session', 
        ]);*/
        //dd($request->input());
        //exit;
        $password = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstvwxyz"), 0, 8);
        
        

        $trainer = new User([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => Hash::make($password),
          'category' => json_encode($category),
          'sessions' => json_encode($session),

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
      $boosters = Booster::all();
      $categoryList = json_decode($trainer->category);
      $categories = Category::wherein('id', $categoryList)->pluck('name','id');
      $collect = json_decode($trainer->sessions,true);
      $story = collect($collect)->pluck('stories');
      $contextual = collect($collect)->pluck('contextual');
      $general = collect($collect)->pluck('general');
      $boosterNo = collect($collect)->pluck('booster')->toArray();
      //print_r($boosterNo);
      //dd($boosterNo);
      //exit();
      
      $boosterSes = [];
      if (!is_null($boosterNo[0]) && count($boosterNo[0]) > 0) {
        $boosterSes = Booster::whereIn('id',$boosterNo[0])->pluck('category','id')->toArray();
      }else{
        $boosterSes = [];
      }
      //$this->pr($boosterSes);
      //exit();
      
      return view('kessler.trainer.edit', compact('trainer','categories','story','contextual','general','boosterSes','boosters'));
    
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
        'name'=>'required',
        'email'=>'required',
        'category' => 'required|array|min:1',
        'story'  => 'required_if:1.*,in:category|min:1',
        'contextual'  => 'required_if:2.*,in:category|min:1',
        'general'  => 'required_if:3.*,in:category|min:1',
        'booster'  => 'required_if:4.*,in:category|min:1',
        //'category.0' =>'required|array',
       /* 'story' => 'array',
        'story.0'=>Rule::requiredIf(function() use ($request) {
                      return in_array(1, $request->category);
                    }),
        'contextual' => 'array',
        'contextual.0'=>Rule::requiredIf(function() use ($request) {
                      return in_array(2, $request->category);
                    }),
        'general' => 'array',
        'general.0'=>Rule::requiredIf(function() use ($request) {
                      return in_array(3, $request->category);
                    }),
        'booster' => 'array',
        'booster.0'=>Rule::requiredIf(function() use ($request) {
                      return in_array(4, $request->category);
                    }),*/
      ],
      [
          'name.required'=>'Please enter the name',
          'email.required'=>'Please enter the email',
          'category.required'=>'Please select the category',
          'story.required'=>'Please select the story session',
          'contextual.required'=>'Please select the contextual session',
          'general.required'=>'Please select the general session',
          'booster.required'=>'Please select the booster session',
      ]);
      //dd($request->input());
      $session = [];
      $trainer = User::find($id);
      $trainer->name = $request->get('name');
      $trainer->email = $request->get('email');
      $category = $request->get('category');
      $trainer->category = json_encode($category);
      $session[] = [
          'stories' => $request->get('story'),
          'contextual' => $request->get('contextual'),
          'general' => $request->get('general'),
          'booster' => $request->get('booster'),
        ];
      $trainer->sessions = json_encode($session);  
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
      
    }

    public function getTrainers(Request $request){
      $user = Auth::user();
      $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length");
      
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
      
      $data_arr =  array();

      foreach ($trainers as $records) {
        $records->name;
        $records->email;
        $activeOrInactiveUrl = url('trainer/status', $records->id).'?start='.$start;
        $edit = route('trainer.edit', $records->id);
        
        $checked = $records->status ? 'checked':'';
        /*$action = "<a onclick='openEditModal(this)' id = 'jsEditForm' data-id='$records->id' class='btn btn-primary' role='button' title='Edit'><i class='fas fa-edit' title='Edit'></i> Edit</a>&nbsp;";*/
        $action = "<a href='$edit' class='btn btn-primary' role='button' title='Edit'><i class='fas fa-edit' title='Edit'> </i> Edit </a>&nbsp;"; 
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
