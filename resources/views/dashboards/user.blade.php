<x-admin>
    <div class="container mt-3">
        <div class="header">
            <h2 class="fw-bold ">Welcome back, PIC </h2>
            <h5 class="text-muted">Welcome to 2023 Asian English Olympics!</h5>
            <hr>
        </div>
        

        <div class="step-by-step row">
            <div class="col">
                <x-card>
                    <h4>Registration Slots</h4>
                    <a href="{{route('slot-registrations.create')}}" class="btn btn-outline-success rounded-pill btn-sm">Add New Slot</a>
                    <h1 class="display-2 fw-bold  ">11<span class="fs-4">/12</span> </h1>
                  
                     
                </x-card>
            </div>
            
            <div class="col">
                <x-card>
                    <h4 class="">Unpaid Slots</h4>
                    <a href=" " class="btn btn-outline-success rounded-pill btn-sm">Make Payment</a>
                    <h1 class="display-2 fw-bold">2</h1>
                    
                     
                </x-card>
            </div>
            <div class="col">
                <x-card>
                    <h4 class="">Total Participants</h4>
                    <a href=" " class="btn btn-outline-success rounded-pill btn-sm">Regist New Participant</a>
                    <h1 class="display-2 fw-bold">20</h1>
                  
                   
                </x-card>
            </div>
            <div class="col">
                <x-card>
                    <h4 class="">Total Submission</h4>
                    <a href=" " class="btn btn-outline-success rounded-pill btn-sm">Add Submission</a>
                    <h1 class="display-2 fw-bold">8<span class="fs-4">/12</span></h1>
                    <div class="d-flex justify-content-end px-3 mb-1">
                        {{-- <span style="font-size: 0.6em" class="fw-bold">100/600</span> --}}
                    </div>
                    {{-- <div class="progress ">
                        <div class="progress-bar" role="progressbar" style="width:50%;" aria-valuemin="0" aria-valuemax="100"> </div>
                    </div> --}}
                </x-card>
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