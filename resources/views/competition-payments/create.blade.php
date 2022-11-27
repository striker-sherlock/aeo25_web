<x-user title="Competition Payment">
    <div class="container mt-5">
        <a href="{{route('dashboard.step',2)}}" class="btn btn-outline-theme rounded-pill mb-3">Go Back</a>
        <div class="row">
            <div class="col-md-6">
                <x-card>
                    <h5 class="fw-bold text-uppercase text-center">payment guide and invoice</h5>
                    <hr>
                    <p class="text-justify">Please download the file below to see the payment guide and your invoice by clicking "Download Invoice & Guide" button. After that, please fill the form.</p>
                    <div class="row">
                        <div class="col">
                            <a href="{{route('payments.invoice', [$user->id, $slotId])}}" target="_blank"
                                class="btn btn-outline-theme rounded-pill px-4 w-100 "><i class="fa-solid fa-download">&nbsp;</i>Download Invoice  
                            </a>  
                        </div>
                        <div class="col">
                            <a href="https://drive.google.com/file/d/1WHgLGWbyIHAXWJwbdGquc3i-RMQKgXUO/view" target="_blank"
                                class="btn btn-outline-theme rounded-pill px-4 w-100 "><i class="fas fa-file-invoice"></i> Download Guideline
                            </a>
                        </div>
                    </div>
                </x-card>
            </div>
            <div class="col-md-6">
                {{-- RECEIPT SUMMARY --}}
                <x-card>
                    <h5 class="text-uppercase fw-bold text-center text-gradient">Receipt Summary</h5><hr>
                    <div class="d-flex justify-content-between">
                        <h4>Competition</h4>
                        <h4>Price</h4>
                    </div>
                    {{-- ini jika pic ingin membayar semua sekaligus --}}
                    @if ($isPayAll == 1)
                        @foreach ($allCompetitions as $competition)
                            <div class="d-flex justify-content-between">
                                <h6>{{$competition->competition->name}} x {{$competition->quantity}} {{$competition->competition->need_team == 1 ? 'Team(s)' : 'People(s)'}}</h6>
                                <h6>{{ number_format($competition->competition->price * $competition->quantity, 2, ',', '.')}} IDR</h6>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h3>Grand Total</h3>
                            <h4>{{ number_format($totalPrice, 2, ',', '.')}} IDR</h4>
                        </div>

                    {{-- ini kondidi bila PIC ingin membayar slotnya 1 per 1  --}}
                    @else
                        <div class="d-flex justify-content-between">
                            <h6>{{$competitionSlot->competition->name}} x {{$competitionSlot->quantity}} {{$competitionSlot->competition->need_team == 1 ? 'Team(s)' : 'People(s)'}}</h6>
                            <h6>{{ number_format($totalPrice, 2, ',', '.')}} IDR</h6>
                        </div>

                        <hr>
                        
                        <div class="d-flex justify-content-between">
                            <h3>Grand Total</h3>
                            <h4>{{ number_format($totalPrice, 2, ',', '.')}} IDR</h4>
                        </div>
                    @endif
                    
                </x-card>
            </div>
        </div>
        <x-card>
            <h2 class="text-uppercase fw-bold">your payment details </h2>
            <p class="text-muted">Please Fill the Form Bellow</p>
            <hr> 
            <ul class="nav nav-pills d-flex justify-content-around mb-3">
                <li class=""><a data-bs-toggle="pill" href="#bank" class="btn btn-outline-primary rounded-pill me-3 d-block w-100 bank">Bank Transfer</a></li>

                <li class=""><a data-bs-toggle="pill" href="#wise" class="btn btn-outline-primary rounded-pill me-3 d-block w-100 wise"> <input type="radio" class="btn-check" autocomplete="off" value="wise" id="type"> Wise</a></li>
 
              
              </ul>
            <form action="{{route('competition-payments.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" value="{{Auth::user()->id}}" name="pic_id" hidden>
                <input type="text" value="{{$totalPrice}}" name="amount" hidden>
                <input type="text" name="type" hidden>
                
                <input type="text" name="isPayAll"  value="{{$isPayAll}}" hidden>
                <input type="text" name="competitionSlot"  value="{{ $competitionSlot == NULL ? '0' : $competitionSlot->id }}" hidden>


                <div class="tab-content">
                    <div id="bank" class="tab-pane fade">
                        <div class="form-group mb-2">
                            <label for="payment_provider" class="col-form-label">Bank Name<span class="text-danger">*</span></label>
                            <select class="form-select"  name="payment_provider">
                                <option selected class="d-none" disabled> Select Bank Name</option>
                                @foreach ($paymentProviders as $paymentProvider)
                                    <option value="{{$paymentProvider->id}}" {{old('payment_provider' == $paymentProvider->id? 'selected' : '')}}>{{$paymentProvider->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="account_name" class="col-form-label">Account Name<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="account_name" id="account_name" value="{{old('account_name')}}">
                        </div>        
                        <div class="form-group mb-3">
                            <label for="account_number" class="col-form-label">Account Number<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="account_number" id="account_number" value="{{old('account_number')}}">
                        </div>        
                
                        <div class="form-group mb-3">
                            <label for="transfer_proof_bank" class="col-form-label">Transfer Proof<span class="text-danger">*</span></label>
                            <input type="file" class="form-control"  name="transfer_proof_bank" id="transfer_proof_bank" accept="image/png,image/jpeg,image/jpg">    
                            <small class="text-danger"  style="font-size: 0.7em">Type: png,jpg, jpeg | max: 2MB</small>
                        </div>  
                        <button type="submit" class="btn btn-outline-theme w-100 rounded-pill">Submit Payment Confirmation</button>
                    </div>

                    {{-- WISE --}}
                    <div id="wise" class="tab-pane fade">
                        <div class="form-group mb-3">
                            <label for="email" class="col-form-label">Email Address<span class="text-danger">*</span></label>
                            <input type="email"  class="form-control"  name="email" id="email" value="{{old('email')}}">
                        </div>        
                        <div class="form-group mb-3">
                            <label for="track" class="col-form-label">Tranking Link<span class="text-danger">*</span></label>
                            <input type="url"  class="form-control"  name="track" id="track" value="{{old('track')}}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="transfer_proof_wise" class="col-form-label">Transfer Proof<span class="text-danger">*</span></label>
                            <input type="file"  class="form-control"  name="transfer_proof_wise" id="transfer_proof_wise" accept="image/png,image/jpeg,image/jpg">    
                            <small class="text-danger "  style="font-size: 0.7em">Type: png,jpg, jpeg | max: 2MB</small>
                        </div>       

                        <button type="submit" class="btn btn-outline-theme w-100 rounded-pill">Submit Payment Confirmation</button>
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
            type.value = "bank";

            //set required untuk bank dan remove required buat yang wise
            document.querySelector('input[name="account_name"]').setAttribute('required','');
            document.querySelector('input[name="account_number"]').setAttribute('required','');
            document.querySelector('input[name="email"]').removeAttribute('required');
            document.querySelector('input[name="track"]').removeAttribute('required');

            //reset value yang ada di wise
            document.querySelector('input[name="email"]').value = "";
            document.querySelector('input[name="track"]').value = "";
            document.querySelector('input[name="transfer_proof_wise"]').value = "";
        })
        wise.addEventListener('click', function(){
            type.value = "wise";
            //set required untuk kolom inputan di wise dan remove required buat inputan yang di bank
            document.querySelector('input[name="email"]').setAttribute('required','');
            document.querySelector('input[name="track"]').setAttribute('required','');
            document.querySelector('input[name="account_name"]').removeAttribute('required');
            document.querySelector('input[name="account_number"]').removeAttribute('required');
            
            //reset value inputan di bank tf
            document.querySelector('input[name="account_name"]').value = "";
            document.querySelector('input[name="account_number"]').value = "";
            document.querySelector('input[name="transfer_proof_bank"]').value = "";
            
        })
    </script>
</x-user >

