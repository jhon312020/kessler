<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TraineeJourney;
use DB;

class TraineeJourneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {

        DB::statement("UPDATE trainee_journeys SET `session_pin` = LEFT(CAST(RAND()*1000000000 AS INT),6)");
        $traineejourney = TraineeJourney::all();
        return view('kessler.traineejourney.index', compact('traineejourney'));
        exit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        return view('kessler.traineejourney.create');
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
            'trainee_id'=>'required',
            'session_type'=>'required',
            'session_number'=>'required'

        ]);

     
        $traineejourney = new TraineeJourney([
            'trainee_id' => $request->get('trainee_id'),
            'session_type' => $request->get('session_type'),
            'session_number' => $request->get('session_number'),
             'session_pin' => $request->get('session_pin')
     
        ]);

        $traineejourney->save();
        return redirect('/traineejourney')->with('success', 'TRAINEE JOURNEY SAVED!');
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
        $traineejourney = TraineeJourney::find($id);
        return view('kessler.traineejourney.edit', compact('traineejourney'));
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
            'session_type'=>'required',
             'session_number'=>'required'
        ]);
        $traineejourney = TraineeJourney::find($id);
        $traineejourney->session_type = $request->get('session_type');
        $traineejourney->session_number = $request->get('session_number');
        $traineejourney->save();
        return redirect('/traineejourney')->with('success', 'TRAINEE JOURNEY UPDATED!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $traineejourney = TraineeJourney::find($id);
        $traineejourney->delete();
        return redirect('/traineejourney')->with('success', 'TRAINEE JOURNEY DELETED!');
    }

      /*  public function changeStatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Status change successfully.']);
    }*/

   /* public function copy()
    {
          TraineeJourney::query()
  ->where('id','=', 1)
  ->each(function ($oldRecord) {
    $newRecord = $oldRecord->replicate();
    $newRecord->setTable('traineejourney');
    $newRecord->save();

    $oldRecord->delete();
  });
    }*/

}
