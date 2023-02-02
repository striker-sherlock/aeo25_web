<x-admin>
    <div class="container mt-4">
        <form action="{{route('merchandise-orders.update-payment',$order->id)}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <x-card>
                <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Edit {{$order->name}}'s order</h3>
                <hr>
                <div class="row">
                    <div class="col-md">
                        <div class="form-group mb-3">
                            <label for="name" class="col-form-label">Name<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="name" id="name" value="{{$order->name}}" required>
                        
                        </div> 
        
                        <div class="form-group mb-3">
                            <label for="institution" class="col-form-label">Institution<small class="text-muted"> (optional)</small></label>
                            <input type="text"  class="form-control"  name="institution" id="institution" value="{{$order->institution}}">
                            
                        </div>                
                        <div class="form-group mb-3">
                            <label for="phone" class="col-form-label">Phone Number<span class="text-danger">*</span> </label>
                            <input type="text"  class="form-control"  name="phone" id="phone" value="{{$order->phone_number}}" required>
                        </div> 
                        
                        
                    </div>

                    <div class="col-md">
                        <div class="form-group mb-3">
                            <label for="amount" class="col-form-label">Grand Total  </label>
                            <input type="text"  class="form-control"  name="amount" id="amount" value="{{$order->amount}}" required>
                        
                        </div> 
                        <div class="form-group mb-3">
                            <label for="email" class="col-form-label">Email <i class="fa-solid fa-triangle-exclamation me-1" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="This email is used to give you the payment reciept soon" ></i>
                                    
                            </label>
                            <input type="email"  class="form-control"  name="email" id="email" value="{{$order->email}}" required>
                        
                        </div> 
                        <div class="form-group mb-3  address">
                            <label for="address" class="col-form-label">
                                Address
                                <i class="fa-solid fa-triangle-exclamation me-1" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Please state your address as detail as possible"></i>
                            </label>
                            <textarea type="text"  class="form-control" rows="3" name="address" id="address" required> {{$order->address}}</textarea>
                            @if ($errors->has('address'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('address') }}.</strong>
                                </span>
                            @endif
                        </div> 
                        
                    </div>
                </div>
            </x-card>

            <x-card>
                <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Payment Detail </h3>
                <hr> 

                <input type="text" name="type" value="{{$order->paymentProvider->type}}" hidden>
                <ul class="nav nav-pills d-flex justify-content-around mb-3">
                    <li class=""><a data-bs-toggle="pill" href="#bank" class="btn btn-outline-primary rounded-pill me-3 d-block w-100 bank {{$order->paymentProvider->type == "BANK" ? 'active':''}}">Bank Transfer</a></li>

                    <li class=""><a data-bs-toggle="pill" href="#wise" class="btn btn-outline-primary rounded-pill me-3 d-block w-100 wise {{$order->paymentProvider->type == "Wise" ? 'active':''}}"> <input type="radio" class="btn-check" autocomplete="off" value="wise" id="type"> Wise</a></li>
                </ul>
                <div class="tab-content">
                    <div id="bank" class="tab-pane fade {{$order->paymentProvider->type == "BANK" ? 'show active':''}}">
                        <div class="form-group mb-2">
                            <label for="payment_provider" class="col-form-label">Bank Name<span class="text-danger">*</span></label>
                            <select class="form-select"  name="payment_provider" id="payment_provider" >  
                                <option selected class="d-none" disabled> Select Bank ... </option>
                                @foreach ($paymentProviders as $paymentProvider)
                                    <option value="{{$paymentProvider->id}}" {{$order->payment_provider_id == $paymentProvider->id? 'selected' : ''}}>{{$paymentProvider->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="account_name" class="col-form-label">Account Name<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="account_name" id="account_name" value="{{$order->account_name}}">
                            @if ($errors->has('account_name'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('account_name') }}.</strong>
                                </span>
                            @endif
                        </div>        
                        <div class="form-group mb-3">
                            <label for="account_number" class="col-form-label">Account Number<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="account_number" id="account_number" value="{{$order->account_number}}">
                            @if ($errors->has('account_number'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('account_number') }}.</strong>
                                </span>
                            @endif
                        </div>        
                
                        <div class="form-group mb-3">
                            <label for="transfer_proof_bank" class="col-form-label">Transfer Proof<span class="text-danger">*</span> <small class="text-muted">Please transfer to BCA 527 188 2077 (Rahmadira F Herdiningtyas)</small></label>
                            <input type="file" class="form-control"  name="transfer_proof_bank" id="transfer_proof_bank" accept="image/png,image/jpeg,image/jpg">    
                            <small class="text-danger"  style="font-size: 0.7em">Type : PNG, JPEG, JPG | Max : 2MB</small><br>
                            @if ($errors->has('transfer_proof_bank'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('transfer_proof_bank') }}.</strong>
                                </span>
                            @endif
                        </div>  
                        <button type="submit" class="btn btn-outline-theme w-100 rounded-pill">Save Changes</button>
                    </div>

                    {{-- WISE --}}
                    <div id="wise" class="tab-pane fade {{$order->paymentProvider->type == "Wise" ? 'show active':''}}">
                        <div class="form-group mb-3">
                            <label for="payment_email" class="col-form-label">Email Address<span class="text-danger">*</span></label>
                            <input type="email"  class="form-control"  name="payment_email" id="payment_email" value="{{$order->payment_email}}">
                        </div>        
                        <div class="form-group mb-3">
                            <label for="track" class="col-form-label">Tranking Link<span class="text-danger">*</span></label>
                            <input type="url"  class="form-control"  name="track" id="track" value="{{$order->tracking_link}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="transfer_proof_wise" class="col-form-label">Transfer Proof<span class="text-danger">*</span></label>
                            <input type="file"  class="form-control"  name="transfer_proof_wise" id="transfer_proof_wise" accept="image/png,image/jpeg,image/jpg">    
                            <small class="text-danger "  style="font-size: 0.7em">Type : PNG, JPEG, JPG | Max : 2MB</small><br>
                            @if ($errors->has('transfer_proof_wise'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('transfer_proof_wise') }}.</strong>
                                </span>
                            @endif
                        </div>       

                        <input type="text" hidden name="transfer_proof_old" value="{{$order->payment_proof}}">
                        <button type="submit" class="btn btn-outline-theme w-100 rounded-pill">Save Changes</button>
                    </div>
                </div>
            </x-card>
        </form>
    </div>
    <script> 
        let bank = document.querySelector('.bank');
        let wise = document.querySelector('.wise');
        let type = document.querySelector('input[name="type"]');
        bank.addEventListener('click', function(){
            type.value = "BANK";

            //set required untuk bank dan remove required buat yang wise
            document.querySelector('input[name="account_name"]').setAttribute('required','');
            document.querySelector('input[name="account_number"]').setAttribute('required','');
            document.querySelector('input[name="payment_email"]').removeAttribute('required');
            document.querySelector('input[name="track"]').removeAttribute('required');
        })
        wise.addEventListener('click', function(){
            type.value = "Wise";
            document.querySelector('input[name="payment_provider"]').value = "18";
            //set required untuk kolom inputan di wise dan remove required buat inputan yang di bank
            document.querySelector('input[name="payment_email"]').setAttribute('required','');
            document.querySelector('input[name="track"]').setAttribute('required','');
            document.querySelector('input[name="account_name"]').removeAttribute('required');
            document.querySelector('input[name="account_number"]').removeAttribute('required');
            
        })
    </script>
</x-admin>