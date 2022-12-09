<x-admin>
    <div class="container mt-4">
        {{-- pending --}}
        <x-card>
        <h1 class="mb-3 text-warning fw-bold">Pending Accommodation Registration</h1>
        @if ($pending->count())
        <div class="table-responsive py-2">
            <table class="table table-striped table-bordered dataTables">
                <thead class="text-center">
                <tr>
                    <th scope="col">Institution Name</th>
                    <th scope="col">PIC Name</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Check in Date</th>
                    <th scope="col">Check Out Date</th>
                    <th scope="col">Special Request</th>
                    <th scope="col">Total Room</th>
                    <th scope="col">Action </th>
                </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($pending as $accommodation)
                        <tr>
                            <th>{{$accommodation->user->institution_name}}</th>
                            <th>{{$accommodation->user->pic_name}}</th>
                            <th>{{$accommodation->accommodation->room_type}}</th>
                            <th>{{$accommodation->check_in_date}}</th>
                            <th>{{$accommodation->check_out_date}}</th>
                            <th> 
                                @if ($accommodation->special_req)
                                    <a href="#" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#req{{$accommodation->id}}">
                                        <i class="fa-solid fa-exclamation text-"></i>
                                    </a>
                                @else
                                    No Special Request
                                @endif
                            </th>
                            <th>{{$accommodation->quantity}}</th>
                            <th class="m-auto"> 
                                <div class="d-flex  justify-content-center">
                                    <a href="{{route('accommodation-slot-registrations.edit', $accommodation->id)}}" class="btn btn-primary me-2" title="edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#confirm{{$accommodation->id}}" class="btn btn-success me-2" title="confirm">
                                        <i class="fas fa-check-circle"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#reason{{$accommodation->id}}" class="btn btn-danger me-2" title="reject">
                                        <i class="fas fa-times"></i>
                                    </a>
                                    
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            @else <hr><p class="text-center">No Data</p>
        @endif
    </x-card>

    {{-- confirmed --}}
    <x-card>
        <h1 class="mb-3 text-success fw-bold">Confirmed Accommodation Registration (Unpaid)</h1>
        @if ($confirmed->count())
        <div class="table-responsive py-2">
            <table class="table table-striped table-bordered">
                <thead class="text-center">
                <tr>
                    <th scope="col">Institution Name</th>
                    <th scope="col">PIC Name</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Check in Date</th>
                    <th scope="col">Check Out Date</th>
                    <th scope="col">Special Request</th>
                    <th scope="col">Total Room</th>
                    <th scope="col">Action </th>
                </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($confirmed as $accommodation)
                        <tr>
                            <th>{{$accommodation->user->institution_name}}</th>
                            <th>{{$accommodation->user->pic_name}}</th>
                            <th>{{$accommodation->accommodation->room_type}}</th>
                            <th>{{$accommodation->check_in_date}}</th>
                            <th>{{$accommodation->check_out_date}}</th>
                            <th> 
                            @if ($accommodation->special_req)
                                <a href="#" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#req{{$accommodation->id}}">
                                    <i class="fa-solid fa-exclamation text-"></i>
                                </a>
                            @else
                                No Special Request
                            @endif
                        </th>
                            <th>{{$accommodation->quantity}}</th>
                            <th class="m-auto"> 
                                <div class="d-flex justify-content-center">
                                    <a href="{{route('accommodation-slot-registrations.edit', $accommodation->id)}}" class="btn btn-primary me-2" title="edit ">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{route('accommodation-slot-registrations.cancel',$accommodation->id)}}" class="btn btn-warning me-2" title="move to pending">
                                        <i class="fas fa-undo" ></i>
                                    </a>
                                
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <hr><p class="text-center">No Data</p>
        @endif
    </x-card>

    {{-- rejected --}}
    <x-card>
        <h1 class="mb-3 text-danger fw-bold" >Rejected Accommodation Registration</h1>
            @if ($rejected->count())
            <div class="table-responsive py-2">
                <table class="table table-striped table-bordered">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Institution Name</th>
                        <th scope="col">PIC Name</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Check in Date</th>
                        <th scope="col">Check Out Date</th>
                        <th scope="col">Total Room</th>
                        <th scope="col">Action </th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($rejected as $accommodation)
                            <tr>
                                <th>{{$accommodation->user->institution_name}}</th>
                                <th>{{$accommodation->user->pic_name}}</th>
                                <th>{{$accommodation->accommodation->room_type}}</th>
                                <th>{{$accommodation->check_in_date}}</th>
                                <th>{{$accommodation->check_out_date}}</th>
                                <th>{{$accommodation->quantity}}</th>
                                <th class="m-auto"> 
                                <div class="d-flex justify-content-center">
                                    <a href="{{route('accommodation-slot-registrations.edit', $accommodation->id)}}" class="btn btn-primary me-2"  title="edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{route('accommodation-slot-registrations.cancel',$accommodation->id)}}" class="btn btn-warning me-2">
                                        <i class="fas fa-undo" title="move to pending"></i>
                                    </a>
                                </div>
                            </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </div>
    </x-card>
    
    
    {{-- modal untuk special request --}}
    @foreach ($accommodations as $accommodation)
        <div class="modal fade p-5" id="req{{$accommodation->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content rounded-20 border-0 shadow p-5">
                    <div class="modal-headers mb-4">
                        <h5 class="aeo-title">{{$accommodation->accommodation->room_type}} Room  </h5>
                        <h4 class="text-uppercase fw-bold text-gradient mb-4" style="letter-spacing: 0.1em">{{$accommodation->user->pic_name}}'s Special Request </h4>
                        <hr>
                    </div>
                    <div class="body mb-3">
                         {!!$accommodation->special_req!!}
                    </div>
                    <div class="modals-footer">
                        <button type="button" class="btn btn-outline-secondary w-100 rounded-pill"  data-bs-dismiss="modal">Back</button>
                    </div>
                </div>  
            </div>
        </div> 
    @endforeach

    {{-- modal untuk confirm --}}
    @foreach ($pending as $accommodationSlot)
        <div class="modal fade p-4" id="confirm{{$accommodationSlot->id}}" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-headers p-4 "></div>
                <div class="body px-4">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 mb-3 text-center">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-success"></i>
                                <i class="fas fa-check fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="col-12 my-2 text-center">
                            <h2 class="fw-bold mb-2 text-success">Acocommodation Slot Confirmation</h2>
                            <h4 class="font-weight-bold">Are you sure want to confirm <span class="fw-bold">{{$accommodationSlot->user->pic_name}}'s</span> slot ? </h4>
                        </div>
                    </div>

                    <input type="text" name="slot" value="{{$accommodationSlot->id}}" hidden>
                </div>
                <div class="modal-footers p-4   mb-5">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary w-100 rounded-pill" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="col">
                            <a href="{{route('accommodation-slot-registrations.confirm', $accommodationSlot->id)}}" class="btn btn-outline-success w-100 rounded-pill" >
                                Confirm 
                            </a>
                        </div>
                    </div>
                </div>
                 
            </div>
            </div>
        </div>
    @endforeach

    {{-- modal untuk reject --}}
    @foreach ($pending as $slot)
        <div class="modal fade p-4" id="reason{{$slot->id}}" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-headers p-4 ">
                    <h5 class="modal-title text-center fs-2" >Are you sure want to reject ?</h5>
                </div>
                <form action="{{route('accommodation-slot-registrations.reject')}}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-gruop mb-3">
                            <label for="reason" class="col-form-label">State The Reason<span class="text-danger">*</span></label>
                            <textarea class="form-control text-area" name="reason"  id="reason" rows="3"></textarea>
                        </div>

                        <input type="text" name="slot" value="{{$slot->id}}" hidden>
                    </div>
                    <div class="modal-footers p-4">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-outline-danger w-100">Reject</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        
    @endforeach
</x-admin>