<x-user title="Accommodation Step One">
    <div class="container mt-5">
        <h1 class="aeo-title">Acoommodation - Step 1</h1>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Accommodation Slot Registration</h3>

        <hr>
        <x-card>
            <p class="fs-5">
                We highly suggest you to complete your payment once your registration has been confirmed. If 10 days have passed and the confirmed slot has not been paid yet, we will move your slot to the pending list again.
            </p>
        </x-card>
        {{--list informasi competition apa saja yang didaftar--}}
        <x-card>
            <h3 class="text-uppercase fw-bold  text-gradient mb-4" style="letter-spacing: 0.1em">Registered Accommodation Slot </h3>
            <a href="{{route('accommodation-slot-registrations.create')}}" class="btn btn-outline-theme rounded-pill">Book Our Accommodation</a>
            <hr>
            @if ($accommodationSlots->count())
                <div class="row">
                    @foreach ($accommodationSlots as $accommodationSlot)
                    <div class="col-lg-6">
                        <div class="row  m-2 py-4 border border-1 shadow-sm rounded-20 align-items-center" >
                            <div class="col-5">
                                <img src="/storage/images/accommodations/{{$accommodationSlot->accommodation->picture}}" alt="{{$accommodationSlot->accommodation->room_type}}" class="img-fluid mx-auto d-block w-100 rounded-20 shadow-sm" >
                            </div>
                            <div class="col-7   " >
                                <h4>{{$accommodationSlot->accommodation->room_type}} {{$accommodationSlot->quantity}} {{$accommodationSlot->quantity == 1 ? 'room':'room(s)'}}</h4>
                                <h4>Status :
                                    @if ($accommodationSlot->is_confirmed == 0 )<span class="text-warning fw-bold">Pending</span> 
                                    @elseif($accommodationSlot->is_confirmed == -1)<span class="text-danger fw-bold">Rejected</span>
                                    @else <span class="text-success fw-bold fs-5">Confirmed</span>  
                                    @endif
                                </h4>
                                @if ($accommodationSlot->is_confirmed == 0)
                                    <div class="d-flex justify-content-start ">
                                        <a href="{{ route('accommodation-slot-registrations.edit', $accommodationSlot->id) }}" data-bs-target="#edit{{$accommodationSlot->id}}" class="btn btn-outline-theme rounded-20 me-2 w-100">Edit Slot</a>

                                        <a href="#" data-bs-toggle ="modal" data-bs-target="#delete{{$accommodationSlot->id}}" class="btn btn-outline-danger rounded-20 w-100">Delete Slot</a>
                                    </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <p class="text-center fs-4 fw-bold">No Accommodation Booked</p>
            @endif
        </x-card>

        <h3 class="text-uppercase fw-bold  text-gradient mt-5 mb-3 text-center" style="letter-spacing: 0.1em"> Step Navigation </h3>
        <div class="navigasi mb-4 d-flex justify-content-center align-items-center py-1">
            <ul class="list-unstyled d-flex align-items-center">
                <li> <a href="{{route('dashboard')}}" class=" btn btn-outline-primary me-2">Main dashboard </a></li>
                <li> <a href="#" class="btn btn-outline-primary active me-2 ">1</a></li>
                <li> <a href="{{route('dashboard.accommodation-step', 2)}}" class="btn btn-outline-primary me-2">2</a></li>
                <li> <a href="{{route('dashboard.accommodation-step', 3)}}" class="btn btn-outline-primary me-2">3</a></li>
            </ul>
        </div>
    </div>

    @foreach ($accommodationSlots as $accommodationSlot)
        <div class="modal fade p-5" id="delete{{$accommodationSlot->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content rounded-20 border-0 shadow p-5">
                    <div class="modal-headers mb-4">
                        <span class="fa-stack fa-4x d-block mx-auto" >
                            <i class="fas fa-circle fa-stack-2x text-danger"></i>
                            <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="body mb-3">
                        <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete <span class="fw-bolder text-danger">{{$accommodationSlot->accommodation->room_type}}</span> ? </h1>
                        <p class="text-warning"> note: this action can't be undone  </p>
                    </div>
                    <div class="modal-footers">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary w-100"  data-bs-dismiss="modal">Back</button>
                            </div>
                            <div class="col">
                                <form method="POST" action="{{route('accommodation-slot-registrations.destroy',$accommodationSlot->id)}}">
                                <input type="hidden" name="_method" value = "DELETE">
                                    <button class="btn btn-outline-danger rounded w-100" title="delete">
                                        Delete
                                    </button>
                                @csrf
                                </form>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>  
        </div>  
    @endforeach
   
</x-user>