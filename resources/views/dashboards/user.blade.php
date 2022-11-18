<x-admin>
    <div class="container mt-3">
        <div class="header">
            <h2 class="fw-bold ">Welcome back, PIC </h2>
            <h5 class="text-muted">Welcome to 2023 Asian English Olympics!</h5>
            <hr>
        </div>
        <div class="step-by-step row">
           {{-- {{dd($confirmedSlotRegistration->count(),$allSlotRegistration->count())}} --}}
            <div class="col-md-3">
                <a href="{{route('dashboard.step',1)}}" class="d-block text-decoration-none btn ">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 green-shadow" style="border-radius:20px">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 1</h2>
                            <h4>Confirmed Slot Registration </h4>
                            <h1 class="display-2 fw-bold {{$confirmedSlotRegistration->count()- $allSlotRegistration->count() == 0 ? 'text-success':'text-danger'}}">{{$confirmedSlotRegistration->count()}}<span class="fs-4">/{{$allSlotRegistration->count()}}</span> </h1>
            
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md-3">
                    <a href="{{route('dashboard.step',2)}}" class="d-block text-decoration-none btn" title="You must have at least 1 confirmed slot registration to move into this step">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 {{$confirmedSlotRegistration->count()-$allSlotRegistration->count()!=0 ||$confirmedSlotRegistration->count() == 0 ? 'red-shadow':'green-shadow'}}" style="border-radius:20px">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 2</h2>
                            @if (!$confirmedSlotRegistration->count())
                                <i class="fas fa-lock" style="font-size: 5em"></i>
                                <h4 class="mt-3 fw-bold">LOCKED</h4>
                            @else
                                <h4>Paid Slot Registration </h4>
                                <h1 class="display-2 fw-bold {{$confirmedPayment->count() - $allSlotRegistration->count() == 0 ? 'text-success' : 'text-danger'}}">{{$confirmedPayment->count()}}<span class="fs-4">/{{$allSlotRegistration->count()}}</span> </h1>
                            @endif
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{route('dashboard.step',3)}}" class="d-block text-decoration-none btn" title="You must have at least 1 confirmed payment slot to move into this step">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 red-shadow" style="border-radius:20px">
                        <div class="card-header bg-secondary"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 3</h2>
                            <i class="fas fa-lock" style="font-size: 5em"></i>
                            <h4 class="mt-3 fw-bold">LOCKED</h4>
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
        <h1 class="fw-bold display-5 mb-4">Our Event </h1>
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
        <hr>
        
        


    </div>
    
</x-admin>