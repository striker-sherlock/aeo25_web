<?php

namespace App\Http\Controllers;

use App\Models\FlightTicket;
use Illuminate\Http\Request;
use App\Models\PickUpSchedule;
use App\Exports\FlightTicketExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class FlightTicketController extends Controller
{
    public function __construct(){
        $this->middleware('IsShowed:ENV001')->only(['index', 'edit']); 
        $this->middleware(['auth', 'verified'])->only(['index','show', 'edit']);
        $this->middleware(['IsAdmin'])->only(['manage']);
    }

    public function index()
    {
        $ticket = FlightTicket::All();
        $flightTickets = FlightTicket::where('pic_id', Auth::user()->id);
                                    
        return view('flight-tickets.index',[
            'flightTickets' => $flightTickets->get(),
        ]);
    }

    public function manage()
    {
        $trashed = FlightTicket::onlyTrashed()->get();
        return view('flight-tickets.manage', [
            'trashed'=>$trashed,
            'flights'=>FlightTicket::all(),
        ]);
    }

    public function show() // nunjukkin tabel user doang
    {
    
    }

    public function edit(FlightTicket $flight_ticket)
    {
        return view('flight-tickets.edit', [
            'flight'=>$flight_ticket,
            'schedules' => PickUpSchedule::orderBy('schedule')->get()
        ]);
    }

    public function update(Request $request, FlightTicket $flightTicket)
    {
        $request->validate([
            'type'=>'required|string',
            'airline_name'=>'required|string',
            'flight_time'=>'required',
            'ticket_proof_new.*'=>'nullable|image|mimes:jpeg,jpg,png',
        ]);
        $ticketProofNew = array();
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
                $ticketProofNew[] = $fileName;
                $i++;
            }
        }
        else{
            $ticketProofOld =implode('; ', $request->ticket_proof_old); 
        }
 
        $flightTicket->update([
            'pic_id'=>Auth::user()->id,
            'created_by'=>Auth::user()->username,
            'type'=>$request->type,
            'airline_name'=>$request->airline_name,
            'flight_time'=>$request->flight_time,
            'ticket_proof'=> empty($ticketProofNew) ? $ticketProofOld : implode('; ',$ticketProofNew),
           
        ]);
        if(Auth::guard('admin')->check()){
            $flightTicket->update([
                'schedule_id' => $request->schedule,
                'number_of_people' => $request->people
            ]);
            return redirect()->route('flight-tickets.manage')->with('success','Ticket has successfuly updated');
            
        }   
        return redirect()->route('flight-tickets.index')->with('success','Ticket has successfuly updated');
    }

    public function export($type){
        return Excel::download(new FlightTicketExport($type), 'flight-tickets.xlsx');
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
