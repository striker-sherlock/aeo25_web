<x-user title="Create Single">
    <div class="container mt-5">
        <h1 class="aeo-title">Step 3</h1>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">{{$competitionSlot->Competition->name}} Participant Registration</h3>

        <form action="{{route('competition-participants.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" hidden value="{{Auth::user()->id}}" name="pic_id">
            <input type="text" hidden value="{{$competitionSlot->id}}" name="competition_slot_id">
            <input type="text" hidden value="{{$competitionSlot->competition->id}}" name="competition_id">
            <input type="text" hidden value="{{$quantity}}" name="quantity">

            @for ($i = 1; $i <= $quantity; $i++)
                <x-card>
                    <h3 class="text-uppercase fw-bold" style="letter-spacing: 0.1em">{{$competitionSlot->competition->name}} Participant {{$i}}</h3>
                    <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="nama{{$i}}" class="col-form-label">Name<span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control"  name="nama[]" id="nama{{$i}}" value="{{old('nama.'.$i-1)}}" required>
                                    @if ($errors->has('nama.'.$i-1))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('nama.*') }}.</strong>
                                        </span>
                                    @endif
                                </div>    

                                <div class="form-group mb-3">
                                    <label for="email{{$i}}" class="col-form-label">Email Address<span class="text-danger">*</span></label>
                                    <input type="email"  class="form-control"  name="email[]" id="email{{$i}}" value="{{old('email.'.$i-1)}}" required>
                                    @if ($errors->has('email.'.$i-1))
                                    <span class="invalid feedback text-danger"role="alert">
                                        <strong>*{{ $errors->first('email.*') }}.</strong>
                                    </span>
                                @endif
                                </div>   
                                {{-- {{old('gender') ? dd(old('gender.0')):''}} --}}
                                <div class="form-group mb-2">
                                    <label for="gender{{$i-1}}" class="col-form-label">Gender<span class="text-danger">*</span></label>
                                    <select class="form-select"  name="gender[]" required id="gender{{$i-1}}">
                                        <option class="d-none">Select participant's gender</option>
                                        <option value="Male" {{old('gender.'.$i-1) == 'Male' ? 'selected':''}}>Male</option>
                                        <option value="Female" {{old('gender.'.$i-1) == 'Female' ? 'selected':''}}>Female</option>
                                    </select>
                                </div>  
                                <div class="form-group mb-3">
                                    <label for="additional_notes{{$i-1}}" class="col-form-label">Additional Notes</label>
                                    <textarea class="form-control text-area"  name="additional_notes[]"  id="additional_notes{{$i-1}}" rows="2">{{old('additional_notes.'.$i-1)}}</textarea>

                                    @if ($errors->has('additional_notes.'.$i-1))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('additional_notes.*') }}.</strong>
                                        </span>
                                    @endif 
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone{{$i}}" class="col-form-label">Phone Number (WA)<span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control"  name="phone[]" id="phone{{$i}}" value="{{old('phone.'.$i-1)}}" placeholder="" required>
                                    @if ($errors->has('phone.'.$i-1))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('phone.*') }}.</strong>
                                        </span>
                                    @endif 
                                </div>     
                            </div>   
                            <div class="col">
                       

                                <div class="form-group mb-3">
                                    <label for="birth{{$i}}" class="col-form-label">Date of Birth <span class="text-danger">*</span> <span class="text-muted">(yyyy-mm-dd)</span></label>
                                    <input type="text"  class="form-control"  name="birth[]" id="birth{{$i}}"  placeholder="e.g. 2022-10-12" required value="{{old('birth.'.$i-1)}}">
                                    @if ($errors->has('birth.'.$i-1))
                                    <span class="invalid feedback text-danger"role="alert">
                                        <strong>*{{ $errors->first('birth.*') }}.</strong>
                                    </span>
                                @endif

                                </div> 
                                <div class="form-group mb-2">
                                    <label for="vegetarian{{$i}}" class="col-form-label">Is This Participant Vegetarian ? <span class="text-danger">*</span></label>
                                    <select class="form-select"  name="vegetarian[]" id="vegetarian{{$i}}" required>
                                        <option selected class="d-none">choose...</option>
                                        <option value="1" {{old('vegetarian.'.$i-1) == '1' ? 'selected':''}}>Vegetarian</option>
                                        <option value="0" {{old('vegetarian.'.$i-1) == '0' ? 'selected':''}}>Non-Vegetarian</option>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="food_allergic{{$i}}" class="col-form-label">Does this participant have food allergic ? <span class="text-muted">(optional)</span></label>
                                    <input type="text"  class="form-control"  name="food_allergic[]" id="food_allergic{{$i}}" value="{{old('food_allergic.'.$i-1)}}" >
                                    @if ($errors->has('food_allergic.'.$i-1))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('food_allergic.*') }}.</strong>
                                        </span>
                                    @endif 
                                </div>    

                                <div class="form-group mb-3">
                                    <label for="profile_picture{{$i}}" class="col-form-label">Profile Picture<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control"  name="profile_picture[]" id="profile_picture{{$i}}" accept="image/png,image/jpeg,image/jpg" required>    
                                    <small class="text-danger"  style="font-size: 0.7em">Type : PNG, JPEG, JPG | Max : 2MB</small>
                                    @if ($errors->has('profile_picture.*'))
                                    <span class="invalid feedback text-danger"role="alert">
                                        <strong>*{{ $errors->first('profile_picture.*') }}.</strong>
                                    </span>
                                @endif
                                </div>       
                            </div> 
                            @if ($i == $quantity)
                                <button type="submit" class="btn btn-outline-theme w-100 rounded-pill">Register Participant</button>
                            @endif
                        </div>   
                </x-card>
            @endfor
        </form>
    </div>
</x-user>