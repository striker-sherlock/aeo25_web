<x-admin>
    <div class="container mt-4">
              {{-- pending --}}
              <x-card>
                <h1 class="mb-3 text-warning">Pending Accommodation Registration</h1>
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
                                    <th>{{$accommodation->special_req}}</th>
                                    <th>{{$accommodation->quantity}}</th>
                                    <th class="m-auto"> 
                                        <div class="d-flex  justify-content-center">
                                            <a href="{{route('accommodation-slot-registrations.edit', $accommodation->id)}}" class="btn btn-primary btn-sm me-2">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="{{route('accommodation-slot-registrations.confirm', $accommodation->id)}}" class="btn btn-success btn-sm me-2">
                                                <i class="fas fa-check-circle"></i>
                                            </a>
                                            <a href="{{route('accommodation-slot-registrations.reject', $accommodation->id)}}" class="btn btn-danger btn-sm me-2">
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
                <h1 class="mb-3 text-success">Confirmed Accommodation Registration </h1>
                @if ($confirmed->count() != 0)
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
                              <th>{{$accommodation->special_req}}</th>
                              <th>{{$accommodation->quantity}}</th>
                                <th class="m-auto"> 
                                    <div class="d-flex justify-content-center">
                                        <a href="{{route('accommodation-slot-registrations.edit', $accommodation->id)}}" class="btn btn-primary btn-sm me-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('accommodation-slot-registrations.cancel',$accommodation->id)}}" class="btn btn-warning btn-sm me-2">
                                            <i class="fas fa-undo" ></i>
                                        </a>
                                        <a href="{{route('accommodation-slot-registrations.reject', $accommodation->id)}}" class="btn btn-danger btn-sm me-2">
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
                <h1 class="mb-3 text-danger">Rejected Accommodation Registration</h1>
                    @if ($rejected->count())
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
                            @foreach ($rejected as $accommodation)
                                <tr>
                                  {{-- <th>{{$accommodation->user->institution_name}}</th>
                                  <th>{{$accommodation->user->pic_name}}</th> --}}
                                  <th>{{$accommodation->accommodation->room_type}}</th>
                                  <th>{{$accommodation->check_in_date}}</th>
                                  <th>{{$accommodation->check_out_date}}</th>
                                  <th>{{$accommodation->special_req}}</th>
                                  <th>{{$accommodation->quantity}}</th>
                                  <th class="m-auto"> 
                                    <div class="d-flex justify-content-center">
                                        <a href="{{route('accommodation-slot-registrations.edit', $accommodation->id)}}" class="btn btn-primary btn-sm me-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('accommodation-slot-registrations.cancel',$accommodation->id)}}" class="btn btn-warning btn-sm me-2">
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

    </x-admin>