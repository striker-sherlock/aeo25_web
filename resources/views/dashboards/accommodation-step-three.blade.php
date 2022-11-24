<x-user title="Accommodation Step three">
   {{-- {{dd($accommodationSlots[0]->payment)}} --}}
    <div class="container mt-3 w-75">
        <h1>Step 3</h1>
        <h2 class="display-6 fw-bold">Competition Field's Participant Registration</h2>
        <hr class="mb-4">
        <x-card>
            <h3>Accommodation Registration</h3>
            @foreach ($accommodationSlots as $accommodationSlot)
                <div class="rounded-20 w-100 border border-1 shadow-sm my-4 ">
                    <div class="row align-items-center py-3 px-5">
                        <div class="col-3  ">
                            <img src="/storage/images/accommodations/{{$accommodationSlot->accommodation->picture}}" alt="{{$accommodationSlot->accommodation->room_type}}" class="img-fluid mx-auto d-block w-100" >    
                        </div> 
                        <div class="col-9">
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
                                    <a href="{{route('accommodation-guests.create',$accommodationSlot->id)}}" class="btn btn-outline-success rounded-pill mt-2">Add Participant</a>
                                
                                @endif
                              

                            </h5>

                        </div>
                    </div>
                </div>
            @endforeach
        </x-card>
    </div>

</x-user>