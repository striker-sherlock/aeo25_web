<x-user title="Flight Tickets">
  <div class="container mt-5">
    <x-card>
      <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Flight List</h3>
      <a href="{{ route('flight-registrations.create') }}" class="btn btn-primary btn-rounded mb-3">Create Flight Registration</a>
      @if($flightTickets->count())
          <div class="table-responsive py-2">
            <table class="table table-sm table-striped table-bordered no-footer" id="dataTables">
              <thead class="table-info">
                <tr>
                  <th class="align-middle text-center">ID</th>
                  <th class="align-middle text-center">Type</th>
                  <th class="align-middle text-center">Airline Name</th>
                  <th class="align-middle text-center">Flight Time</th>
                  <th class="align-middle text-center">Action</th>
                </tr>
              </thead>
                <tbody>
                  @foreach ($flightTickets as $flightTicket)
                    <tr class="align-middle text-center">
                      <td>{{$flightTicket->id}}</td>
                      <td>{{$flightTicket->type}}</td>
                      <td>{{$flightTicket->airline_name}}</td>
                      <td>{{date("F j, Y H:i ", strtotime($flightTicket->flight_time))}}</td>
                      <td class="d-flex justify-content-center">
                        <a class ="btn btn-sm btn-primary me-2" href="{{ route('flight-tickets.edit', $flightTicket->id) }}" title="Edit">
                          <i class="fa fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-sm btn-info me-2" data-bs-toggle="modal" data-bs-target="#ticket{{$flightTicket->id}}" >
                          <i class="fa-solid fa-receipt"></i>
                        </a>
                        <form method="POST" action="{{ route('flight-tickets.delete', $flightTicket->id) }}">
                          @method('DELETE')
                          <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$flightTicket->id}}">
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
          @else
            <hr>
              <p class="text-center">No Data</p>
          @endif
    </x-card>
  </div>

{{-- modal untuk proof --}}
@foreach ($flightTickets as $flight)
  <div class="modal fade p-4" id="ticket{{$flight->id}}" tabindex="-1" role="dialog" >
      <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        @foreach (explode('; ',$flight->ticket_proof) as $image  )
          <div class="item mx-auto rounded-20 " style="width:100%;">
            <a>
                <div class="d-flex justify-content-center p-2" style="box-sizing: border-box">
                    <img src="/storage/images/flight-tickets/{{$image}}" class="img-fluid  w-100" alt="{{ $flight->userPIC->pic_name }}'s tickets" loading="lazy" width="50" >
                </div>                       
            </a>
          </div>
        @endforeach
          {{-- <img src="/public/images/flight-tickets/{{$flight->ticket_proof}}" class="img-fluid" alt="ticket_proof"> --}}
      </div>
      </div>
  </div>
@endforeach

 {{-- delete confirmation (for $flight) --}}
 @foreach ($flightTickets as $flightTicket)
 <div class="modal fade p-5" id="modal{{$flightTicket->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered ">
         <div class="modal-content rounded-20 border-0 shadow p-5">
             <div class="modal-headers mb-4">
             <span class="fa-stack fa-4x d-block mx-auto" >
                 <i class="fas fa-circle fa-stack-2x text-danger"></i>
                 <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
             </span>
             </div>
             <div class="body mb-3">
             <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete ticket number "<span class="fw-bolder text-danger">{{$flightTicket->id}}</span>"? </h1>
             <p class="text-warning"> note: this action can't be undone  </p>
             </div>
             <div class="footer">
                 <div class="row">
                 <div class="col">
                     <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                 </div>
                 <div class="col">
                     <form method="POST" action="{{route('flight-tickets.delete', $flightTicket->id)}}">
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

  
</x-user>
