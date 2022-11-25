<x-user title="step three">
    <div class="container mt-5">
        <h1 class="aeo-title">Step 3</h1>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Competition Participant Registration</h3>
        <x-card>
            <h3 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">Participant Registration</h3>
            <hr>
            <div class="row">
                @foreach ($competitionSlots as $competitionSlot)
                    <div class=" col-md-6 ">
                        <div class="row align-items-center py-3 rounded-20 w-100 border border-1 shadow-sm my-4 ">
                            <div class="col-md-4">
                                <img src="/storage/competition_logo/{{$competitionSlot->competition->logo}}" class="img-fluid" alt="{{$competitionSlot->competition->name}} logo">
                            </div> 
                            <div class="col-md-8">
                                <h5 class="fs-5">{{$competitionSlot->competition->name}}: <span class="fw-bold">{{$competitionSlot->quantity}} {{$competitionSlot->competition->need_team == 1 ? 'team(s)' : 'people(s)'}}</span></h5> 

                                <h5>Status:
                                    @if ($competitionSlot->competitionParticipants->count() > 0)
                                        <span class="fw-bold text-primary">Registered</span> <br>
                                        <a href="{{route('competition-participants.show',[Auth::user()->id,$competitionSlot->competition->id])}}" class="btn btn-outline-info rounded-pill mt-2">View    Participant</a>
                                        
                                    @elseif($competitionSlot->payment == NULL)
                                        <span class="fw-bold text-danger">Not Eligible (No Payment Yet)</span>

                                    @elseif($competitionSlot->payment->is_confirmed != 1)
                                        <span class="fw-bold text-danger">Not Eligible (Wait for payment confirmation)</span>
                                        
                                    @else
                                        <span class="fw-bold text-success">Eligible</span>
                                        <br>
                                        <a href="{{route('competition-participants.create',$competitionSlot->id)}}" class="btn btn-outline-success rounded-pill mt-2">Add Participant</a>
                                    
                                    @endif
                                

                                </h5>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </x-card>
    </div>

</x-user>