<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructions;

class InstructionController extends Controller
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
        $instructions = Instructions::all();
        return view('kessler.instructions.index', compact('instructions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kessler.instructions.create');
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
            'instructions'=>'required'
        ]);
        
        $instructions = new Instructions([
            'instructions' => $request->get('instructions')
        ]);
        $instructions->save();
        return redirect('/instructions')->with('success', 'INSTRUCTION SAVED!');
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
        $instructions = Instructions::find($id);
        return view('kessler.instructions.edit', compact('instructions'));
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
            'instructions'=>'required'
        ]);
        $instructions = Instructions::find($id);
        $instructions->instructions = $request->get('instructions');
        $instructions->save();
        return redirect('/instructions')->with('success', 'INSTRUCTION UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instructions = Instructions::find($id);
        $instructions->delete();
        return redirect('/instructions')->with('success', 'INSTRUCTION DELETED!');
    }
}
