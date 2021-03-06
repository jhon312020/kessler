<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Overview;


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
      $overview = Overview::all();
      return view('kessler.overview.index', compact('overview'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('kessler.overview.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $request->validate([
        'overview'=>'required'
      ]);
      
      $overview = new Overview([
        'overview' => $request->get('overview')
      ]);
      $overview->save();
      return redirect('/overview')->with('success', 'OVERVIEW SAVED!');
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
      $overview = Overview::find($id);
      return view('kessler.overview.edit', compact('overview'));
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
        'overview'=>'required'
      ]);
      $overview = Overview::find($id);
      $overview->overview = $request->get('overview');
      $overview->save();
      return redirect('/overview')->with('success', 'OVERVIEW UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $overview = Overview::find($id);
      $overview->delete();
      return redirect('/overview')->with('success', 'OVERVIEW DELETED!');
    }
}