<x-user title="Create Team">
    <div class="container mt-5">
        <h1 class="aeo-title">Step 3</h1>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">{{$competitionSlot->Competition->name}} Participant Registration</h3>
        <form action="{{route('competition-participants.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            @for ($i = $totalTeams; $i <= 2; $i++)
                @if ($competitionSlot->quantity + $totalTeams <= $i )
                    @break
                @endif
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
                     
                    @if ($competitionSlot->competition->id == 'RD')
                        <h6 class="text-danger fs-4">* Select the number of participant first</h6>
                        <input type="radio" class="btn-check" name="people{{$i}}" id="4peeps{{$i}}" autocomplete="off" value="4"  >
                        <label class="btn btn-outline-info mb-3" for="4peeps{{$i}}">4 people</label>

                        <input type="radio" class="btn-check" name="people{{$i}}" id="5peeps{{$i}}" autocomplete="off"   value="5">
                        <label class="btn btn-outline-info mb-3" for="5peeps{{$i}}" value="5">5 people</label>
                        
                    @endif

                    <input type="text" value="{{$competitionSlot->competition->id}}" name="competition_id" hidden>
                    <input type="text" value="{{$competitionSlot->id}}" name="competition_slot_id" hidden>
                    <input type="text" value="{{$quantity}}" name="quantity" hidden>
                    <input type="text" hidden value="{{$totalTeams}}" name="total_teams">
                    @for ($j = 0; $j <= 4; $j++)
                        @if ($competitionSlot->competition->id == 'DB' && $j == 2 )
                            <input type="text" hidden value="{{$j}}" name="team_participant[]">
                            @break
                         @endif
                        <div class="{{$competitionSlot->competition->id == 'RD' ? 'd-none' : ''}} form{{$i}}">
                            <div class="row shadow-sm   mb-5 p-4 rounded-20 {{old('people'.$i) == '4' && $j == 4 ? 'd-none' : ''}}" id="team{{$i}}participant{{$j}}">
                                <h3 class="text-uppercase fw-bold" style="letter-spacing: 0.1em">{{$competitionSlot->competition->name}}'s Participant {{$j+1}}</h3>

                                {{-- form registrasi --}}
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="nama{{$j}}{{$i}}" class="col-form-label">Name<span class="text-danger">*</span></label>
                                        <input type="text"  class="form-control"  name="nama[]" id="nama{{$j}}{{$i}}" value="{{old('nama.'.$j+($i-$totalTeams)*5)}}" required>
                                        @if ($errors->has('nama.'.$j+($i-$totalTeams)*5))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('nama.*') }}.</strong>
                                        </span>
                                    @endif
                                    </div>    
    
                                    <div class="form-group mb-3">
                                        <label for="email{{$j}}{{$i}}" class="col-form-label">Email Address<span class="text-danger">*</span></label>
                                        <input type="email"  class="form-control"  name="email[]" id="email{{$j}}{{$i}}" value="{{old('email.'.$j+($i-$totalTeams)*5)}}" required>
                                        @if ($errors->has('email.'.$j+($i-$totalTeams)*5))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('email.*') }}.</strong>
                                        </span>
                                    @endif
                                    </div>   
                                    
                                    <div class="form-group mb-2">
                                        <label for="gender{{$j}}{{$i}}" class="col-form-label">Gender<span class="text-danger">*</span></label>
                                        <select class="form-select"  name="gender[]" id="gender{{$j}}{{$i}}" required>
                                            <option selected class="d-none">Select participant's gender...</option>
                                            <option value="Male" {{old('gender.'.$j+($i-$totalTeams)*5) == 'Male' ? 'selected':''}}>Male</option>
                                            <option value="Female" {{old('gender.'.$j+($i-$totalTeams)*5) == 'Female' ? 'selected':''}}>Female</option>
                                        </select>
                                    </div>  
                                    
                                    <div class="form-group mb-3">
                                        <label for="additional_notes{{$j}}{{$i}}" class="col-form-label">Additional Notes</label>
                                        <textarea class="form-control text-area"  name="additional_notes[]"  id="additional_notes{{$j}}{{$i}}" rows="2">{{old('additional_notes.'.$j+($i-$totalTeams)*5)}}</textarea>

                                        @if ($errors->has('additional_notes.'.$j+($i-$totalTeams)*5))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('additional_notes.*') }}.</strong>
                                        </span>
                                    @endif 
                                    </div>   
    
                                </div>   
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label for="phone{{$j}}{{$i}}" class="col-form-label">Phone Number (WA)<span class="text-danger">*</span></label>
                                        <input type="text"  class="form-control"  name="phone[]" id="phone{{$j}}{{$i}}" value="{{old('phone.'.$j+($i-$totalTeams)*5)}}" placeholder="" required >
                                        @if ($errors->has('phone.'.$j+($i-$totalTeams)*5))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('phone.*') }}.</strong>
                                        </span>
                                    @endif 
                                    </div> 
    
                                    <div class="form-group mb-3">
                                        <label for="birth{{$j}}{{$i}}" class="col-form-label">Date of Birth <span class="text-danger">*</span> <span class="text-muted">(yyyy-mm-dd)</span></label>
                                        <input type="text"  class="form-control"  name="birth[]" id="birth{{$j}}{{$i}}"  placeholder="e.g. 2022-10-12" value="{{old('birth.'.$j+($i-$totalTeams)*5)}}" required>
                                        @if ($errors->has('birth.'.$j+($i-$totalTeams)*5))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('birth.*') }}.</strong>
                                        </span>
                                    @endif
                                    </div>

                                    <div class="form-group mb-2">
                                        <label for="vegetarian{{$j}}{{$i}}" class="col-form-label">Is This Participant Vegetarian ? <span class="text-danger">*</span></label>
                                        <select class="form-select"  name="vegetarian[]" id="vegetarian{{$j}}{{$i}}" required>
                                            <option selected class="d-none">choose...</option>
                                            <option value="1" {{old('vegetarian.'.$j+($i-$totalTeams)*5) == '1' ? 'selected':''}}>Vegetarian</option>
                                            <option value="0" {{old('vegetarian.'.$j+($i-$totalTeams)*5) == '0' ? 'selected':''}}>Non-Vegetarian</option>
                                        </select>
                                    </div>     
    
                                    <div class="form-group mb-3">
                                        <label for="profile_picture{{$j}}{{$i}}" class="col-form-label">Profile Picture<span class="text-danger">*</span></label>
                                        <input type="file" class="form-control"  name="profile_picture[]" id="profile_picture{{$j}}{{$i}}" accept="image/png,image/jpeg,image/jpg" required>     
                                        <small class="text-danger" style="font-size: 0.7em">Type: png,jpg, jpeg | max: 2MB</small>
                                        @if ($errors->has('profile_picture.'.$j+($i-$totalTeams)*5))
                                        <span class="invalid feedback text-danger"role="alert">
                                            <strong>*{{ $errors->first('profile_picture.*') }}.</strong>
                                        </span>
                                    @endif
                                    </div>       
                                </div> 
                            </div> 
                        </div>
                    @endfor
                
                    @if ($i == $quantity+$totalTeams-1  )
                        <button type="submit" class="{{$competitionSlot->competition->id == 'DB' ? '' : ' d-none'}} btn btn-outline-theme w-100 rounded-pill">Register Participant</button>
                    @endif
                </x-card>
            @endfor
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $('input[type="radio"]').change(function(){
            if( $('input[type="radio"]').is(':checked') ){
                $('button[type="submit"]').removeClass('d-none');
            }
            let variable = ($(this).attr('id'));
            let teamName = variable[variable.length-1];
            let numberOfParticipant = variable[0]
            if (teamName == 0){
                $('.form0').removeClass('d-none');
                let participant = $('#team0participant4');
                if (numberOfParticipant == 4){
                    participant.addClass('d-none');
                    $('#team0participant4 input').attr('required',false);
                    $('#team0participant4 select').attr('required',false);
                }
                if (numberOfParticipant == 5){
                    participant.removeClass('d-none');
                    $('#team0participant4 input').attr('required',true);
                    $('#team0participant4 select').attr('required',false);
                }
            }
            else if (teamName == 1){
                $('.form1').removeClass('d-none');
                let participant = $('#team1participant4');
                if (numberOfParticipant == 4){
                   participant.addClass('d-none');
                   $('#team1participant4 input').attr('required',false);
                   $('#team1participant4 select').attr('required',false);
                }
                if (numberOfParticipant == 5){
                    participant.removeClass('d-none');
                    $('#team1participant4 input').attr('required',true);
                    $('#team1participant4 select').attr('required',true);
                };
            }
            else{
                $('.form2').removeClass('d-none');
                let participant = $('#team2participant4');
                if (numberOfParticipant == 4){
                   participant.addClass('d-none');
                   $('#team2participant4 input').attr('required',false);
                   $('#team2participant4 select').attr('required',false);
                }
                if (numberOfParticipant == 5){
                    participant.removeClass('d-none');
                    $('#team2participant4 input').attr('required',true);
                    $('#team2participant4 select').attr('required',true);
                };
            };
        })
    </script>
</x-user>