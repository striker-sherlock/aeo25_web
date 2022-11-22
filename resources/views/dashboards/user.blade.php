<x-admin>
    <div class="container mt-3">
        <div class="header">
            <h2 class="fw-bold ">Welcome back, PIC </h2>
            <h5 class="text-muted">Welcome to 2023 Asian English Olympics!</h5>
            <hr>
        </div>

        {{-- competition step  --}}
        <div class="step-by-step-compet row">
            <h3 class="text-uppercase fw-bold my-4" style="letter-spacing: 0.1em">Competition Step by step Registration</h3>
            <div class="col-md-3">
                <a href="{{route('dashboard.step',1)}}" class="d-block text-decoration-none btn ">
                    @php($totalSlot = $allSlotRegistration->count())
                    @php($confirmedRegistration = $confirmedSlotRegistration->count())
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 {{$totalSlot - $confirmedRegistration != 0 || $totalSlot == 0 ? 'red-shadow':'green-shadow'}}" style="border-radius:20px">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 1</h2>
                            <h4>Confirmed Slot Registration </h4>
                            <h1 class="display-3 fw-bold {{$confirmedSlotRegistration->count()- $allSlotRegistration->count() == 0 ? 'text-success':'text-danger'}}">{{$confirmedSlotRegistration->count()}}<span class="fs-4">/{{$allSlotRegistration->count()}}</span> </h1>
            
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3">
                    <a href="{{route('dashboard.step',2)}}" class="d-block text-decoration-none btn" title="You must have at least 1 confirmed slot registration to move into this step">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5
                    {{-- {{dd($confirmedSlotRegistration->count())}} --}}
                    {{$totalSlot - $confirmedPayment !=0 ||$confirmedPayment == 0 ? 'red-shadow':'green-shadow'}}" style="border-radius:20px">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 2</h2>
                            @if (!$confirmedSlotRegistration->count())
                                <i class="fas fa-lock" style="font-size: 5em"></i>
                                <h4 class="mt-3 fw-bold">LOCKED</h4>
                            @else
                                <h4>Paid Slot Registration </h4>
                                <h1 class="display-3 fw-bold {{$confirmedPayment - $allSlotRegistration->count() == 0 ? 'text-success' : 'text-danger'}}">{{$confirmedPayment}}<span class="fs-4">/{{$allSlotRegistration->count()}}</span> </h1>
                            @endif
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{route('dashboard.step',3)}}" class="d-block text-decoration-none btn" title="You must have at least 1 confirmed payment slot to move into this step">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 {{ $participantCompetition != 0 ? 'red-shadow':'green-shadow'}}" style="border-radius:20px">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 3</h2>
                            @if(!$confirmedPayment)
                                <i class="fas fa-lock" style="font-size: 5em"></i>
                                <h4 class="mt-3 fw-bold">LOCKED</h4>
                            @else
                                <h4>Total Participants Registered</h4>
                                <h1 class="display-3 fw-bold">{{$totalParticipants}}</h1>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{route('dashboard.step',2)}}" class="d-block text-decoration-none btn ">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 red-shadow" style="border-radius:20px">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 4</h2>
                            <i class="fas fa-lock" style="font-size: 5em"></i>
                            <h4 class="mt-3 fw-bold">LOCKED</h4>
                        </div>
                    </div>
                </a>
            </div>

        </div>
         
        <hr>
        {{-- accommodation step --}}
        <div class="step-by-step-accommodation row">
            <h3 class="text-uppercase fw-bold  my-4" style="letter-spacing: 0.1em">Accommodation Step By Step Registration</h3>
            <div class="col-md-4">
                @php($totalAccSlot = $allAccSlot->count())
                <a href="{{route('dashboard.accommodation-step',1)}}" class="d-block text-decoration-none btn ">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 {{$totalAccSlot - $confirmedAccSlot != 0 || $totalAccSlot == 0 ? 'red-shadow' : 'green-shadow'}}" style="border-radius:20px">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 1</h2>
                            <h4>Confirmed Accommodation Slot </h4>
                            <h1 class="display-3 fw-bold {{$totalAccSlot - $confirmedAccSlot != 0 || $totalAccSlot == 0 ? 'text-danger':'text-success'}}">{{$confirmedAccSlot}}<span class="fs-4">/{{$totalAccSlot}}</span> </h1>
            
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{route('dashboard.accommodation-step',2)}}" class="d-block text-decoration-none btn ">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 {{$totalAccSlot - $confirmedAccPayment != 0 || $totalAccSlot == 0 ? 'red-shadow' : 'green-shadow'}}" style="border-radius:20px">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 2</h2>
                            @if (!$confirmedAccPayment)
                                <i class="fas fa-lock" style="font-size: 5em"></i>
                                <h4 class="mt-3 fw-bold">LOCKED</h4>
                            @else
                                <h4>Paid Slot Registration </h4>
                                <h1 class="display-3 fw-bold {{$confirmedAccPayment - $totalAccSlot == 0 ? 'text-success' : 'text-danger'}}">{{$confirmedAccPayment}}<span class="fs-4">/{{$totalAccSlot}}</span> </h1>
                            @endif
            
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{route('dashboard.accommodation-step',3)}}" class="d-block text-decoration-none btn ">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 {{ $accGuests == 0 ? 'red-shadow':'green-shadow'}} " style="border-radius:20px">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 3</h2>
                            @if(!$confirmedAccPayment)
                                <i class="fas fa-lock" style="font-size: 5em"></i>
                                <h4 class="mt-3 fw-bold">LOCKED</h4>
                            @else
                                <h4>Total Guest Registered</h4>
                                <h1 class="display-3 fw-bold">{{$totalGuests}}</h1>
                            @endif
            
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- registration list --}}
        <x-card>
            <h3 class="text-uppercase fw-bold mb-3" style="letter-spacing: 0.1em">Your Slot Registration Summary</h3>
            @if ($allSlotRegistration->count())
                <table class="table table-bordered">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Competition Field</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Slot Status</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Participant</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($allSlotRegistration as $slot)
                        <tr class="text-center ">
                            <th>{{$slot->competition->name}}</th>
                            <th>{{$slot->quantity}} Slot(s)</th>
                            <th>
                                @if ($slot->is_confirmed == 0)
                                    <span class="text-warning fw-bold">Wait for Confirmation </span>
                                    @elseif ($slot->is_confirmed == 1)
                                    <span class="text-success fw-bold ">Confirmed {{\Carbon\Carbon::parse($slot->confirmed_at)->diffForHumans()}}</span>
                                    @else <span class="text-danger fw-bold">Rejected (check email for the reason)</span>
                                    @endif
                                </th>
                                
                                <th>
                                    @if ($slot->payment == NULL)
                                        <span href="{{route('dashboard.step',2)}}" class="text-danger fw-bold text-decoration-none" title="you have to finish the payment before d+10 days after the slot confirmation">No Payment Yet </span><br>
                                        @if ($slot->is_confirmed == 1)
                                            <a href="{{route('dashboard.step',2)}}" class="btn btn-outline-success  rounded-20">Make Payment</a>
                                        @endif
                                    @else 
                                        @if ($slot->payment->is_confirmed == 0)
                                            <span class="text-warning fw-bold">Wait for Confirmation</span>
                                        @elseif($slot->payment->is_confirmed == 1)
                                            <span class="text-success fw-bold">Confirmed</span><br>
                                            {{-- kasi payment reciept nya disini --}}
                                            <a href="#" class="btn btn-outline-info rounded-pill mt-2"> View Reciept</a>
                                        @else
                                            <span class="text-danger fw-bold">Rejected</span>
                                        @endif    
                                    @endif
                                </th>
                            <th> 
                                @if ($slot->competitionParticipants->count() > 0)
                                    <span class="fw-bold text-success">Registered</span> <br>
                                    <a href="{{route('competition-participants.show',[Auth::user()->id,$slot->competition->id])}}" class="btn btn-outline-info rounded-pill mt-2">View Participant</a>
                                @else
                                    <span class="fw-bold text-danger">No Participant Registered</span> <br>
                                    @if ($slot->payment != NULL)
                                       @if ($slot->payment->is_confirmed == 1)
                                       <a href="{{route('competition-participants.create',$slot->id)}}" class="btn btn-outline-success rounded-pill mt-2">Add Participant</a>    
                                       @endif
                                    @endif
                                @endif
                            </th>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="text-danger fw-bold">*Note : You must finish the payments D+10 days after the slot confirmed </p>
            @else <hr> 
                <p class="text-center fs-4">No Slot Registered Yet</p>
                <a href="{{route('slot-registrations.create')}}" class="d-block mx-auto btn btn-outline-primary rounded-pill w-50">Add New Registration Slot</a> 
            @endif

        </x-card>

        {{-- participant list --}}
        <x-card>
            <h3 class="text-uppercase fw-bold mb-3" style="letter-spacing: 0.1em">Your Participant List</h3>
            @if ($totalParticipants)
                <table class="table table-bordered data-table" >
                    <thead class="text-center">
                        <tr>
                            <th scope="col">Participant Name</th>
                            <th scope="col">Competition Field</th>
                            <th scope="col">Email</th>

                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($allParticipants as $participant)
                            <tr class="text-center ">
                                <th>{{$participant->name}}</th>
                                <th>{{$participant->competition->name}}</th>
                                <th>{{$participant->email}}</th>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
            @else 
            <hr><p class="text-center fs-4" >No Participant Registered Yet</p>
            @endif

        </x-card>


        {{-- event --}}
        {{-- <h1 class="fw-bold display-5 mb-4">Our Event </h1>
        <div class="event">
            <div class="row">
                <div class="col-md-8">
                    <div class="row ">
                        <div class="col-md-6">
                            <x-card>
                                
                            </x-card>
                        </div>
                        <div class="col-md-6">
                            <x-card>

                            </x-card>
                        </div>
                        <div class="col-md-6">
                            <x-card>

                            </x-card>
                        </div>
                        <div class="col-md-6">
                            <x-card>

                            </x-card>
                        </div>
                    </div>
                </div>
                <div class="upcomming-event col-md-4">
                    <x-card>
                        <h1>Upcoming Event</h1>
                        <hr>
                        <h4>Breaking Announcement</h4>
                        <div class="row ">
                            <div class="col-2 mb-2">
                                <span class="d-block rounded-pill bg-secondary" style="height:50px; width:50px;"> </span>
                            </div>    
                            <div class="col-10 d-flex align-items-center">
                                <h6>Anggrek, 808</h6>
                            </div>

                            <div class="col-2 mb-2">
                                <span class="d-block rounded-pill bg-secondary" style="height:50px; width:50px;"> </span>
                            </div>    
                            <div class="col-10 d-flex align-items-center">
                                <h6>Feb, 27 2022 </h6>
                            </div>

                            <div class="col-2 mb-2">
                                <span class="d-block rounded-pill bg-secondary" style="height:50px; width:50px;"> </span>
                            </div>    
                            <div class="col-10 d-flex align-items-center">
                                <h6>16.00 -> 20.00</h6>
                            </div>    
                        </div>       

                    </x-card>
                </div>
            </div>
        </div>
        <hr> --}}
        
        


    </div>
    
</x-admin>