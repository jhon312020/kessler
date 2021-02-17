<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;

class ToDoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * @return \Illuminate\Http\Response
     */
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
      $todo = ToDo::all();
      return view('kessler.todo.index', compact('todo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $totalSessions = $this->totalSessions;
      return view('kessler.todo.create', compact('totalSessions'));
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
          'todo'=>'required',
          'categorical_cue'=>'required'
        ]);
        
        $todos = new ToDo([
          'story_id' => $request->get('story_id'),
          'todo' => $request->get('todo'),
          'categorical_cue' => $request->get('categorical_cue')
        ]);
        $todos->save();
        return redirect('/todo')->with('success', 'todo SAVED!');
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
      $todo = ToDo::find($id);
      $totalSessions = $this->totalSessions;
      return view('kessler.todo.edit', compact('todo', 'totalSessions'));
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
        'todo'=>'required',
        'categorical_cue'=>'required'
      ]);
      $todo = ToDo::find($id);
      $todo->story_id = $request->get('story_id');
      $todo->todo = $request->get('todo');
      $todo->categorical_cue = $request->get('categorical_cue');
      $todo->save();
      return redirect('/todo')->with('success', 'todo UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $todo = ToDo::find($id);
      $todo->delete();
      return redirect('/todo')->with('success', 'todo DELETED!');
    }
}
