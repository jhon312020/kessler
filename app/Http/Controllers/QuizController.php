<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;

class QuizController extends Controller
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
      $quiz = Quiz::all();
      return view('kessler.quiz.index', compact('quiz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $totalSessions = $this->totalSessions;
      return view('kessler.quiz.create', compact('totalSessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
          'session_number' => 'required',
          'question'=>'required',
          'answer'=>'required',
          'sentence_answer' => 'required'
        ]);
        
        $quiz = new Quiz([
          'session_number' => $request->get('session_number'),
          'question' => $request->get('question'),
          'sentence_answer' => $request->get('sentence_answer')
        ]);
        $data = $request->only('answer');
        $quiz['one_word_answer'] = json_encode($data);
        $quiz->save();
        return redirect('/quiz')->with('success', 'QUIZ SAVED!');
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
      $quiz = Quiz::find($id);
      $totalSessions = $this->totalSessions;
      return view('kessler.quiz.edit', compact('quiz','totalSessions'));
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
        'session_number' => 'required',
        'question'=>'required',
        'answer'=>'required',
        'sentence_answer' => 'required'
      ]);
      $quiz = Quiz::find($id);
      $quiz->session_number = $request->get('session_number');
      $quiz->question = $request->get('question');
      $quiz->one_word_answer = $request->get('answer');
      $quiz->sentence_answer = $request->get('sentence_answer');
      $quiz->save();
      return redirect('/quiz')->with('success', 'QUIZ UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $quiz = Quiz::find($id);
      $quiz->delete();
      return redirect('/quiz')->with('success', 'QUIZ DELETED!');
    }
}
