<x-user title="Show Participant">
    <div class="container mt-5 mb-4">
        <h1 class="aeo-title">Step 3</h1>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Competition Participant Details</h3>
        @foreach ($competitionParticipants as $index => $participant)
            <x-card>
                <h3 class="text-uppercase fw-bold fs-4 text-capitalize" style="letter-spacing: 0.1em">{{$participant->competition->name}} participant information - {{$index+1}}</h3>
                <a  class="btn btn-outline-theme btn rounded-pill" data-bs-toggle="modal" data-bs-target="#note{{$participant->id}}">Add Additional Note (optional) </a>
                
                @if ($participant->team_id)
                    <div class="form-group mb-3">
                        <label for="" class="col-form-label">Team Name </label>
                        <input type="text"  class="form-control" id="team{{$index}}" value="{{$participant->competitionTeam->name}}" disabled>
                    </div>
                @endif

                <div class="row align-items-center justify-content-center mt-4">
                    <div class="col-md-4  ">
                        <img src="/storage/profile_picture/{{$participant->competition->id}}/{{$participant->profile_picture}}" class="img-fluid d-block mx-auto w-100" alt="profile picture">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="name{{$index}}" class="col-form-label">Participant Name </label>
                            <input type="text"  class="form-control" id="name{{$index}}" value="{{$participant->name}}" disabled>
                        </div>

                        <div class="form-group mb-3">
                            <label for="birth{{$index}}" class="col-form-label"> Date Of Birth </label>
                            <input type="text"  class="form-control" id="birth{{$index}}" value="{{$participant->birth_date}}" disabled>
                        </div> 
                        <div class="form-group mb-3">
                            <label for="gender{{$index}}" class="col-form-label"> Gender </label>
                            <input type="text"  class="form-control" id="gender{{$index}}" value="{{$participant->gender}}" disabled>
                        </div> 

                    </div>
                    <div class="col-md-4">
              

                        <div class="form-group mb-3">
                            <label for="email{{$index}}" class="col-form-label"> Email </label>
                            <input type="text"  class="form-control" id="email{{$index}}" value="{{$participant->email}}" disabled>
                        </div> 
                        <div class="form-group mb-3">
                            <label class="col-form-label"> Phone Number </label>
                            <input type="text"  class="form-control" value="{{$participant->phone_number}}" disabled>
                        </div> 
                        <div class="form-group mb-3">
                            <label class="col-form-label">Vegetarian </label>
                            <input type="text"  class="form-control" value="{{$participant->is_vegetarian == 1 ? 'vegetarian':'Non Vegetarian'}}" disabled>
                        </div> 
                        
                    </div>
                </div>
            </x-card>
        @endforeach
    </div>
    {{-- modal untuk notes --}}
    @foreach ($competitionParticipants as $participant)
        <div class="modal fade p-4" id="note{{$participant->id}}" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-headers p-4 ">
                    <h5 class="modal-title text-center fs-2" >Add Additional Note to <span class="fw-bold text-info text-capitalize">{{$participant->name}}</span></h5>
                </div>
                <form action="{{route('competition-participants.update',$participant->id)}}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <textarea class="form-control text-area" name="note"  id="note" rows="2">{{$participant->additional_notes}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footers p-4">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-outline-theme w-100">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    @endforeach
</x-user>