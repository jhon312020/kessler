<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shopping;
use App\Models\Type;

class ShoppingController extends Controller
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
      $shopping = Shopping::all();
      $types = Type::pluck('type', 'id');
      return view('kessler.shopping.index', compact('shopping', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $types = Type::all();
      return view('kessler.shopping.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
          'session_type'=>'required',
          'item'=>'required',
          'categorical_cue'=>'required'
        ]);
        
        $shoppings = new Shopping([
          'story_id' => $request->get('story_id'),
          'session_type' => $request->get('session_type'),
          'item' => $request->get('item'),
          'categorical_cue' => $request->get('categorical_cue')
        ]);
        $shoppings->save();
        return redirect('/shopping')->with('success', 'Shopping Item SAVED!');
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
      $types = Type::all();
      return view('kessler.shopping.edit', compact('shopping', 'types'));
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
        'session_type'=>'required',
        'item'=>'required',
        'categorical_cue'=>'required'
      ]);
      $shopping = Shopping::find($id);
      $shopping->session_type = $request->get('session_type');
      $shopping->story_id = $request->get('story_id');
      $shopping->item = $request->get('item');
      $shopping->categorical_cue = $request->get('categorical_cue');
      $shopping->save();
      return redirect('/shopping')->with('success', 'Shopping Item UPDATED!');
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
      return redirect('/shopping')->with('success', 'Shopping Item DELETED!');
    }
}