<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StorySession;

class StorySessionController extends Controller
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
      $storySession = StorySession::all();
      return view('kessler.storysession.index', compact('storySession'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('kessler.storysession.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $request->validate([
        'name'=>'required'
      ]);
      
      $storySession = new StorySession([
        'name' => $request->get('name')
      ]);
      $storySession->save();
      return redirect('/storySession')->with('success', 'Session SAVED!');
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
      $storySession = StorySession::find($id);
      return view('kessler.storysession.edit', compact('storySession'));
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
        'name'=>'required'
      ]);
      $storySession = StorySession::find($id);
      $storySession->name = $request->get('name');
      $storySession->save();
      return redirect('/storySession')->with('success', 'Session UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $storySession = StorySession::find($id);
        $storySession->delete();
        return redirect('/storySession')->with('success', 'Session DELETED!');
    }
}