<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlightTicket;
use App\Exports\FlightTicketExport;
use Maatwebsite\Excel\Facades\Excel;

class FlightTicketController extends Controller
{
    public function __construct(){
        $this->middleware('IsShowed:ENV002')->only(['index']);
    }

    public function index()
    {
        $trashed = FlightTicket::onlyTrashed()->get();
        return view('flight-tickets.index', [
            'trashed'=>$trashed,
            'flights'=>FlightTicket::all(),
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit(FlightTicket $flight_ticket)
    {
        return view('flight-tickets.edit', [
            'flight'=>$flight_ticket,
        ]);
    }

    public function update(Request $request, FlightTicket $flightTicket)
    {
        $request->validate([
            'type'=>'required|string',
            'airline_name'=>'required|string',
            'flight_time'=>'required',
            'ticket_proof_new'=>'required',
        ]);
        // dd($request->all());
        $ticket_proof = array();
        if($files = $request->file('ticket_proof_new')){
            $i = 1;
            $flight_airline = $request->airline_name;
            $flight_type = $request->type;
            foreach($files as $file){
                $extension = strtolower($file->extension());
                $newName = $flight_type.'_'.$flight_airline;
                $newName = str_replace(' ', '-', $newName);
                $newName = str_replace('/[^A-Za-z0-9\-]/', '', $newName);
                $newName = str_replace('-', '_', $newName);
                $current = time();
                $fileName = $newName.'_'.$current.'_'.$i.'.'.$extension;
                $file->storeAs('public/images/flight-tickets', $fileName);
                $ticket_proof_new[] = $fileName;
                $i++;
            }
        }
        else{
            $ticket_proof_new[] = $request->ticket_proof_old;
        }
        $flightTicket->update([
            'pic_id'=>Auth::user()->id,
            'created_by'=>Auth::user()->username,
            'type'=>$request->type,
            'airline_name'=>$request->airline_name,
            'flight_time'=>$request->flight_time,
            'ticket_proof'=> implode('; ', $ticket_proof_new),
        ]);
        return redirect()->route('flight-tickets.index');
    }

    public function destroy(FlightTicket $flightTicket) // SOFT DELETE
    {
        $flightTicket->delete();
        return redirect()->back();
    }

    public function delete($id) // HARD DELETE
    {
        FlightTicket::where('id', $id)->forceDelete();
        return redirect()->back();
    }

    public function restore($id)
    {
        FlightTicket::where('id', $id)->restore();
        return redirect()->back();
    }
}
