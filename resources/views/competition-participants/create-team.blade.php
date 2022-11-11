<x-admin>
    {{-- {{dd($quantity)}} --}}
    <div class="container mt-4">
        <h1 class="fs-3">Step 3</h1>
        <h2 class="display-5 fw-bold">Participant's Personal Detail</h2>
        <hr class="mb-4">

        <form action="{{route('competition-participants.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            @for ($i = $totalTeams; $i <= 2; $i++)
                {{-- @if ($competitionSlot->quantity <= $i )
                    @break
                @endif --}}
                <x-card>
                    <h3 class="text-center">
                        @if ($i == 0) 
                            TEAM A
                            <input type="text" name="team_name[]" value="Team A" hidden>
                        @elseif($i == 1)
                            TEAM B
                            <input type="text" name="team_name[]" value="Team B" hidden>
                        @else 
                            TEAM C
                            <input type="text" name="team_name[]" value="Team C" hidden>
                        @endif
                    </h3>
                    <hr>

                    <input type="text" value="{{$competitionSlot->competition->id}}" name="competition_id" hidden>
                    <input type="text" value="{{$competitionSlot->id}}" name="competition_slot_id" hidden>
                    <input type="text" value="{{$quantity}}" name="quantity" hidden>
                    
                    @for ($j = 0; $j <= 3; $j++)
                        @if ($competitionSlot->competition->id == 'DB' && $j == 2 )
                            <input type="text" hidden value="{{$j}}" name="team_participant[]">
                            @break
                        @endif
                        <h4>{{$competitionSlot->competition->name}}'s Participant {{$j+1}}</h4>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="nama" class="col-form-label">Name<span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control"  name="nama[]" id="nama" value="{{old('nama.'.$j)}}" required>
                                    @if ($errors->has('nama.'.$j))
                                    <span class="invalid feedback text-danger"role="alert">
                                        <strong>*{{ $errors->first('nama.*') }}.</strong>
                                    </span>
                                @endif
                                </div>    

                                <div class="form-group mb-3">
                                    <label for="email" class="col-form-label">Email Address<span class="text-danger">*</span></label>
                                    <input type="email"  class="form-control"  name="email[]" id="email" value="{{old('email.'.$j)}}" required>
                                    @if ($errors->has('email.'.$j))
                                    <span class="invalid feedback text-danger"role="alert">
                                        <strong>*{{ $errors->first('email.*') }}.</strong>
                                    </span>
                                @endif
                                </div>   
                                
                                <div class="form-group mb-2">
                                    <label for="payment_provider" class="col-form-label">Gender<span class="text-danger">*</span></label>
                                    <select class="form-select"  name="gender[]" required>
                                        <option selected class="d-none">Select participant's gender</option>
                                        <option value="{{'Male'}}" {{old('gender.'.$j) == 'Male' ? 'selected':''}}>Male</option>
                                        <option value="{{'Female'}}" {{old('gender.'.$j) == 'Female' ? 'selected':''}}>Female</option>
                                    </select>
                                </div>     

                            </div>   
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="phone" class="col-form-label">Phone Number (WA)<span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control"  name="phone[]" id="phone" value="{{old('phone.'.$j)}}" placeholder="" required>
                                    @if ($errors->has('phone.'.$j))
                                    <span class="invalid feedback text-danger"role="alert">
                                        <strong>*{{ $errors->first('phone.*') }}.</strong>
                                    </span>
                                @endif 
                                </div> 

                                <div class="form-group mb-3">
                                    <label for="phone" class="col-form-label">Date of Birth <span class="text-danger">*</span> <span class="text-muted">(yyyy-mm-dd)</span></label>
                                    <input type="text"  class="form-control"  name="birth[]" id="birth"  placeholder="e.g. 2022-10-12" required value="{{old('birth.'.$j)}}">
                                    @if ($errors->has('birth.'.$j))
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
                        </div> 
                        
                    @endfor
                    {{-- @if ($i == $quantity-1  ) --}}
                    <button type="submit" class="btn btn-outline-primary w-100 rounded-pill">Register Participant</button>
                    {{-- @endif --}}
                </x-card>
            @endfor
        </form>
    </div>
</x-admin>