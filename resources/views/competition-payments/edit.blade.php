<x-user title="Edit Competition Payment">   
 
    <div class="container mt-3">
        <a href="{{route('dashboard.step',2)}}" class="btn btn-outline-primary rounded-pill mb-3">Go Back</a>
        <div class="row">
            <div class="col-md-6">
                <x-card>
                    <h5 class="fw-bold text-uppercase text-center">payment guide and invoice</h5>
                    <hr>
                    <p>Please download the file below to see the payment guide and your invoice by clicking "Download Invoice & Guide" button. After that, please fill the form.</p>
                    <a href="{{route('payments.invoice', [$user->id, $paidSlot])}}" target="_blank"
                        class="btn btn-outline-primary rounded-pill px-4 "><i class="fa-solid fa-download">&nbsp;</i>Download Invoice and Guide</a>
                </x-card>
            </div>
            <div class="col-md-6">
                {{-- RECIEPT SUMMARY --}}
                <x-card>
                    <h5 class="text-uppercase fw-bold text-center">Reciept Summary</h5><hr>
                    <div class="d-flex justify-content-between">
                        <h4>Competition</h4>
                        <h4>Price</h4>
                    </div>
                    @foreach ($paidSlot as $competitionSlot)
             
                        <div class="d-flex justify-content-between">
                            <h6>{{$competitionSlot->competition->name}} x {{$competitionSlot->quantity}} {{$competitionSlot->competition->need_team == 1 ? 'Team' : 'People'}}</h6>
                            <h6>{{ number_format($competitionSlot->competition->price, 2, ',', '.')}} IDR</h6>
                        </div>
                        
                    @endforeach
                    <hr>
                    
                    <div class="d-flex justify-content-between">
                        <h3>Grand Total</h3>
                        <h4>{{ number_format($competitionPayment->amount, 2, ',', '.')}} IDR</h4>
                    </div>
                 
                    
                </x-card>
            </div>
        </div>
        <x-card>
            <h2 class="text-uppercase fw-bold">your payment details </h2>
            <p class="text-muted">Please Fill the Form Bellow</p>
            <hr> 
            <ul class="nav nav-pills d-flex justify-content-around mb-3">

                <li class="">
                    <a data-bs-toggle="pill" href="#bank" class="btn btn-outline-primary rounded-pill me-3 d-block w-100 bank {{$competitionPayment->paymentProvider->type == "BANK" ? 'active' : ''}}">Bank Transfer</a>
                </li>

                <li class="">
                    <a data-bs-toggle="pill" href="#wise" class="btn btn-outline-primary rounded-pill me-3 d-block w-100 wise {{$competitionPayment->paymentProvider->type == "Wise" ? 'active' : ''}}"> <input type="radio" class="btn-check" autocomplete="off" value="wise" id="type"> Wise</a>
                </li>
 
              
              </ul>
            <form action="{{route('competition-payments.update',$competitionPayment->id)}}" method="POST" enctype="multipart/form-data">
 
                @csrf
                @method('PUT')
                <input type="text" name="type" value="{{$competitionPayment->paymentProvider->type}}" hidden>
                <div class="tab-content">
                    <div id="bank" class="tab-pane fade {{$competitionPayment->paymentProvider->type == "BANK" ? 'show active' : ''}}">

                        <div class="form-group mb-2">
                            <label for="payment_provider" class="col-form-label">Payment Type<span class="text-danger">*</span></label>
                            <select class="form-select"  name="payment_provider">
                                @foreach ($paymentProviders as $paymentProvider)
                                    <option value="{{$paymentProvider->id}}" {{$competitionPayment->payment_provider_id == $paymentProvider->id ? 'selected' : ''}}>{{$paymentProvider->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="account_name" class="col-form-label">Account Name<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="account_name" id="account_name" value="{{$competitionPayment->account_name}}">
                        </div>        
                        <div class="form-group mb-3">
                            <label for="account_number" class="col-form-label">Account Number<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="account_number" id="account_number" value="{{$competitionPayment->account_number }}">
                        </div>        
                
                        <div class="form-group mb-3">
                            <label for="transfer_proof_bank" class="col-form-label">Transfer Proof</label>
                            <input type="file" class="form-control"  name="transfer_proof_bank" id="transfer_proof_bank" accept="image/png,image/jpeg,image/jpg">    
                            <small class="text-danger"  style="font-size: 0.7em">Type: png,jpg, jpeg | max: 2MB</small>
                        </div>  
                        <a href="#" class="btn btn-outline-info rounded-pill mb-3" data-bs-toggle="modal" data-bs-target="#payment-proof" >View Current Proof</a>
                         
                        <input type="text" name="transfer_proof_old" value="{{$competitionPayment->payment_proof}}" hidden>

                        <button type="submit" class="btn btn-outline-primary w-100 rounded-pill">Submit Payment Confirmation</button>
                    </div>

                    {{-- WISE --}}
                    <div id="wise" class="tab-pane fade {{$competitionPayment->paymentProvider->type == "Wise" ? 'show active' : ''}}">
                        <div class="form-group mb-3">
                            <label for="email" class="col-form-label">Email Address<span class="text-danger">*</span></label>
                            <input type="email"  class="form-control"  name="email" id="email" value="{{$competitionPayment->email}}">
                        </div>        
                        <div class="form-group mb-3">
                            <label for="track" class="col-form-label">Tranking Link<span class="text-danger">*</span></label>
                            <input type="url" class="form-control"  name="track" id="track" value="{{$competitionPayment->tracking_link}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="transfer_proof_wise" class="col-form-label">Transfer Proof</label>
                            <input type="file"  class="form-control"  name="transfer_proof_wise" id="transfer_proof_wise" accept="image/png,image/jpeg,image/jpg">    
                            <small class="text-danger "  style="font-size: 0.7em">Type: png,jpg, jpeg | max: 2MB</small>
                        </div>       
                        <a href="#" class="btn btn-outline-info rounded-pill mb-3" data-bs-toggle="modal" data-bs-target="#payment-proof" >View Current Proof</a>
                        <button type="submit" class="btn btn-outline-primary w-100 rounded-pill">Submit Payment Confirmation</button>
                    </div>
                </div>
            </form>
        </x-card>
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
            document.querySelector('input[name="email"]').removeAttribute('required');
            document.querySelector('input[name="track"]').removeAttribute('required');
        })
        wise.addEventListener('click', function(){
            type.value = "WISE";
            document.querySelector('input[name="payment_provider"]').value = "18";
            //set required untuk kolom inputan di wise dan remove required buat inputan yang di bank
            document.querySelector('input[name="email"]').setAttribute('required','');
            document.querySelector('input[name="track"]').setAttribute('required','');
            document.querySelector('input[name="account_name"]').removeAttribute('required');
            document.querySelector('input[name="account_number"]').removeAttribute('required');
            
        })
    </script>

    {{-- modal untuk menampilkan payment proof --}}
    <div class="modal fade p-4" id="payment-proof" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <img src="/storage/transfer_proof/{{$competitionPayment->payment_proof}}" class="img-fluid" alt="tf_proof">
        </div>
        </div>
    </div>
            
</x-user>

