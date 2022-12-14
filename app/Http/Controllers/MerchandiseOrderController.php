<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use Illuminate\Http\Request;
use App\Models\PaymentProvider;
use App\Models\MerchandiseOrder;
use App\Models\MerchandiseTransaction;
use Illuminate\Support\Facades\Validator;

class MerchandiseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('merchandise-orders.index',[
            'merchandises' => Merchandise::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

   public function tempStore(Request $request){
        $len = count($request->quantity);
        $filters = array('merch_id'=>[],'merchandise' =>[] ,'quantity' => [] , 'notes'=> []); 
        $grandTotal = 0; 
        for ($i =0 ; $i < $len ; $i++){
            if ($request->quantity[$i] != 0){
                $filters['merch_id'][] = $request->merch_id[$i];
                $filters['merchandise'][] = Merchandise::find($request->merch_id[$i]);
                $filters['quantity'][] = $request->quantity[$i];
                $filters['notes'][] = $request->notes[$i];
                $grandTotal += $request->quantity[$i] * $filters['merchandise'][$i]->price;
            }
        }
        
        return view('merchandise-orders.create',[
            'merchID' => $filters['merch_id'],
            'merchandise' => $filters['merchandise'],
            'quantity' => $filters['quantity'],
            'notes' => $filters['notes'],
            'grandTotal' => $grandTotal,
            'paymentProviders' => PaymentProvider::OrderBy('name')->where('type','BANK')->get()
        ]);
   }

    public function store(Request $request)
    {
        $quantity = explode(',',$request->quantity);
        $merchandise = explode(',',$request->merchandise);
        $notes = explode(',',$request->notes);
        $merch_id = explode(',',$request->merch_id);

        $validator =Validator::make($request->all(),[
            'name' => 'required|string',
            'institution' => 'nullable|string',
            'email' => 'required|string',
        ]);
        if($validator->fails()){
            return redirect()->route('merchandise-orders.index')->withErrors($validator)->withInput();
        }

        if($request->shipping == 'delivery'){
            $validator =Validator::make($request->all(),[
                'address' => 'required|string',
            ]);
            if($validator->fails()){
                return redirect()->route('merchandise-orders.index')->withErrors($validator)->withInput();
            }
        }
        
        $name= $request->name;
        $fileName = str_replace(' ', '-', $name);
        $fileName = preg_replace('/[^A-Za-z0-9\-]/', '', $fileName);
        $fileName = str_replace('-', '_', $fileName);
        $current = time();
        
        if($request->type == 'bank'){
            $validator =Validator::make($request->all(),[
                'payment_provider' => 'required',
                'account_name' => 'required|string',
                'account_number' => 'required|numeric',
                'transfer_proof_bank' => 'required|image|mimes:png,jpg,jpeg|max:1999'
            ]);

            if($validator->fails()){
                return redirect()->route('merchandise-orders.index')->withErrors($validator)->withInput();
            }
            
            
            if($request->hasFile('transfer_proof_bank')){
                $extension = $request->file('transfer_proof_bank')->getClientOriginalExtension();
                $fixedName = $fileName.'_'.$current.'.'.$extension;
                $path = $request->file("transfer_proof_bank")->storeAs("public/merchandise/transfer_proof",$fixedName);
            }
            
        }
        if($request->type == 'wise'){
            $validator =Validator::make($request->all(), [
                'payment_email' => 'required|string',
                'track' => 'required|numeric',
                'transfer_proof_wise' => 'required|image|mimes:png,jpg,jpeg|max:1999'
            ]);
            if($request->hasFile('transfer_proof_wise')){
                $extension = $request->file('transfer_proof_wise')->getClientOriginalExtension();
                $fixedName = $fileName.'_'.$current.'.'.$extension;
                $path = $request->file("transfer_proof_wise")->storeAs("public/merchandise/transfer_proof",$fixedName);
            }
        }
        // dd($request->all());
        $transaction = MerchandiseTransaction::create([
            'created_by' => '[USER]-Merchandise',
            'name' => $request->name,
            'email' => $request->email,
            'institution' => $request->institution,
            'phone_number' => $request->phone ,
            'payment_provider_id' => $request->payment_provider ,
            'address' => $request->address ,
            'account_name' => $request->account_name ,
            'account_number' => $request->account_number ,
            'payment_email' => $request->payment_email ,
            'tracking_link' => $request->track ,
            'payment_proof' => $fixedName,
            'amount' => $request->amount,
            'is_confirmed' => 0,
        ]);

        $len = count($quantity);
        // dd($merch_id);
        for ($i = 0 ; $i < $len; $i++) { 
            MerchandiseOrder::create([
                'created_by' => '[USER]-Merchandise',
                'merchandise_id' => $merch_id[$i],
                'quantity' => $quantity[$i],
                'transaction_id' => $transaction->id,
            ]);
        }


        return redirect()->route('merchandise-orders.index')->with('success','Merchandise has successfuly ordered. Please wait for admin to confirm your payment');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
