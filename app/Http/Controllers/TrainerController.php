<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invite;
use App\Models\User;

class TrainerController extends Controller
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
      $trainers = User::where('role', 'TA')->get();
      return view('kessler.trainer.index', compact('trainers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
      return view('kessler.trainer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
          'name'=>'required',
          'email'=>'required'
        ]);
        $password = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstvwxyz"), 0, 8);
        $trainer = new User([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => Hash::make($password)
        ]);
        if ($trainer->save()) {
          $trainer->password = $password;
          Mail::to($trainer->email)->send(new Invite($trainer));
        }
        return redirect('/trainer')->with('success', 'TRAINER SAVED!');
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
      $trainer = User::find($id);
      return view('kessler.trainer.edit', compact('trainer'));
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
      $trainer = User::find($id);
      $trainer->name = $request->get('name');
      $trainer->save();
      return redirect('/trainer')->with('success', 'TRAINER UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $trainer = User::find($id);
      $trainer->delete();
      return redirect('/trainer')->with('success', 'TRAINER DELETED!');
    }

    /**
     * Status set to Active/Inactive
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function status(Request $request, $id)
    {
        $trainer = User::find($id);
        $trainer->status = $request->get('status');
        if ($trainer->status == 'inactive')  {
          $trainer->status = 0;
        }
        $trainer->save();
        return view('kessler.trainer.index', compact('trainer'));
    }
}
