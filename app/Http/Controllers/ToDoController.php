<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\ToDo;
use App\Models\Task;
use App\Models\Type;

class ToDoController extends Controller
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
      $todo = Task::where('booster_id','3')->get();
      return view('kessler.todo.index', compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $types = Task::all();
      $boosterRange = $this->boosterRange;
      return view('kessler.todo.create', compact('types', 'boosterRange'));
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
          'todo'=>'required',
          'categorical_cue'=>'required'
        ]);
        $booster_id = 3;
        $todos = new Task([
          'booster_id' => $booster_id,
          'booster_range' => $request->get('booster_range'),
          'task' => $request->get('todo'),
          'categorical_cue' => $request->get('categorical_cue')
        ]);
        $todos->save();
        return redirect('/todo')->with('success', 'To-Do SAVED!');
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
      $todo = Task::find($id);
      $types = Type::all();
      return view('kessler.todo.edit', compact('todo','types'));
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
        'todo'=>'required',
        'categorical_cue'=>'required'
      ]);
      $todo = Task::find($id);
      $todo->task = $request->get('todo');
      $todo->categorical_cue = $request->get('categorical_cue');
      $todo->save();
      return redirect('/todo')->with('success', 'To-Do UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $todo = Task::find($id);
      $todo->delete();
      return redirect('/todo')->with('success', 'To-Do DELETED!');
    }
}
