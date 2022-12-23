<x-admin>
    <div class="container mt-4">
      <x-card>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Flight List</h3>
        <a href="{{route('flight-tickets.export', 'DEPARTURE')}}" class="btn btn-outline-theme mb-3">Download Departure Excel</a>
        <a href="{{route('flight-tickets.export', 'ARRIVAL')}}" class="btn btn-outline-theme mb-3">Download Arrival Excel</a>
          <div class="table-responsive py-2">
              <table class="table table-sm table-striped table-bordered no-footer" id="dataTables">
                <thead class="table-info">
                  <tr>
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Name</th>
                    <th class="align-middle text-center">Contact</th>
                    <th class="align-middle text-center">Email</th>
                    <th class="align-middle text-center">Type</th>
                    <th class="align-middle text-center">Airline Name</th>
                    <th class="align-middle text-center">Flight Time</th>
                    <th class="align-middle text-center">Action</th>
                  </tr>
                </thead>
                  <tbody>
                    @foreach ($flights as $flight)
                      <tr class="align-middle text-center">
                        <td>{{$flight->id}}</td>
                        <td>{{$flight->userPIC->pic_name}}</td>
                        <td>{{$flight->userPIC->pic_phone_number}}</td>
                        <td>{{$flight->userPIC->email}}</td>
                        <td>{{$flight->type}}</td>
                        <td>{{$flight->airline_name}}</td>
                        <td>{{date("F j, Y G:i ", strtotime($flight->flight_time))}}</td>
                        <td class="d-flex justify-content-center">
                          <a class ="btn btn-sm btn-primary me-2" href="{{ route('flight-tickets.edit', $flight->id) }}" title="Edit">
                            <i class="fa fa-edit"></i>
                          </a>
                          <form method="POST" action="{{ route('flight-tickets.destroy', $flight->id) }}">
                            @method('DELETE')
                            <a href="#" data-bs-toggle ="modal" data-bs-target="#move{{$flight->id}}">
                              <button class = "btn btn-sm btn-warning me-2" title="Move to Recycle Bin">
                                <i class="fa fa-trash"></i>
                              </button>
                            </a>
                            @csrf
                          </form>
                          <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#ticket{{$flight->id}}" >
                            <i class="fa-solid fa-receipt"></i>
                          </a>
                          <form method="POST" action="{{ route('flight-tickets.delete', $flight->id) }}">
                            @method('DELETE')
                            <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$flight->id}}">
                              <button class = "btn btn-sm btn-danger" title="Delete">
                                <i class="fa fa-close"></i>
                              </button>
                            </a>
                            @csrf
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
            </div>
      </x-card>
      
        {{-- TRASHED --}}
      <x-card>
        <h1>Recycle Bin</h1>
          <div class="table-responsive py-2">
            <table class="table table-sm table-striped table-bordered no-footer" id="trashed">
              <thead class="thead-light">
                <tr>
                  <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Name</th>
                    <th class="align-middle text-center">Contact</th>
                    <th class="align-middle text-center">Email</th>
                    <th class="align-middle text-center">Type</th>
                    <th class="align-middle text-center">Airline Name</th>
                    <th class="align-middle text-center">Flight Time</th>
                    <th class="align-middle text-center">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($trashed as $trash)
                  <tr class="align-middle text-center">
                    <td>{{$trash->id}}</td>
                    <td>{{$flight->userPIC->pic_name}}</td>
                    <td>{{$flight->userPIC->pic_phone_number}}</td>
                    <td>{{$flight->userPIC->email}}</td>
                    <td>{{$flight->type}}</td>
                    <td>{{$trash->airline_name}}</td>
                    <td>{{date("F j, Y G:i ", strtotime($trash->flight_time))}}</td>
                    <td class="d-flex justify-content-center">
                      <a class ="btn btn-sm btn-primary me-2" href="{{ route('flight-tickets.edit', $trash->id) }}" title="Edit">
                        <i class="fa fa-edit"></i>
                      </a>
                      <form method="get" action="{{ route('flight-tickets.restore', $trash->id) }}">
                        <button class = "btn btn-sm btn-info me-2">
                          <i class="fa fa-repeat"></i>
                        </button>
                        @csrf
                      </form>
                      <form method="POST" action="{{ route('flight-tickets.delete', $trash->id) }}">
                        @method('DELETE')
                          <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$trash->id}}">
                            <button class = "btn btn-sm btn-danger" title="Delete">
                              <i class="fa fa-close"></i>
                            </button>
                          </a>
                        @csrf
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
      </x-card>
    </div>
  
{{-- modal untuk payment proof --}}
@foreach ($flights as $flight)
  <div class="modal fade p-4" id="ticket{{$flight->id}}" tabindex="-1" role="dialog" >
      <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <img src="/public/images/flight-tickets/{{$flight->ticket_proof}}" class="img-fluid" alt="ticket_proof">
      </div>
      </div>
  </div>
@endforeach

  {{-- RECYCLE BIN MOVE CONFIRMATION --}}
  @foreach ($flights as $flight)
  <div class="modal fade p-5" id="move{{$flight->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered ">
          <div class="modal-content rounded-20 border-0 shadow p-5">
              <div class="modal-headers mb-4">
              <span class="fa-stack fa-4x d-block mx-auto" >
                  <i class="fas fa-circle fa-stack-2x text-danger"></i>
                  <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
              </span>
              </div>
              <div class="body mb-3">
              <h1 class="fw-bold fs-3 text-center" > Are you sure want to move "<span class="fw-bolder text-warning">{{$flight->id}}</span>" to recycle bin ? </h1>
              </div>
              <div class="footer">
                  <div class="row">
                  <div class="col">
                      <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                  </div>
                  <div class="col">
                      <form method="POST" action="{{route('flight-tickets.destroy',$flight->id)}}">
                      <input type="hidden" name="_method" value = "DELETE">
                          <button class="btn btn-danger rounded w-100" title="move">
                          Move
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
  
   {{-- delete confirmation (for $flight) --}}
   @foreach ($flights as $flight)
   <div class="modal fade p-5" id="modal{{$flight->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered ">
           <div class="modal-content rounded-20 border-0 shadow p-5">
               <div class="modal-headers mb-4">
               <span class="fa-stack fa-4x d-block mx-auto" >
                   <i class="fas fa-circle fa-stack-2x text-danger"></i>
                   <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
               </span>
               </div>
               <div class="body mb-3">
               <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete ticket number "<span class="fw-bolder text-danger">{{$flight->id}}</span>"? </h1>
               <p class="text-warning"> note: this action can't be undone  </p>
               </div>
               <div class="footer">
                   <div class="row">
                   <div class="col">
                       <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                   </div>
                   <div class="col">
                       <form method="POST" action="{{route('flight-tickets.delete',$flight->id)}}">
                       <input type="hidden" name="_method" value = "DELETE">
                           <button class="btn btn-danger rounded w-100" title="delete">
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
  
    {{-- delete confirmation (for $trashed) --}}
  @foreach ($trashed as $flight)
  <div class="modal fade p-5" id="modal{{$flight->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered ">
          <div class="modal-content rounded-20 border-0 shadow p-5">
              <div class="modal-headers mb-4">
              <span class="fa-stack fa-4x d-block mx-auto" >
                  <i class="fas fa-circle fa-stack-2x text-danger"></i>
                  <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
              </span>
              </div>
              <div class="body mb-3">
              <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete flight number "<span class="fw-bolder text-danger">{{$flight->id}}</span>"? </h1>
              <p class="text-warning"> note: this action can't be undone  </p>
              </div>
              <div class="footer">
                  <div class="row">
                  <div class="col">
                      <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                  </div>
                  <div class="col">
                      <form method="POST" action="{{route('flight-tickets.delete',$flight->id)}}">
                      <input type="hidden" name="_method" value = "DELETE">
                          <button class="btn btn-danger rounded w-100" title="delete">
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
  