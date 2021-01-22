<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TraineeJourney;
use App\Models\TraineeTransaction;
use App\Models\Word;

class TraineeJourneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {

        $traineejourney = TraineeJourney::all();
        return view('kessler.traineejourney.index', compact('traineejourney'));
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

        $session_pin = mt_rand(100000, 999999);
        $traineejourney = new TraineeJourney([
            'trainee_id' => $request->get('trainee_id'),
            'session_type' => $request->get('session_type'),
            'session_number' => $request->get('session_number'),
            'session_pin' => $session_pin

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

     /**
     * View report of the trainee for the session.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function view($id)
    {
        
       $traineejourney = TraineeJourney::find($id);
       $storyWords = Word::select('id', 'word')->where('story_id', $traineejourney['session_number'])->get();
        $aroundOneReport = TraineeTransaction::select('id', 'word_id', 'trainee_id', 'session_pin', 'type', 'answer', 'correct_or_wrong','round','time_taken')->where('trainee_id', $traineejourney['trainee_id'])->where('session_pin', $traineejourney['session_pin'])->where('type', '!=', 'Recall')->where('round', '=', '1')->get();
        //$this->pr($aroundOneReport->toArray());
        $aroundOneReport = $aroundOneReport->groupBy('word_id');
       /*$this->pr($traineeReport->toArray());
        exit;*/
        $aroundTwoReport = TraineeTransaction::select('id', 'word_id', 'trainee_id', 'session_pin', 'type', 'answer', 'correct_or_wrong','round','time_taken')->where('trainee_id', $traineejourney['trainee_id'])->where('session_pin', $traineejourney['session_pin'])->where('type', '!=', 'Recall')->where('round', '=', '2')->get();
        //$this->pr($aroundTwoReport->toArray());
        $aroundTwoReport = $aroundTwoReport->groupBy('word_id');
       /*$this->pr($traineeReport->toArray());
        exit;*/
       return view('kessler.traineejourney.view')->with(compact('aroundOneReport','aroundTwoReport', 'storyWords'));
        }
    
}
