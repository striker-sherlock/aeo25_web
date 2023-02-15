<?php

namespace App\Http\Controllers;

use DateTime;
use App\Mail\FoodMail;
use App\Models\FoodCoupon;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Models\CompetitionParticipant;

class FoodController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin')->except(['sendFoodQR','viewQRCode']);
    }
    public function index(){
        $totalParticipants = CompetitionParticipant::all()->count();
       
        // dd($totalParticipant);
        return view('food-coupons.index',[
            'foods' => FoodCoupon::all(),
            'totalParticipants' => $totalParticipants
        ]);
    }

    public function show($day, $type){

        // select * from participant where id not in (select participant_id from food_coupons where type = ‘LUNCH’)
        $unclaimed = CompetitionParticipant::whereNotIn('id',FoodCoupon::where('day',$day)->where('type',$type)->pluck('participant_id'))->get();

        $claimed = CompetitionParticipant::join('food_coupons','food_coupons.participant_id','competition_participants.id')
            ->where('day',$day)
            ->where('type',$type)
            ->select('competition_participants.*','food_coupons.type')
            ->get();
         
        return view('food-coupons.show',[
            'day' => $day,
            'type' => $type,
            'claimed' => $claimed,
            'unclaimed' => $unclaimed
        ]);
    }

    public function claimValidation($type, $day, $id){
        $foodCoupon = FoodCoupon::where('participant_id',$id)
        ->where('type',$type)
        ->where('day',$day)
        ->get();
        return $foodCoupon->count();
    }

    public function viewQRCode($id){
        $id= Crypt::decrypt($id);
        return view('food-coupons.show-qr',['id'=>$id]);
    }

    public function sendFoodQR($id){
        $participant = CompetitionParticipant::find($id);

        $foodMail = [
            'subject' => "Food QR Code",
            'name'=>$participant->name,
            'body1'=>'Here is your QR Code to claim food: ',
            'body2'=>'Please show this QR code to the committee who in charge for distributing the food',
            'url' => route('food-coupons.view-qr-code',['id' => Crypt::encrypt($participant->id) ]),
        ];

        Mail::to($participant->email)->send(new FoodMail($foodMail,$participant->id));
        return redirect()->back()->with('success', "The QR Code has succesfuly sent to the participant's email");
    }

    public function create($id,$day = NULL ){
        
        if ($day == NULL){
            $start = "2023-02-13";    
            $day = now()->diffInDays($start) + 1;
        }

      

        $competitionParticipant = CompetitionParticipant::find($id);


        return view('food-coupons.create',[
            'participant' => $competitionParticipant, 
            'day' => $day
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'type' => 'required',
            'day' => 'required',
            'participant_id' => 'required',
        ]);
        //Validation 
     
        if ($this->claimValidation($request->type,$request->day,$request->participant_id) != 0 ) return redirect()->back()->with('error','This coupon has already claimed before');

        FoodCoupon::create([
            'created_by' => Auth::guard('admin')->user()->name,
            'participant_id' => $request->participant_id,
            'day' => $request->day,
            'type' => $request->type,
        ]);
        
        return redirect()->route('food-coupons.index',$request->day)->with('success','Coupon has successfuly claimed');
    }



}
