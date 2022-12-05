<x-user title="Accommodation Step three">
    <div class="container mt-5 w-75">
        <h1 class="aeo-title">Accommodation - Step 3</h1>
        <h3 class="text-uppercase fs-2 fw-bold text-gradient mb-4" style="letter-spacing: 0.1em">Accommodation Guest Registration</h3>
        <x-card>
            {{-- <h3 class="text-uppercase fw-bold text-gradient mb-4" style="letter-spacing: 0.1em">Accommodation Guest Registration</h3> --}}
            @foreach ($accommodationSlots as $accommodationSlot)
                <div class="rounded-20 w-100 border border-1 shadow-sm my-4 ">
                    <div class="row align-items-center py-3 px-5">
                        <div class="col-sm-4  ">
                            <img src="/storage/images/accommodations/{{$accommodationSlot->accommodation->picture}}" alt="{{$accommodationSlot->accommodation->room_type}}" class="img-fluid mx-auto d-block w-100 rounded-20 shadow-sm mb-4" >    
                        </div> 
                        <div class="col-sm-8">
                            <h5 class="fs-5">{{$accommodationSlot->accommodation->room_type}}: <span class="fw-bold">{{$accommodationSlot->quantity}} room(s)</span></h5> 

                            <h5>Status:
                                @if ($accommodationSlot->accommodationGuest->count() > 0)
                                    <span class="fw-bold text-primary">Registered</span> <br>
                                    {{-- <a href="{{route('competition-participants.show',[Auth::user()->id,$accommodationSlot->competition->id])}}" class="btn btn-outline-info rounded-pill mt-2">View Participant</a> --}}
                                    
                                @elseif($accommodationSlot->accommodationPayment == NULL)
                                    <span class="fw-bold text-danger">Not Eligible (No Payment Yet)</span>

                                @elseif($accommodationSlot->accommodationPayment->is_confirmed != 1)
                                    <span class="fw-bold text-danger">Not Eligible (Wait for payment confirmation)</span>
                                    
                                @else
                                    <span class="fw-bold text-success">Eligible</span>
                                    <br>
                                    <a href="{{route('accommodation-guests.create',$accommodationSlot->id)}}" class="btn btn-outline-success rounded-pill mt-2">Add Guest</a>
                                
                                @endif
                              

                            </h5>

                        </div>
                    </div>
                </div>
            @endforeach
        </x-card>
        <h3 class="text-uppercase fw-bold  text-gradient mt-5 mb-3 text-center" style="letter-spacing: 0.1em"> Step Navigation </h3>
        <div class="navigasi mb-4 d-flex justify-content-center align-items-center py-1">
            <ul class="list-unstyled d-flex align-items-center">
                <li> <a href="{{route('dashboard')}}" class=" btn btn-outline-purple me-2">Main dashboard </a></li>
                <li> <a href="{{route('dashboard.accommodation-step',1)}}" class="btn btn-outline-primary me-2">1</a></li>
                <li> <a href="{{route('dashboard.accommodation-step', 2)}}" class="btn btn-outline-primary me-2">2</a></li>
                <li> <a href="#" class="btn btn-outline-primary active me-2 ">3</a></li>
            </ul>
        </div>
    </div>

</x-user>