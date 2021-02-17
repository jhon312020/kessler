<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direction;

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
      return view('kessler.direction.index', compact('direction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $totalSessions = $this->totalSessions;
      return view('kessler.direction.create', compact('totalSessions'));
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
          'direction'=>'required',
          'categorical_cue'=>'required'
        ]);
        
        $directions = new Direction([
          'story_id' => $request->get('story_id'),
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
      $totalSessions = $this->totalSessions;
      return view('kessler.direction.edit', compact('direction', 'totalSessions'));
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
        'direction'=>'required',
        'categorical_cue'=>'required'
      ]);
      $direction = Direction::find($id);
      $direction->story_id = $request->get('story_id');
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
