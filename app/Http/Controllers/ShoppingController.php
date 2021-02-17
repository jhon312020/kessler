<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shopping;

class ShoppingController extends Controller
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
      $shopping = Shopping::all();
      return view('kessler.shopping.index', compact('shopping'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $totalSessions = $this->totalSessions;
      return view('kessler.shopping.create', compact('totalSessions'));
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
          'item'=>'required',
          'categorical_cue'=>'required'
        ]);
        
        $shoppings = new Shopping([
          'story_id' => $request->get('story_id'),
          'item' => $request->get('item'),
          'categorical_cue' => $request->get('categorical_cue')
        ]);
        $shoppings->save();
        return redirect('/shopping')->with('success', 'shopping SAVED!');
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
      $shopping = Shopping::find($id);
      $totalSessions = $this->totalSessions;
      return view('kessler.shopping.edit', compact('shopping', 'totalSessions'));
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
        'item'=>'required',
        'categorical_cue'=>'required'
      ]);
      $shopping = Shopping::find($id);
      $shopping->story_id = $request->get('story_id');
      $shopping->item = $request->get('item');
      $shopping->categorical_cue = $request->get('categorical_cue');
      $shopping->save();
      return redirect('/shopping')->with('success', 'shopping UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $shopping = Shopping::find($id);
      $shopping->delete();
      return redirect('/shopping')->with('success', 'shopping DELETED!');
    }
}
