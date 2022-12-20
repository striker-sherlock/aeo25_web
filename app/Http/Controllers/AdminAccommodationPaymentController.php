<?php

namespace App\Http\Controllers;

use App\Exports\CompetitionPaymentExport;
use App\Models\AccommodationSlot;
use App\Models\AccommodationPayment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Mail\RejectionMail;
use Illuminate\Http\Request;
use App\Mail\ConfirmedSlotMail;
use App\Exports\AccommodationPaymentExport;


class AdminAccommodationPaymentController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin')->only(['index']);
    }

    public function index()
    {
        $accommodationPayment = AccommodationPayment::join('accommodation_slot_details', 'accommodation_payments.id', '=', 'accommodation_slot_details.payment_id')
        ->join('users', 'accommodation_slot_details.pic_id', '=', 'users.id')
        ->join('accommodations', 'accommodation_slot_details.accommodation_id', '=', 'accommodations.id')
        ->select(
            'accommodation_payments.*', 
            'users.*',
            'accommodation_payments.created_at',
            'accommodation_payments.id as id', 
            'accommodations.room_type',
            'payment_proof')
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

        $confirmedMail = [
            'subject' =>"Confirmed Accommodation Payment",
            'name'=>$accommodationPayment->user->pic_name,
            'body1' => 'With this email, your payment for your accommodation slot has been confirmed.', 
            'body2' => 'We also like to inform you to continue to the Guest Registration step by clicking this link below.',
            'url' => 'http://aeo.mybnec.org/dashboard/accommodation-step-3'

        ];
        Mail::to($accommodationPayment->user->email)->send(new ConfirmedSlotMail($confirmedMail));

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
        return Excel::download(new AccommodationPaymentExport, 'accommodation-payments.xlsx');
    }

    public function reject(Request $request){
        $accommodationPayment= AccommodationPayment::find($request->payment);
        $accommodationPayment->update([
            'is_confirmed' => -1
        ]);

        $rejectMail = [
            'subject' => "Accommodation Payment Rejection",
            'name'=>$accommodationPayment->user->pic_name,
            'body1'=>'We are regretful to inform you that your payment for your accommodation slot has been rejected with the reason below: ',
            'body2'=>'You can edit your payment again by going into the payment step on our website.',
            'reason' => $request->reason,
            'url' => 'http://aeo.mybnec.org/dashboard/accommodation-step-2',

        ];
        Mail::to($accommodationPayment->user->email)->send(new RejectionMail($rejectMail));
        return redirect()->back()->with('success', 'Payment is Successfuly rejected');
    }
}
