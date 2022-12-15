<x-layout>
    <style>
        .order-summary{
            box-shadow: 0 0 10px 1px #eee;
        }
    </style>
    <x-navbar></x-navbar>
    <div class="container mt-5 mb-5">
        <form action="{{route('merchandise-orders.store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('POST')
            <input type="text" hidden name="quantity" value="{{implode(',',$quantity)}}" >
            <input type="text" hidden name="merch_id" value="{{implode(',',$merchID)}}" >
            <input type="text" hidden name="notes" value="{{implode(',',$notes)}}" >
            <input type="text" hidden name="merchandise" value="{{implode(',',$merchandise)}}" >
            @php ($len = count($merchID))
            <div class="row">
                <div class="col-md">
                    <x-card>
                        <h3 class="text-uppercase fw-bold  text-gradient fs-2 mb-3 text-center" style="letter-spacing: 0.1em">Order Summary </h3>
                        @for ($i = 0; $i < $len; $i++)
                            @php($image = explode('; ',$merchandise[$i]->image)[0])
                            <div class="row  mb-4  align-items-center   rounded-20 order-summary">
                                <div class="col-md">
                                    <img src="/storage/merchandise/merchandise_photo/{{ $image }}" class="img-fluid  px-3 py-3" alt="{{$merchandise[$i]->name}}" style="box-sizing:border-box;">
                                </div>
                                <div class="col-md">
                                    <h6>Product : {{$merchandise[$i]->name}}</h6>
                                    <h6>Quantity: {{$quantity[$i]}} Piece(s)</h6>
                                    <h6>Notes : {{$notes[$i] ? $notes[$i] : 'No Request'}}</h6>
                                    <h6>Price : IDR {{number_format($merchandise[$i]->price * $quantity[$i])}}</h6>

                                </div>
                            </div>
                        @endfor
                    </x-card>
                </div>
                <div class="col-md">
                    <x-card>
                        <h3 class="text-uppercase fw-bold  text-gradient fs-2 mb-3 text-center" style="letter-spacing: 0.1em">Receipt Summary </h3>
                        <div class="d-flex justify-content-between">
                            <h4>Items</h4>
                            <h4>Price</h4>
                        </div>
                        {{-- ini jika pic ingin membayar semua sekaligus --}}
                        @for ($i = 0; $i < $len ;  $i++)
                            <div class="d-flex justify-content-between">
                                <h6>{{$merchandise[$i]->name}} x {{$quantity[$i]}} piece(s)</h6>
                                <h6>IDR {{ number_format($merchandise[$i]->price * $quantity[$i], 2, ',', '.')}} </h6>
                            </div>
                        @endfor
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h3 class="fw-bold">Grand Total</h3>
                            <h4 class="fw-bold">IDR {{ number_format($grandTotal, 2, ',', '.')}} </h4>
                        </div>
                    </x-card>
                    <x-card>
                        <h5 class="fw-bold text-capitalize text-center text-gradient">payment guideline</h5>
                        
                        <hr>
                        <p>Please download the file below to see the payment guideline by clicking "Download Guideline" button. After that, please fill the form.</p>
                        <div class="row">
                            <div class="col">
                                <a href="https://drive.google.com/file/d/1WHgLGWbyIHAXWJwbdGquc3i-RMQKgXUO/view" target="_blank"
                                    class="btn btn-outline-theme rounded-pill px-4 w-100 "><i class="fas fa-file-invoice"></i> Download Guideline
                                </a>
                            </div>
                        </div>
                    </x-card>
                </div>
            </div>
            <x-card>
                <h3 class="text-uppercase fw-bold  text-gradient fs-2" style="letter-spacing: 0.1em">Personal Data</h3>
                <h6 class="text-muted"> Please fill your personal data bellow </h6>
                <hr>
                
                <div class="row">
                    <div class="col-md">
                        <div class="form-group mb-3">
                            <label for="name" class="col-form-label">Name<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="name" id="name" value="{{old('name')}}" required>
                            @if ($errors->has('name'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('name') }}.</strong>
                                </span>
                            @endif
                        </div> 
        
                        <div class="form-group mb-3">
                            <label for="institution" class="col-form-label">Institution<small class="text-muted"> (optional)</small></label>
                            <input type="text"  class="form-control"  name="institution" id="institution" value="{{old('institution')}}">
                            @if ($errors->has('institution'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('institution') }}.</strong>
                                </span>
                            @endif
                        </div>                
                        <div class="form-group mb-3">
                            <label for="phone" class="col-form-label">Phone Number<span class="text-danger">*</span> </label>
                            <input type="text"  class="form-control"  name="phone" id="phone" value="{{old('phone')}}" required>
                            @if ($errors->has('phone'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('phone') }}.</strong>
                                </span>
                            @endif
                        </div> 
                        
                        <div class="form-group mb-3">
                            <label for="email" class="col-form-label">Email <i class="fa-solid fa-triangle-exclamation me-1" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="This email is used to give you the payment reciept soon" ></i>
                                 
                            </label>
                            <input type="email"  class="form-control"  name="email" id="email" value="{{old('email')}}" required>
                            @if ($errors->has('email'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('email') }}.</strong>
                                </span>
                            @endif
                        </div> 

                    </div>
                    <div class="col-md">
                        <label for="" class="col-form label">Delivery Option<span class="text-danger">*</span> </label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="shipping" id="self-pick" value="self-pick-up" {{old('shipping' == 'self-pick-up' ? 'checked' : '')}} checked>
                            <label class="form-check-label" for="self-pick">
                              Self pick up at Binus University Kemanggisan (Anggrek Campus)
                            </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="shipping" id="delivery" value="delivery" required {{old('shipping' == 'delivery' ? 'checked' : '')}}>
                        <label class="form-check-label" for="delivery" >
                            Custom delivery
                        </label>
                        </div>

                        <div class="map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63463.49603881283!2d106.71633673124997!3d-6.201758500000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6dcc7d2c4ad%3A0x209cb1eef39be168!2sBINUS%20University%2C%20Anggrek%20Campus!5e0!3m2!1sen!2sid!4v1670899696628!5m2!1sen!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-20"></iframe>
                        </div>

                        <div class="form-group mb-3  address">
                            <label for="address" class="col-form-label">
                                Address
                                <i class="fa-solid fa-triangle-exclamation me-1" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Please state your address as detail as possible"></i>
                            </label>
                            <textarea type="text"  class="form-control" rows="3" name="address" id="address" required> {{old('address')}}</textarea>
                            @if ($errors->has('address'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('address') }}.</strong>
                                </span>
                            @endif
                            <p class="mb-0 mt-4">Please kindly contact our CP to determine the delivery fee</p>
                            <div class="cp-1 ">
                                <a href="https://api.whatsapp.com/send?phone=628113093815"
                                class="text-reset text-decoration-none" target="_blank">
                                <i class="fab fa-whatsapp me-2 fa-lg"></i>
                                +62-811-3093-815 (Divany)
                            </a>
                            </div>
                            <div class="cp-2">
                                <a href="https://api.whatsapp.com/send?phone=6285939670199"
                                class="text-reset text-decoration-none" target="_blank">
                                <i class="fab fa-whatsapp me-2 fa-lg"></i>
                                +62-859-3967-0199 (Kelly)
                            </a>
                            </div>
                         
                        </div> 
                        
                    </div>
                </div>
            </x-card>
            <x-card>
                <h2 class="text-uppercase fw-bold text-gradient">your payment details </h2>
                <p class="text-muted">Please fill the payment form bellow</p>
                <hr> 
                <ul class="nav nav-pills d-flex justify-content-around mb-3">
                    <li class=""><a data-bs-toggle="pill" href="#bank" class="btn btn-outline-primary rounded-pill me-3 d-block w-100 bank {{old('type') == "bank" ? 'show active':''}}">Bank Transfer</a></li>
    
                    <li class=""><a data-bs-toggle="pill" href="#wise" class="btn btn-outline-primary rounded-pill me-3 d-block w-100 wise {{old('type') == "wise" ? 'show active':''}}"> <input type="radio" class="btn-check" autocomplete="off" value="wise" id="type"> Wise</a></li>
     
                  
                  </ul>
               
                <input type="text" value="{{$grandTotal}}" name="amount" hidden>
                <input type="text" name="type" hidden value="{{old('type')}}">
                


                <div class="tab-content">
                    <div id="bank" class="tab-pane fade {{old('type') == "bank" ? 'show active':''}}">
                        <div class="form-group mb-2">
                            <label for="payment_provider" class="col-form-label">Bank Name<span class="text-danger">*</span></label>
                            <select class="form-select"  name="payment_provider" id="payment_provider" >  
                                <option selected class="d-none" disabled> Select Bank ... </option>
                                @foreach ($paymentProviders as $paymentProvider)
                                    <option value="{{$paymentProvider->id}}" {{old('payment_provider') == $paymentProvider->id? 'selected' : ''}}>{{$paymentProvider->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="account_name" class="col-form-label">Account Name<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="account_name" id="account_name" value="{{old('account_name')}}">
                            @if ($errors->has('account_name'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('account_name') }}.</strong>
                                </span>
                            @endif
                        </div>        
                        <div class="form-group mb-3">
                            <label for="account_number" class="col-form-label">Account Number<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="account_number" id="account_number" value="{{old('account_number')}}">
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
                        <button type="submit" class="btn btn-outline-theme w-100 rounded-pill">Order Now</button>
                    </div>

                    {{-- WISE --}}
                    <div id="wise" class="tab-pane fade {{old('type') == "wise" ? 'show active':''}}">
                        <div class="form-group mb-3">
                            <label for="payment_email" class="col-form-label">Email Address<span class="text-danger">*</span></label>
                            <input type="email"  class="form-control"  name="payment_email" id="payment_email" value="{{old('payment_email')}}">
                        </div>        
                        <div class="form-group mb-3">
                            <label for="track" class="col-form-label">Tranking Link<span class="text-danger">*</span></label>
                            <input type="url"  class="form-control"  name="track" id="track" value="{{old('track')}}">
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

                        <button type="submit" class="btn btn-outline-theme w-100 rounded-pill">Order Now</button>
                    </div>
                </div>
            </x-card>
        </form>
    </div>
    <x-footer></x-footer>

    <script type="module"> 
        let bank = document.querySelector('.bank');
        let wise = document.querySelector('.wise');
        let type = document.querySelector('input[name="type"]');
        bank.addEventListener('click', function(){
            type.value = "bank";
            // console.log(document.querySelector('select[name="payment_provider"]'));   
            //set required untuk bank dan remove required buat yang wise
            document.querySelector('input[name="account_name"]').setAttribute('required','');
            document.querySelector('input[name="account_number"]').setAttribute('required','');
            document.querySelector('select[name="payment_provider"]').setAttribute('required','');
            document.querySelector('input[name="transfer_proof_bank"]').setAttribute('required','');

            document.querySelector('input[name="payment_email"]').removeAttribute('required');
            document.querySelector('input[name="track"]').removeAttribute('required');
            document.querySelector('input[name="transfer_proof_wise"]').removeAttribute('required');

            //reset value yang ada di wise
            document.querySelector('input[name="payment_email"]').value = "";
            document.querySelector('input[name="track"]').value = "";
            document.querySelector('input[name="transfer_proof_wise"]').value = "";
        })
        wise.addEventListener('click', function(){
            type.value = "wise";
            //set required untuk kolom inputan di wise dan remove required buat inputan yang di bank
            document.querySelector('input[name="email"]').setAttribute('required','');
            document.querySelector('input[name="track"]').setAttribute('required','');
            document.querySelector('input[name="transfer_proof_wise"]').setAttribute('required','');
            
            document.querySelector('select[name="payment_provider"]').removeAttribute('required','');
            document.querySelector('input[name="transfer_proof_bank"]').removeAttribute('required','');
            document.querySelector('input[name="account_name"]').removeAttribute('required');
            document.querySelector('input[name="account_number"]').removeAttribute('required');
            
            //reset value inputan di bank tf
            document.querySelector('input[name="account_name"]').value = "";
            document.querySelector('input[name="account_number"]').value = "";
            document.querySelector('input[name="transfer_proof_bank"]').value = "";
            document.querySelector('select[name="payment_provider"]').value = 18;
            
        })

        // delivery mode
        $('input[name="shipping"]').on( 'change' ,function(){
            if( $('#delivery').is(':checked') ){
                $('.map').hide();
                $('.address').show();
                
            }
            if( $('#self-pick').is(':checked') ){
                $('.map').show();
                $('.address').hide();
            }
        })
        if( $('#delivery').is(':checked') ){
            $('.map').hide();
            $('.address').show();
        }

        if( $('#self-pick').is(':checked') ){
            $('.map').show();
            $('.address').hide();
        }
    </script>
</x-layout>