<?php

namespace App\Http\Controllers;

use App\Models\FlightTicket;
use Illuminate\Http\Request;
use App\Models\PickUpSchedule;
use Illuminate\Support\Facades\Auth;

class PickUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware(['IsAdmin']);
        $this->middleware('Access:32');
    }
    public function index()
    {
        $schedules = PickUpSchedule::orderBy('schedule')->get();
        $expectedPeople = [];
        foreach ($schedules as $schedule){
            $numberOfPeople = FlightTicket::where('schedule_id',$schedule->id)
                                ->sum('number_of_people');
            $expectedPeople = array_add($expectedPeople,$schedule->id, $numberOfPeople);
        };
        return view('pick-up-schedules.index',[
            'schedules' => $schedules,
            'expectedPeople' => $expectedPeople
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pick-up-schedules.create');
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
            'schedule' => 'required|string'
        ]);

        PickUpSchedule::create([
            'created_by' => Auth::guard('admin')->user()->name,
            'schedule' => $request->schedule,
        ]);

        return redirect()->route('pick-up-schedules.index')->with('success','Schedule has successfuly created');

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
        return view('pick-up-schedules.edit',[
            'schedule' => PickUpSchedule::find($id)
        ]);
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
        $schedule = PickUpSchedule::find($id);
        $request->validate([
            'schedule' => 'required|string'
        ]);

        $schedule->update([
            'updated_by' => Auth::guard('admin')->user()->name,
            'schedule' => $request->schedule,
        ]);

        return redirect()->route('pick-up-schedules.index')->with('success','Schedule has successfuly created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $schedule = PickUpSchedule::find($id);
       $schedule->delete();
       return redirect()->back()->with('success','Schedule has successfuly deleted');
    }
}
