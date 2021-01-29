<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;

class WordsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $words = Word::all();
        return view('kessler.words.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kessler.words.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'words'=>'required',
            'categorical_cue'=>'required'
        ]);
        
        $words = new Word([
            'words' => $request->get('words'),
            'contextual_cue' => $request->get('contextual_cue'),
            'categorical_cue' => $request->get('categorical_cue')
        ]);
        $words->save();
        return redirect('/words')->with('success', 'WORD SAVED!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $words = Word::find($id);
        return view('kessler.words.edit', compact('words'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'words'=>'required',
            'categorical_cue'=>'required'
        ]);
        $words = Word::find($id);
        $words->words = $request->get('words');
        $words->contextual_cue = $request->get('contextual_cue');
        $words->categorical_cue = $request->get('categorical_cue');
        $words->save();
        return redirect('/words')->with('success', 'WORD UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $words = Word::find($id);
        $words->delete();
        return redirect('/words')->with('success', 'WORD DELETED!');
    }
}
