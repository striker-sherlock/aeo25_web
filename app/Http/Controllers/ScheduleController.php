<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\CompetitionSlot;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{

    public function index()
    {
        $mainSchedules = Schedule::where('schedule_type', 'EV')->withoutTrashed()->orderBy('start_time')->get();
        $registeredSlots = CompetitionSlot::where('pic_id',Auth::user()->id)->get()->where('is_confirmed',1)->whereNotNull('payment_id');

        
        return view('schedules.index', [
            'registeredSlots' => $registeredSlots,
            'events' => $mainSchedules
        ]);
    }

    public function manage($type)
    {
        if ($type == "EV") {
           $schedules = Schedule::where('schedule_type', 'EV')->withoutTrashed()->get(); 
           $deletedSchedules = Schedule::where('schedule_type', 'EV')->onlyTrashed()->get(); 
        }else {
            $schedules = Schedule::where('schedule_type', 'CP')->where('event_init', $type)->withoutTrashed()->get();
            $deletedSchedules = Schedule::where('schedule_type', 'CP')->where('event_init', $type)->onlyTrashed()->get();
        }
        
        return view('schedules.manage', [
            'deletedSchedules' => $deletedSchedules,
            'schedules' => $schedules,
            'type' => $type,

        ]);
    }



    public function create()
    {

        return view('schedules.create');
    }


    public function store(Request $request)
    {
        $this->validateSchedule($request);

        Schedule::create([
            'schedule_type' => Auth::guard('admin')->user()->department_id,
            'event_init' => $request->event_init,
            'event_name' => $request->event_name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'created_by' => Auth::guard('admin')->user()->name,
        ]);

        return redirect()->route('schedules.manage', $request->event_init)->with('Success','Schedule Successfully Created!');
        
    }


    public function show($id)
    {
        $schedules = Schedule::where('schedule_type', 'CP')->where('event_init', $id)->withoutTrashed()->get();


        $registeredSlots = CompetitionSlot::where('pic_id',Auth::user()->id)
        ->get()
        ->where('is_confirmed',1)
        ->whereNotNull('payment_id');

        return view('schedules.show', [
            'schedules' => $schedules,
            'selectedEvent' => Competition::where('id', $id)->first(),
            'mainSchedules' => Schedule::where('schedule_type', 'EV')->withoutTrashed()->get(),
            'registeredSlots' => $registeredSlots
        ]);
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit',  [
            'schedule' => $schedule
        ]);
    }


    public function update(Request $request, Schedule $schedule)
    {
        $this->validateSchedule($request);

        $schedule->update([
            'event_name' => $request->event_name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('schedules.manage', $request->event_init)->with('success','Schedule Successfully Updated!');
    }


    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->back()->with('success', 'Delete Success');
    }

    public function restore($id)
    {
        Schedule::onlyTrashed()->find($id)->restore();

        return redirect()->back()->with('success', 'Restore Data Success');
    }

    public function delete($id)
    {
        Schedule::onlyTrashed()->find($id)->forceDelete();

        return redirect()->back()->with('success', 'Delete Success');
    }

    protected function validateSchedule(Request $request)
    {
        $request -> validate([
            'event_init' => 'required|in:EV,DB,SB,NC,ST,RD,SSW,IA,SP',
            'event_name' => 'required|string',
            'start_time' => 'required|date_format:d-m-Y H:i',
            'end_time' => 'required|date_format:d-m-Y H:i',
        ],[
            'event_init.in' => 'Invalid schedule type!',
            'start_time.date_format' => 'Event start does not match the format dd-mm-yyyy H:s, e.g. 30-10-2021 00:00',
            'end_time.date_format' => 'Event end does not match the format dd-mm-yyyy H:s, e.g. 30-10-2021 00:00',
        ]);
    }


}
