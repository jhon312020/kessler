<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\Type;

class StoryController extends Controller
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
      $story = Story::all();
      return view('kessler.story.index', compact('story'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $types = Type::all();
      $totalSessions = $this->totalSessions;
      return view('kessler.story.create', compact('totalSessions','types'));
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
        'session_number' => 'required',
        'story' => 'required'
      ]);
      
      $story = new Story([
        'session_type' => $request->get('session_type'),
        'session_number' => $request->get('session_number'),
        'story' => $request->get('story')
      ]);
      $story->save();
      return redirect('/story')->with('success', 'STORY SAVED!');
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
      $story = Story::find($id);
      $types = Type::all();
      $totalSessions = $this->totalSessions;
      return view('kessler.story.edit', compact('story', 'totalSessions','types'));
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
       // 'session_type' => 'required',
       // 'session_number' => 'required',
        'story'=>'required'
      ]);
      $story = Story::find($id);
     // $story->session_type = $request->get('session_type');
     // $story->session_number = $request->get('session_number');
      $story->story = $request->get('story');
      $story->save();
      return redirect('/story')->with('success', 'STORY UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $story = Story::find($id);
      $story->delete();
      return redirect('/story')->with('success', 'STORY DELETED!');
    }
}