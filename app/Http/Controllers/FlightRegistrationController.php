<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlightTicket;
use Maatwebsite\Excel\Facades\Excel;

class FlightRegistrationController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
        return view('flight-registrations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type'=>'required|string',
            'airline_name'=>'required|string',
            'flight_time'=>'required',
            'ticket_proof'=>'required',
        ]);
        // dd($request->all());
        $ticket_proof = array();
        if($files = $request->file('ticket_proof')){
            $i = 1;
            $flight_airline = $request->airline_name;
            $flight_type = $request->type;
            foreach($files as $file){
                $newName = $flight_type.'_'.$flight_airline;
                $newName = str_replace(' ', '-', $newName);
                $newName = str_replace('/[^A-Za-z0-9\-]/', '', $newName);
                $newName = str_replace('-', '_', $newName);
                $current = time();
                $extension = strtolower($file->extension());
                $fileName = $newName.'_'.$current.'_'.$i.'.'.$extension;
                $file->storeAs('public/images/flight-tickets', $fileName);
                $ticket_proof[] = $fileName;
                $i++;
            }
        }
        FlightTicket::create([
            'pic_id'=>'1',
            'created_by'=>'PIC',
            'type'=>$request->type,
            'airline_name'=>$request->airline_name,
            'flight_time'=>$request->flight_time,
            'ticket_proof'=> implode('; ', $ticket_proof),
        ]);

        return redirect()->route('flight-tickets.index');
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        
    }

    
    public function update(Request $request, FlightTicket $flightTicket)
    {
        
    }

    public function destroy(FlightRegistration $flightRegistration) // SOFT DELETE
    {
        $flightRegistration->delete();
        return redirect()->back();
    }

    public function delete($id) // HARD DELETE
    {
        FlightRegistration::where('id', $id)->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        FlightRegistration::where('id', $id)->restore();
        return redirect()->back();
    }
}
