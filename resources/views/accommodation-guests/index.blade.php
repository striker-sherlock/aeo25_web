<x-admin>
    <div class="container mt-4">
        <h2 class="fw-bold mb-2">Accommodation's Guest List</h2>
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('accommodation-guests.index',)}}" class="btn btn-outline-theme w-100 rounded-pill {{$roomType == NULL ? 'active' : '' }}">All Guest</a>
            </div>
            @foreach ($accommodations as $accommodation)
            <div class="col">
                <a href="{{route('accommodation-guests.index',$accommodation->room_type)}}" class="btn btn-outline-theme w-100 rounded-pill {{$roomType == $accommodation->room_type ? 'active' : '' }}">{{$accommodation->room_type}}</a>
            </div>
            @endforeach   
        </div>
        <x-card> 
            @if ($roomType)<h3 class="text-uppercase fw-bold mb-4" style="letter-spacing: 0.1em">{{$roomType}}'s Guest List </h3>
            @else <h3 class="text-uppercase fw-bold mb-4" style="letter-spacing: 0.1em">All Guest List</h3>

            @endif
            @if ($guests->count())
                {{-- <a href="{{route('competition-participants.export',$competition->id)}}" class="btn btn-outline-success mb-4">Download Participant</a> --}}
                <table class="table table-striped table-bordered" id="data-table">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">PIC Name </th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Country</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($guests as $guest)
                            <tr class="text-center">
                                <th>{{$guest->id}}</th>
                                <th class="text-capitalize">{{$guest->user->pic_name}}</th>
                                <th>{{$guest->user->institution_name}}</th>
                                <th>{{$guest->user->country->name}}</th>
                                <th>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{route('accommodation-guests.edit',$guest->id)}}" class="btn btn-primary btn-sm me-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form method="get" action="{{ route('accommodation-guests.destroy', $guest->id) }}">
                                            <button class = "btn btn-sm btn-info me-2">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @csrf
                                        </form>
                                        <form method="POST" action="{{ route('accommodation-guests.delete', $guest->id) }}">
                                            @method('DELETE')
                                            <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$guest->id}}">
                                              <button class = "btn btn-sm btn-danger" >
                                                <i class="fa fa-close"></i>
                                              </button>
                                            </a>
                                            @csrf
                                        </form>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>
        <x-card> 
            @if ($trashed->count())
                {{-- <a href="{{route('competition-participants.export',$competition->id)}}" class="btn btn-outline-success mb-4">Download Participant</a> --}}
                <table class="table table-striped table-bordered" id="dataTables">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">PIC Name </th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Country</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($trashed as $guest)
                            <tr class="text-center">
                                <th>{{$guest->id}}</th>
                                <th class="text-capitalize">{{$guest->user->pic_name}}</th>
                                <th>{{$guest->user->institution_name}}</th>
                                <th>{{$guest->user->country->name}}</th>
                                <th>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{route('accommodation-guests.edit',$guest->id)}}" class="btn btn-primary btn-sm me-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form method="get" action="{{ route('accommodation-guests.restore', $participant->id) }}">
                                            <button class = "btn btn-sm btn-info me-2">
                                                <i class="fa fa-repeat"></i>
                                            </button>
                                            @csrf
                                        </form>
                                        <form method="POST" action="{{ route('accommodation-guests.delete', $guest->id) }}">
                                            @method('DELETE')
                                            <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$guest->id}}">
                                              <button class = "btn btn-sm btn-danger" >
                                                <i class="fa fa-close"></i>
                                              </button>
                                            </a>
                                            @csrf
                                        </form>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>
    </div>

    {{-- move to recycle bin confirmation --}}
@foreach ($guests as $guest)
<div class="modal fade p-5" id="move{{$guest->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content rounded-20 border-0 shadow p-5">
            <div class="modal-headers mb-4">
            <span class="fa-stack fa-4x d-block mx-auto" >
                <i class="fas fa-circle fa-stack-2x text-danger"></i>
                <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
            </span>
            </div>
            <div class="body mb-3">
            <h1 class="fw-bold fs-3 text-center" > Are you sure want to move "<span class="fw-bolder text-danger">{{$guest->user->pic_name}}</span>" to recycle bin ? </h1>
            </div>
            <div class="footer">
                <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                </div>
                <div class="col">
                    <form method="POST" action="{{route('accommodation-guests.destroy',$guest->id)}}">
                    <input type="hidden" name="_method" value = "DELETE">
                        <button class="btn btn-danger rounded w-100" title="delete">
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

{{-- delete confirmation (for $participants) --}}
@foreach ($guests as $guest)
<div class="modal fade p-5" id="modal{{$guest->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content rounded-20 border-0 shadow p-5">
            <div class="modal-headers mb-4">
            <span class="fa-stack fa-4x d-block mx-auto" >
                <i class="fas fa-circle fa-stack-2x text-danger"></i>
                <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
            </span>
            </div>
            <div class="body mb-3">
            <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$guest->user->pic_name}}</span>"? </h1>
            <p class="text-warning"> note: this action can't be undone  </p>
            </div>
            <div class="footer">
                <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                </div>
                <div class="col">
                    <form method="POST" action="{{route('accommodation-guests.delete',$guest->id)}}">
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
  @foreach ($trashed as $guest)
  <div class="modal fade p-5" id="modal{{$guest->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered ">
          <div class="modal-content rounded-20 border-0 shadow p-5">
              <div class="modal-headers mb-4">
              <span class="fa-stack fa-4x d-block mx-auto" >
                  <i class="fas fa-circle fa-stack-2x text-danger"></i>
                  <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
              </span>
              </div>
              <div class="body mb-3">
              <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$guest->user->pic_name}}</span>"? </h1>
              <p class="text-warning"> note: this action can't be undone  </p>
              </div>
              <div class="footer">
                  <div class="row">
                  <div class="col">
                      <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                  </div>
                  <div class="col">
                      <form method="POST" action="{{route('accommodation-guests.delete',$guest->id)}}">
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