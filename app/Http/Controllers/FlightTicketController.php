<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FlightTicket;
use App\Exports\FlightTicketExport;
use Maatwebsite\Excel\Facades\Excel;

class FlightTicketController extends Controller
{
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
            foreach($files as $file){
                $extension = strtolower($file->getClientOriginalExtension());
                $file_name = 'new_'.$i.'.'.$extension;
                $upload_path = 'public/images/flight-registrations';
                // $image_url = $upload_path.$file_name;
                $file->move($upload_path, $file_name);
                $ticket_proof_new[] = $file_name;
                $i++;
            }
        }
        else{
            $ticket_proof_new[] = $request->ticket_proof_old;
        }
        $flightTicket->update([
            'pic_id'=>'1',
            'updated_by'=>'PIC',
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
