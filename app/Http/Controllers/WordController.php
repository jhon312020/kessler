<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Type;

class WordController extends Controller
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
      $word = Word::all();
      return view('kessler.word.index', compact('word'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $types = Type::all();
      $totalSessions = $this->totalSessions;
      return view('kessler.word.create', compact('totalSessions','types'));
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
          'story_id' => 'required',
          'word'=>'required',
          'session_type' => 'required',
          'categorical_cue'=>'required'
        ]);
        
        $words = new Word([
          'session_type' => $request->get('session_type'),
          'story_id' => $request->get('story_id'),
          'word' => $request->get('word'),
          'contextual_cue' => $request->get('contextual_cue'),
          'categorical_cue' => $request->get('categorical_cue')
        ]);
        $words->save();
        return redirect('/word')->with('success', 'WORD SAVED!');
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
      $word = Word::find($id);
      $types = Type::all();
      $totalSessions = $this->totalSessions;
      return view('kessler.word.edit', compact('word', 'totalSessions','types'));
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
        'story_id' => 'required',
        'word'=>'required',
        'categorical_cue'=>'required'
      ]);
      $word = Word::find($id);
      $word->session_type = $request->get('session_type');
      $word->story_id = $request->get('story_id');
      $word->word = $request->get('word');
      $word->contextual_cue = $request->get('contextual_cue');
      $word->categorical_cue = $request->get('categorical_cue');
      $word->save();
      return redirect('/word')->with('success', 'WORD UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $word = Word::find($id);
      $word->delete();
      return redirect('/word')->with('success', 'WORD DELETED!');
    }
}
