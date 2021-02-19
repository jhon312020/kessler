<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booster;

class BoosterController extends Controller
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
      $booster = Booster::all();
      return view('kessler.booster.index', compact('booster'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('kessler.booster.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $request->validate([
        'category'=>'required'
      ]);
      
      $booster = new Booster([
        'category' => $request->get('category')
      ]);
      $booster->save();
      return redirect('/booster')->with('success', 'SESSION booster SAVED!');
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
      $booster = Booster::find($id);
      return view('kessler.booster.edit', compact('booster'));
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
        'category'=>'required'
      ]);
      $booster = Booster::find($id);
      $booster->category = $request->get('category');
      $booster->save();
      return redirect('/booster')->with('success', 'SESSION booster UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $booster = Booster::find($id);
      $booster->delete();
      return redirect('/booster')->with('success', 'SESSION booster DELETED!');
    }
}