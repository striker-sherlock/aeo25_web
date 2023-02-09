<?php

namespace App\Http\Controllers;

use App\Mail\RejectionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\ConfirmedSlotMail;
use App\Models\PaymentProvider;
use App\Models\MerchandiseOrder;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\MerchandiseTransaction;
use App\Exports\MerchandiseOrderExport;
use App\Exports\MerchandiseTransactionExport;

class AdminMerchandiseController extends Controller
{
    public function __construct(){
        $this->middleware('IsAdmin');
        $this->middleware('Access:29')->only(['index']);
        $this->middleware('Access:30')->only(['payment']);
    }

    public function index(){
        $merchandise = MerchandiseOrder::OrderBy('created_at')
                    ->join('merchandise_transactions','merchandise_transactions.id','merchandise_orders.transaction_id')
                    ->join('merchandises','merchandise_orders.merchandise_id','merchandises.id')
                    ->where('merchandise_transactions.is_confirmed',1)
                    ->select('merchandise_orders.*')
                    ->get();    
        return view('merchandise-orders.manage',[
            'merchandises' => $merchandise
        ]);
    }

    public function payment(){
        $allMerch = MerchandiseTransaction::all();
        $pending = $allMerch->where('is_confirmed',0);
        $confirmed = $allMerch->where('is_confirmed',1);
        $rejected = $allMerch->where('is_confirmed',-1);
        return view('merchandise-orders.payment',[
            'pending' => $pending,
            'confirmed' => $confirmed,
            'rejected' => $rejected,
            'allMerch' => $allMerch,
        ]);
        
    }

    public function edit($id){
        $order = MerchandiseTransaction::find($id);
        // dd($order->paymentProvider->type);
        return view('merchandise-orders.edit',[
            'order' => $order,
            'paymentProviders' => PaymentProvider::OrderBy('name')->where('type','BANK')->get()
        ]);
    }

    public function editMerch($id){
        $order = MerchandiseOrder::find($id);
        // dd($order->paymentProvider->type);
        return view('merchandise-orders.edit-merch',[
            'order' => $order,
        ]);
    }

    public function updateMerch(Request $request, $id){
        $merchandise = MerchandiseOrder::find($id);
        $request->validate([
            'quantity' =>'required|numeric',
            'notes' =>'nullable|string',
        ]);
        $merchandise->update([
            'quantity' => $request->quantity,
            'order_details' => $request->notes,
        ]);
        return redirect()->route('merchandise-orders.index')->with('success','Merchandise has successfuly updated');
    }

    public function update(Request $request, $id){
        $merchandise = MerchandiseTransaction::find($id); 
        $request->validate([
            'name' => 'required|string',
            'institution' => 'nullable|string',
            'phone' => 'required|numeric',
            'email' => 'required|string',
        ]);
        if($request->type == "BANK"){
            $request->validate([
                'payment_provider' => 'required',
                'transfer_proof_bank' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
                'account_name' => 'required|string',
                'account_number' => 'required|numeric',
            ]);
        }
        elseif ($request->type == "Wise"){
            $request->validate([
                'email' => 'required|string',
                'track' => 'required|string',
                'transfer_proof_wise' => 'nullable|image|max:1999|mimes:jpg,png,jpeg',
            ]);
        }

        $name = $merchandise->name;
        $fileName = str_replace(' ', '-', $name );
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
        $fileName = str_replace('-', '_', $fileName);
        $current = time();
        
        // kalo payment type nya bank
        if($request->type == 'BANK'){
            if ($request->hasFile('transfer_proof_bank')){
                $extension = $request->file('transfer_proof_bank')->getClientOriginalExtension();
                $fixedName = $fileName.'_'.$current.'.'.$extension;
                $path = $request->file("transfer_proof_bank")->storeAs("public/merchandise/transfer_proof",$fixedName);
            }
            else{
                $fixedName = $request->transfer_proof_old;
            }
            $merchandise->update([
                'payment_provider_id' => $request->payment_provider,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'payment_proof' => $fixedName,
                'payment_email' => null,
                'tracking_link' =>null,
                'updated_by' =>   Auth::guard('admin')->user()->name,
                'updated_at' => Carbon::now(), 
            ]);
        }

        // ini untuk update menjadi wise
        else{
            if ($request->hasFile('transfer_proof_wise')){
                $extension = $request->file('transfer_proof_wise')->getClientOriginalExtension();
                $fixedName = $fileName.'_'.$current.'.'.$extension;
                $path = $request->file("transfer_proof_wise")->storeAs("public/merchandise/transfer_proof",$fixedName);
            }
            else{
                $fixedName = $request->transfer_proof_old;
            }
            $merchandise->update([
                'payment_provider_id' => 18,
                'payment_email' => $request->payment_email,
                'tracking_link' => $request->track,
                'payment_proof' => $fixedName,
                'account_name' => null,
                'account_number' => null,
                'updated_by' =>   Auth::guard('admin')->user()->name,
                'updated_at' => Carbon::now(),
            ]);
            
        }

        $merchandise->update([
            'name' => $request->name,
            'institution' => $request->institution,
            'phone_number' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'amount' => $request->amount,
            'updated_at' => Carbon::now(),
            'updated_by' =>   Auth::guard('admin')->user()->name,
        ]);

        return redirect()->route('merchandise-orders.payment')->with('success','Merchandise transaction has successfuly updated');
    }
    public function confirm($id){
        $merchandisePayment = MerchandiseTransaction::find($id);

        $merchandisePayment ->update([
            'is_confirmed' => 1,
            'updated_by' => Auth::guard('admin')->user()->name,
            'updated_at' => Carbon::now()
        ]);
        // dd($merchandisePayment);
        $confirmedMail = [
            'subject' =>"Confirmed Merchandise Order",
            'name'=>$merchandisePayment->name,
            'body1' => 'With this email, your Merchandise Order has been confirmed.', 
            'body2' => 'Please go to the link bellow to see your payment receipt', 
            'url' => route('merchandise-receipt', $merchandisePayment->id)  ,
        ];

        Mail::to($merchandisePayment->email)->send(new ConfirmedSlotMail($confirmedMail));

        return redirect()->back()->with('success','Payment is successfuly confirmed');
    }

    public function cancel($id){
        $merchandiseTransaction = MerchandiseTransaction::find($id);
        $merchandiseTransaction->update([
            'is_confirmed' => 0,
            'updated_by' => Auth::guard('admin')->user()->name,
        ]);

 
        return redirect()->back()->with('success', 'The payment has successfully canceled');
    }

 

    public function export(){
        return Excel::download(new MerchandiseTransactionExport, 'merchandise-transactions.xlsx');
    }

    public function exportOrder(){
        return Excel::download(new MerchandiseOrderExport, 'merchandise-orders.xlsx');
    }

    public function reject(Request $request){
        $merchandisePayment= MerchandiseTransaction::find($request->payment);
   
        $merchandisePayment->update([
            'is_confirmed' => -1,
            'updated_by' => Auth::guard('admin')->user()->name,
        ]);

        $rejectMail = [
            'subject' => "Merchandise Order Rejection",
            'name'=>$merchandisePayment->name,
            'body1'=>'We are regretful to inform you that your merchandise order has been rejected with the reason below: ',
            'body2'=>'',
            'reason' => $request->reason,
            'url' => 'http://aeo.mybnec.org/merchandise-orders',
        ];
        Mail::to($merchandisePayment->email)->send(new RejectionMail($rejectMail));
        
        return redirect()->back()->with('success', 'Payment is Successfuly rejected');
    }

    public function destroy($id){
        $merchandiseOrder = MerchandiseOrder::find($id);
        $merchandiseOrder->delete();
        return redirect()->back()->with('success','Merchandise order has successfuly deleted');
    }
}
