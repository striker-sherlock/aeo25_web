<x-user title="step three">
    <div class="container mt-5">
        <h1 class="aeo-title">Step 3</h1>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Competition Participant Registration</h3>
        <x-card>
            <h3 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">Participant Registration</h3>
            <hr>
            <div class="row">
                @foreach ($competitionSlots as $competitionSlot)
                    @if($competitionSlot->is_confirmed != 1) @continue @endif
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
                                
                                       <div class="row">
                                            <div class="col">
                                                <a href="{{route('competition-participants.show',[Auth::user()->id,$competitionSlot->competition->id])}}" class="btn btn-outline-info rounded-pill mt-2 mb-2 w-100" style="font-size: 0.7em"> <i class="fa fa-eye "></i> View Participant</a>  
                                            </div>
                                            
                                            @if ($competitionSlot->competition->whatsapp_group != NULL)
                                                <div class="col">
                                                    <a href="{{$competitionSlot->competition->whatsapp_group}}" class="btn btn-outline-success rounded-pill mt-2 w-100" style="font-size: 0.7em"> <i
                                                        class="fab fa-whatsapp me-2 fa-lg"></i> Join Group </a>  

                                                </div>
                                            @endif
                                       </div>

                                        
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

        <h5 class="text-center fs-4 fw-bold">Step Navigation</h5>
        <div class="navigasi  mb-4 d-flex justify-content-center align-items-center py-1">
            <ul class="list-unstyled d-flex align-items-center">
                <li> <a href="{{route('dashboard')}}" class=" btn btn-outline-purple me-2">Main dashboard </a></li>
                <li> <a href="{{route('dashboard.step',1)}}" class=" btn btn-outline-primary me-2">1</a></li>
                <li> <a href="{{route('dashboard.step',2)}}" class="btn btn-outline-primary me-2">2</a></li>
                <li> <a href="#" class="btn btn-outline-primary me-2 active">3</a></li>
            </ul>
        </div>

    </div>

</x-user>