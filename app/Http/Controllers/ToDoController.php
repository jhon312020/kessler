<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDo;
use App\Models\Type;

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
      $types = Type::all();
      $totalSessions = $this->totalSessions;
      return view('kessler.todo.create', compact('totalSessions','types'));
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
          'todo'=>'required',
          'categorical_cue'=>'required'
        ]);
        
        $todos = new ToDo([
          'session_type' => $request->get('session_type'),
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
      $types = Type::all();
      $totalSessions = $this->totalSessions;
      return view('kessler.todo.edit', compact('todo', 'totalSessions','types'));
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
        'session_type' => 'required',
        'todo'=>'required',
        'categorical_cue'=>'required'
      ]);
      $todo = ToDo::find($id);
      $todo->session_type = $request->get('session_type');
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
