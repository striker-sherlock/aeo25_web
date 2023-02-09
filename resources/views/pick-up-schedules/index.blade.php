<x-admin>
    <div class="container mt-4">
        <x-card>
            <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Pick Up Schedule</h3>
            <a href="{{route('pick-up-schedules.create')}}" class="btn btn-success mb-3"><i class="fa-solid fa-plus"></i> Add New Schedule</a>
            @if ($schedules->count())
                <div class="table-responsive py-2">
                    <table class="table table-striped table-bordered" id="dataTables">
                        <thead class="text-center">
                            <tr>
                                <th scope="col">Schedule Time</th>
                                <th scope="col">Expected People</th>
                                <th scope="col">PIC</th>
                                <th scope="col">Action</th> 
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{date('d M H:i',strtotime($schedule->schedule))}}</td>
                                    <td>{{$expectedPeople[$schedule->id]}} people(s)</td>
                                    <td>
                                        <a href="" data-bs-target="#viewPIC-{{$schedule->id}}" data-bs-toggle="modal" class="btn btn-outline-theme rounded-pill w-100"> View PICs
                                        </a>
                                    </td>
                                    
                                    <td class="d-flex justify-content-center"> 
                                        <a href="{{route('pick-up-schedules.edit', $schedule->id)}}" class="btn btn-primary btn-sm rounded me-2 " title="edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        
                                    
                                        <form method="POST" action="{{route('pick-up-schedules.destroy',$schedule->id)}}">
                                            <input type="hidden" name="_method" value = "DELETE">
                                            <a  href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$schedule->id}}">
                                            <button class="btn btn-danger rounded btn-sm" title="delete" id ="delete">
                                                <i class="fa-solid fa-trash "></i>
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
            @else <hr> <p class="text-center"> No Data</p>
            @endif 
        </x-card>
    </div>

    {{-- modal untuk konfirmasi delete --}}
    @foreach ($schedules as $schedule)
      <div class="modal fade p-5" id="modal{{$schedule->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content rounded-20 border-0 shadow p-5">
                  <div class="modal-headers mb-4">
                  <span class="fa-stack fa-4x d-block mx-auto" >
                      <i class="fas fa-circle fa-stack-2x text-danger"></i>
                      <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                  </span>
                  </div>
                  <div class="body mb-3">
                  <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete this schedule ? </h1>
                  <p class="text-warning"> note: this action can't be undone  </p>
                  </div>
                  <div class="footers">
                      <div class="row">
                      <div class="col">
                          <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                      </div>
                      <div class="col">
                          <form method="POST" action="{{route('pick-up-schedules.destroy',$schedule->id)}}">
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

    @foreach ($schedules as $schedule)
      <div class="modal modal-lg fade p-5" id="viewPIC-{{$schedule->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content rounded-20 border-0 shadow p-5">
                  <div class="modal-headers mb-4">
                   
                  </div>
                  <div class="body mb-3">
                    <div class="table-responsive">
                        @if ($schedule->flightTickets->count())
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>PIC </th>
                                        <th>Number Of People </th>
                                        <th>Flight Time </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedule->flightTickets as $ticket)
                                        <tr>
                                            <th>{{$ticket->userPIC->pic_name}}</th>
                                            <th>{{$ticket->number_of_people}} people</th>
                                            <th>{{date('D, d M h:i',strtotime($ticket->flight_time))}}</th>
                                        </tr>
                                    @endforeach
                                    <th>Total</th> 
                                    <th >{{$expectedPeople[$schedule->id]}} people(s)</th>
                                </tbody>
                            </table>
                        @else <p class="text-center">No Data</p>
                        @endif
                    </div>
                  </div>
                  <div class="footers">
                      <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                        </div>
                       
                      </div>  
                  </div>
              </div>
          </div>  
      </div>  
    @endforeach
</x-admin>