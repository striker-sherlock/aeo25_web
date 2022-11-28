<x-admin>
    <div class="container mt-4">
              {{-- pending --}}
              <x-card>
                <h1 class="mb-3 text-warning fw-bold">Pending Accommodation Registration</h1>
                @if ($pending->count())
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
                                            <a href="{{route('accommodation-slot-registrations.edit', $accommodation->id)}}" class="btn btn-primary me-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{route('accommodation-slot-registrations.confirm', $accommodation->id)}}" class="btn btn-success me-2">
                                                <i class="fas fa-check-circle"></i>
                                            </a>
                                            <a href="{{route('accommodation-slot-registrations.reject', $accommodation->id)}}" class="btn btn-danger me-2">
                                                <i class="fas fa-times"></i>
                                            </a>
                                            
                                        </div>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else <hr><p class="text-center">No Data</p>
                @endif
            </x-card>
    
            {{-- confirmed --}}
            <x-card>
                <h1 class="mb-3 text-success fw-bold">Confirmed Accommodation Registration </h1>
                @if ($confirmed->count())
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
                                        <a href="{{route('accommodation-slot-registrations.edit', $accommodation->id)}}" class="btn btn-primary me-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('accommodation-slot-registrations.cancel',$accommodation->id)}}" class="btn btn-warning me-2">
                                            <i class="fas fa-undo" ></i>
                                        </a>
                                        <a href="{{route('accommodation-slot-registrations.reject', $accommodation->id)}}" class="btn btn-danger me-2">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <hr><p class="text-center">No Data</p>
                @endif
            </x-card>
    
            {{-- rejected --}}
            <x-card>
                <h1 class="mb-3 text-danger fw-bold" >Rejected Accommodation Registration</h1>
                    @if ($rejected->count())
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
                                        <a href="{{route('accommodation-slot-registrations.edit', $accommodation->id)}}" class="btn btn-primary me-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('accommodation-slot-registrations.cancel',$accommodation->id)}}" class="btn btn-warning me-2">
                                            <i class="fas fa-undo" ></i>
                                        </a>
                                    </div>
                                </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
</x-admin>