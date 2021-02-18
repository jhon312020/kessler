<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direction;
use App\Models\Type;

class DirectionController extends Controller
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
      $direction = Direction::all();
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
      $totalSessions = $this->totalSessions;
      return view('kessler.direction.create', compact('totalSessions','types'));
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
          'direction'=>'required',
          'categorical_cue'=>'required'
        ]);
        
        $directions = new Direction([
          'session_type' => $request->get('session_type'),
          'direction' => $request->get('direction'),
          'categorical_cue' => $request->get('categorical_cue')
        ]);
        $directions->save();
        return redirect('/direction')->with('success', 'direction SAVED!');
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
      $direction = Direction::find($id);
      $types = Type::all();
      $totalSessions = $this->totalSessions;
      return view('kessler.direction.edit', compact('direction', 'totalSessions','types'));
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
        'direction'=>'required',
        'categorical_cue'=>'required'
      ]);
      $direction = Direction::find($id);
      $direction->session_type = $request->get('session_type');
      $direction->direction = $request->get('direction');
      $direction->categorical_cue = $request->get('categorical_cue');
      $direction->save();
      return redirect('/direction')->with('success', 'direction UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $direction = Direction::find($id);
      $direction->delete();
      return redirect('/direction')->with('success', 'direction DELETED!');
    }
}
