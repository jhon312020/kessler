<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Direction;
use App\Models\Task;
use App\Models\Type;

class DirectionController extends Controller
{
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
      $boosterRange = $this->boosterRange;
      return view('kessler.direction.create', compact('types', 'boosterRange'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
          'booster_range'=>'required',
          'direction'=>'required',
          'categorical_cue'=>'required'
        ]);
        $booster_id = 1;
        $directions = new Task([
          'booster_id' => $booster_id,
          'booster_range' => $request->get('booster_range'),
          'task' => $request->get('direction'),
          'categorical_cue' => $request->get('categorical_cue')
        ]);
        $directions->save();
        return redirect('/direction')->with('success', 'Direction SAVED!');
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
        'direction'=>'required',
        'categorical_cue'=>'required'
      ]);
      $direction = Task::find($id);
      $direction->task = $request->get('direction');
      $direction->categorical_cue = $request->get('categorical_cue');
      $direction->save();
      return redirect('/direction')->with('success', 'Direction UPDATED!');
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
      return redirect('/direction')->with('success', 'Direction DELETED!');
    }
}
