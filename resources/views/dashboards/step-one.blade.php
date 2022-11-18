<x-admin>
    <div class="container mt-4">
        <h1>Step 1</h1>
        <h2 class="display-6 fw-bold">Competition Field Slot Registration</h2>
        <hr>
        <x-card>
            <p class="fs-5">
                We highly suggest you to complete your payment once your registration has been confirmed. If 10 days have passed and the confirmed slot has not been paid yet, we will move your slot to the pending list again.
            </p>
        </x-card>
        {{--list informasi competition apa saja yang didaftar--}}
        <x-card>
            <h3>Registered Competition's Slot</h3>
            <a href="{{route('slot-registrations.create')}}" class="btn btn-outline-primary rounded-pill">Add New Registration Slot</a>    
            <hr>
            @if ($competitionSlots->count())
            <div class="row">
                @foreach ($competitionSlots as $competitionSlot)
                    <div class="col-lg-6">
                        <div class="row  m-2 py-4 border border-1 shadow-sm rounded-20 align-items-center" >
                            <div class="col-4">
                                {{-- logo competition --}}
                                <img src="/storage/competition_logo/{{$competitionSlot->competition->logo}}" class="img-fluid" alt="{{$competitionSlot->competition->name}} logo">
                            </div>
                            <div class="col-8" >
                                <h4>{{$competitionSlot->competition->name}} {{$competitionSlot->quantity}} {{$competitionSlot->competition->need_team == 1 ? 'team(s)':'person(s)'}}</h4>
                                <h4>Status :
                                    @if ($competitionSlot->is_confirmed == 0 )<span class="text-warning fw-bold">Pending</span> 
                                    @elseif($competitionSlot->is_confirmed == -1)<span class="text-danger fw-bold">Rejected</span>
                                    @else <span class="text-success fw-bold fs-5">Confirmed</span>  
                                    @endif
                                </h4>
                                @if ($competitionSlot->is_confirmed != 1)
                                <div class="d-flex justify-content-start ">
                                    <a href="#" data-bs-toggle ="modal" data-bs-target="#edit{{$competitionSlot->id}}" class="btn btn-outline-primary rounded-20 me-2">Edit Slot</a>
                                            <a href="#" data-bs-toggle ="modal" data-bs-target="#delete{{$competitionSlot->id}}" class="btn btn-outline-danger rounded-20">Delete Slot</a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                @endforeach
            </div>

            @else
           
            <p class="text-center text-warning  fs-3" >You don't have SLOT REGISTERED yet</p><br>
       
            @endif
        </x-card>
        
        <h5 class="text-center fs-4 fw-bold">Step Navigation</h5>
        <div class="navigasi  mb-4 d-flex justify-content-center align-items-center py-1">
            <ul class="list-unstyled d-flex align-items-center">
                <li> <a href="#" class="btn btn-outline-primary active me-2 ">1</a></li>
                <li> <a href="{{route('dashboard.step',2)}}" class="btn btn-outline-primary me-2">2</a></li>
                <li> <a href="{{route('dashboard.step',3)}}" class="btn btn-outline-primary me-2">3</a></li>
            </ul>
        </div>
    </div>

    @foreach ($competitionSlots as $competitionSlot)
        <div class="modal fade p-5" id="edit{{$competitionSlot->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content rounded-20 border-0 shadow p-5">
                    <div class="modal-headers mb-4">
                        <span class="fa-stack fa-4x d-block mx-auto" >
                            <i class="fas fa-circle fa-stack-2x text-danger"></i>
                            <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <form action="{{route('slot-registrations.update',$competitionSlot->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="body mb-3">
                            <h1 class="fw-bold fs-3 text-center" >Edit your <span class="text-primary">{{$competitionSlot->competition->name}}</span> slot</h1>
                            <p class="fs-5 fw-bold text-center">Choose {{$competitionSlot->competition->need_team == 1 ? 'team':'person'}} quantity</p>

                            <div class="mx-auto text-center">
                                @php ($slot = 3)
                                @if ($slot > $competitionSlot->competition->temp_quota) 
                                    @php($slot = $competitionSlot->competition->temp_quota)
                                @endif  
                                @for($i=1 ; $i <= $slot; $i++ )
                                    <input type="radio" class="btn-check" name="quantity" id="{{$competitionSlot->id.$i}}"  value="{{$i}}" {{$i == $competitionSlot->quantity ? 'checked' : ''}}>
                                    <label class="btn btn-outline-secondary" for="{{$competitionSlot->id.$i}}"  >{{$i}}</label>
                                @endfor 
                            </div>
                        </div>
                        <div class="footer">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-outline-secondary w-100"  data-bs-dismiss="modal">Cancel</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-outline-primary w-100">Confirm Edit</button>
                                </div>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    @endforeach

    @foreach ($competitionSlots as $competitionSlot)
        <div class="modal fade p-5" id="delete{{$competitionSlot->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content rounded-20 border-0 shadow p-5">
                    <div class="modal-headers mb-4">
                        <span class="fa-stack fa-4x d-block mx-auto" >
                            <i class="fas fa-circle fa-stack-2x text-danger"></i>
                            <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="body mb-3">
                        <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete <span class="fw-bolder text-danger">{{$competitionSlot->competition->name}}</span> ? </h1>
                        <p class="text-warning"> note: this action can't be undone  </p>
                    </div>
                    <div class="footer">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary w-100"  data-bs-dismiss="modal">Back</button>
                            </div>
                            <div class="col">
                                <form method="POST" action="{{route('slot-registrations.destroy',$competitionSlot->id)}}">
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
</x-admin>