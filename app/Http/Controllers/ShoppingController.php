<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\Shopping;
use App\Models\Shopping;
use App\Models\Task;
use App\Models\Type;

class ShoppingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    var $boosterRange = array();
    public function __construct() {
      $this->middleware('auth');
      $this->boosterRange = range(1, 3);
      parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $shopping = Task::where('booster_id','2')->get();
      $types = Type::pluck('type', 'id');
      return view('kessler.shopping.index', compact('shopping', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      $types = Task::all();
      $boosterRange = $this->boosterRange;
      return view('kessler.shopping.create', compact('types', 'boosterRange'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
          'booster_range'=>'required',
          'item'=>'required',
          'categorical_cue'=>'required'
        ]);
        $booster_id = 2;
        $shoppings = new Task([
          'booster_id' => $booster_id,
          'booster_range' => $request->get('booster_range'),
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
      $shopping = Task::find($id);
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
       // 'booster_range'=>'required',
        'item'=>'required',
        'categorical_cue'=>'required'
      ]);
      $shopping = Task::find($id);
     // $shopping->booster_range = $request->get('booster_range');
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
      $shopping = Task::find($id);
      $shopping->delete();
      return redirect('/shopping')->with('success', 'Shopping Item DELETED!');
    }
}
