<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overviews;


class OverviewController extends Controller
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
      $overviews = Overviews::all();
      return view('kessler.overviews.index', compact('overviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('kessler.overviews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $request->validate([
        'overviews'=>'required'
      ]);
      
      $overviews = new Overviews([
        'overviews' => $request->get('overviews')
      ]);
      $overviews->save();
      return redirect('/overviews')->with('success', 'OVERVIEWS SAVED!');
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
      $overviews = Overviews::find($id);
      return view('kessler.overviews.edit', compact('overviews'));
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
        'overviews'=>'required'
      ]);
      $overviews = Overviews::find($id);
      $overviews->overviews = $request->get('overviews');
      $overviews->save();
      return redirect('/overviews')->with('success', 'OVERVIEWS UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $overviews = Overviews::find($id);
      $overviews->delete();
      return redirect('/overviews')->with('success', 'OVERVIEWS DELETED!');
    }
}