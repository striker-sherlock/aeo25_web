<x-admin>
    <div class="container mt-3">
        <h1 class="fs-2 mb-2">Step 3</h1>
        <h2 class="display-6 fw-bold">Competition Field's Participant Registration</h2>
        <hr class="mb-4">

        <form action="{{route('competition-participants.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" hidden value="{{Auth::user()->id}}" name="pic_id">
            <input type="text" hidden value="{{$competitionSlot->id}}" name="competition_slot_id">
            <input type="text" hidden value="{{$competitionSlot->competition->id}}" name="competition_id">

            @for ($i = 1; $i <= $quantity; $i++)
                <x-card>
                    <h3 class="text-uppercase fw-bold" style="letter-spacing: 0.1em">{{$competitionSlot->competition->name}} Participant {{$i}}</h3>
                    <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="nama" class="col-form-label">Name<span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control"  name="nama[]" id="nama" value="{{old('nama.'.$i-1)}}" required>
                                    {{-- @if ($errors->has('nama.'.$i-1))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('nama.*') }}.</strong>
                                        </span>
                                    @endif --}}
                                </div>    

                                <div class="form-group mb-3">
                                    <label for="email" class="col-form-label">Email Address<span class="text-danger">*</span></label>
                                    <input type="email"  class="form-control"  name="email[]" id="email" value="{{old('email.'.$i-1)}}" required>
                                    @if ($errors->has('email.'.$i-1))
                                    <span class="invalid feedback text-danger"role="alert">
                                        <strong>*{{ $errors->first('email.*') }}.</strong>
                                    </span>
                                @endif
                                </div>   
                                
                                <div class="form-group mb-2">
                                    <label for="payment_provider" class="col-form-label">Gender<span class="text-danger">*</span></label>
                                    <select class="form-select"  name="gender[]" required>
                                        <option selected class="d-none">Select participant's gender</option>
                                        <option value="{{'Male'}}" {{old('gender.'.$i) == 'Male' ? 'selected':''}}>Male</option>
                                        <option value="{{'Female'}}" {{old('gender.'.$i) == 'Female' ? 'selected':''}}>Female</option>
                                    </select>
                                </div>     
 
                            </div>   
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="phone" class="col-form-label">Phone Number (WA)<span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control"  name="phone[]" id="phone" value="{{old('phone.'.$i-1)}}" placeholder="" required>
                                    @if ($errors->has('phone.'.$i-1))
                                    <span class="invalid feedback text-danger"role="alert">
                                        <strong>*{{ $errors->first('phone.*') }}.</strong>
                                    </span>
                                @endif 
                                </div> 

                                <div class="form-group mb-3">
                                    <label for="phone" class="col-form-label">Date of Birth <span class="text-danger">*</span> <span class="text-muted">(yyyy-mm-dd)</span></label>
                                    <input type="text"  class="form-control"  name="birth[]" id="birth"  placeholder="e.g. 2022-10-12" required value="{{old('birth.'.$i-1)}}">
                                    @if ($errors->has('birth.'.$i-1))
                                    <span class="invalid feedback text-danger"role="alert">
                                        <strong>*{{ $errors->first('birth.*') }}.</strong>
                                    </span>
                                @endif
                                </div>  

                                <div class="form-group mb-3">
                                    <label for="profile_picture" class="col-form-label">Profile Picture<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control"  name="profile_picture[]" id="profile_picture" accept="image/png,image/jpeg,image/jpg" required>    
                                    <small class="text-danger"  style="font-size: 0.7em">Type: png,jpg, jpeg | max: 2MB</small>
                                    @if ($errors->has('profile_picture.*'))
                                    <span class="invalid feedback text-danger"role="alert">
                                        <strong>*{{ $errors->first('profile_picture.*') }}.</strong>
                                    </span>
                                @endif
                                </div>       
                            </div> 
                            @if ($i == $quantity)
                                <button type="submit" class="btn btn-outline-primary w-100 rounded-pill">Register Participant</button>
                            @endif
                        </div>   
                </x-card>
            @endfor
        </form>
    </div>
</x-admin>