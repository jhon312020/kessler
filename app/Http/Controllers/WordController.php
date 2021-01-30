<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;

class WordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
      $word = Word::all();
      return view('kessler.word.index', compact('word'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('kessler.word.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
          'word'=>'required',
          'categorical_cue'=>'required'
        ]);
        
        $words = new Word([
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
      return view('kessler.word.edit', compact('word'));
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
        'word'=>'required',
        'categorical_cue'=>'required'
      ]);
      $word = Word::find($id);
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
