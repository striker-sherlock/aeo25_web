<?php

namespace App\Http\Controllers;

use App\Exports\CompetitionPaymentExport;
use App\Models\AccommodationSlot;
use App\Models\AccommodationPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AdminAccommodationPaymentController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin')->only(['index']);
    }

    public function index()
    {
        $accommodationPayment = AccommodationPayment::join('accommodation_slot_details', 'accommodation_payments.id', '=', 'accommodation_slot_details.payment_id')
        ->join('users', 'accommodation_payments.pic_id', '=', 'users.id')
        ->join('accommodations', 'accommodation_slot_details.accommodation_id', '=', 'accommodations.id')
        ->select('accommodation_payments.*', 'users.*','accommodation_payments.created_at','accommodation_payments.id as id', 'payment_proof', 'accommodations.room_type')
        ->get();

        $pending =  $accommodationPayment->where('is_confirmed', 0);
        $confirmed =  $accommodationPayment->where('is_confirmed', 1);
        $rejected =  $accommodationPayment->where('is_confirmed', -1);
        
        return view('accommodation-payments.index',[
            'pending' => $pending,
            'confirmed' => $confirmed,
            'rejected' => $rejected,
        ]);
    }

    public function confirm(AccommodationPayment $accommodationPayment){

        $accommodationPayment ->update([
            'is_confirmed' => 1,
            'updated_by' => Auth::guard('admin')->user()->name,
        ]);

        // $confirmedMail = [
        //     'subject' =>"Confirmed Competition Payment",
        //     'name'=>$competitionPayment->user->pic_name,
        //     'body' => 'Your Competition Payment have confirmed', 
        //     'url' => 'http://aeo.mybnec.org/dashboard/step-3'

        // ];
        // Mail::to($competitionPayment->user->email)->send(new ConfirmedSlotMail($confirmedMail));

        return redirect()->back()->with('success','Payment is successfuly confirmed');
    }

    public function cancel(AccommodationPayment $accommodationPayment){
        
        $accommodationPayment ->update([
            'is_confirmed' => 0,
            'updated_by' => Auth::guard('admin')->user()->name,
        ]);

        return redirect()->back()->with('success', 'The payment successfully canceled');
    }

    public function export(){
        return Excel::download(new CompetitionPaymentExport, 'competition-payments.xlsx');
    }

    public function reject(Request $request){
        $accommodationPayment= AccommodationPayment::find($request->payment);
        $accommodationPayment->update([
            'is_confirmed' => -1
        ]);

        // $rejectMail = [
        //     'subject' => "Competition Payment Rejection",
        //     'name'=>$accommodationPayment->user->name,
        //     'reason' => $request->reason,

        // ];
        // Mail::to($acommodationPayment->user->email)->send(new RejectionMail($rejectMail));
        return redirect()->back()->with('success', 'Payment is Successfuly rejected');
    }
}
