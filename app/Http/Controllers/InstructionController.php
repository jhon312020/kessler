<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instruction;

class InstructionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $commonRedirectRoute = '/instruction';
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
      $instruction = Instruction::all();
      return view('kessler.instruction.index', compact('instruction'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('kessler.instruction.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $request->validate([
        'instruction'=>'required'
      ]);
      
      $instruction = new Instruction([
        'instruction' => $request->get('instruction')
      ]);
      $instruction->save();
      return redirect($this->commonRedirectRoute)->with('success', 'INSTRUCTION SAVED!');
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
    public function edit($id) {
      $instruction = Instruction::find($id);
      return view('kessler.instruction.edit', compact('instruction'));
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
        'instruction'=>'required'
      ]);
      $instruction = Instruction::find($id);
      $instruction->instruction = $request->get('instruction');
      $instruction->save();
      return redirect($this->commonRedirectRoute)->with('success', 'INSTRUCTION UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $instruction = Instruction::find($id);
      $instruction->delete();
      return redirect($this->commonRedirectRoute)->with('success', 'INSTRUCTION DELETED!');
    }
}