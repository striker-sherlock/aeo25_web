<x-admin>
    <div class="container mt-4">
        <div class="row">
            @foreach ($allCompetitions as $compet )
                <div class="col-6 col-md-3 mb-4  ">
                    <a href="{{route('competition-participants.index',$compet->id)}}" class="btn btn-outline-primary w-100 rounded-pill {{$competition->id == $compet->id ? 'active':''}}">{{$compet->name}}</a>
                </div>
            @endforeach
        </div>
        <x-card>   
            <h3 class="text-uppercase fw-bold text-gradient " style="letter-spacing: 0.1em">{{$competition->name}}'s Participants </h3>         
            @if ($competitionParticipants->count())
                <a href="{{route('competition-participants.export',$competition->id)}}" class="btn btn-outline-success mb-4"> <i class="fas fa-file-export" aria-hidden="true"></i> Download Participant</a>
                <table class="table table-striped table-bordered dataTables">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{{$competition->need_team == 1 ? 'Team' : ''}}</th>
                        <th scope="col">Participant Name</th>
                        <th scope="col">Institution Name</th>
                        <th scope="col">Country</th>
                        <th scope="col">PIC Name </th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($competitionParticipants as $participant)
                        <tr class="text-center">
                            <th>{{$participant->id}}</th>
                            <th>{{$participant->competition->need_team == 1 ? $participant->competitionTeam->name : ''}}</th>
                            <th>{{ $participant->name}}</th>
                            <th>{{$participant->user->institution_name}}</th>
                            <th>{{$participant->user->country->name}}</th>
                            <th>{{$participant->user->pic_name}}</th>
                            <th>
                                <div class="d-flex justify-content-around">
                                    <a class ="btn  btn-primary me-2" href="{{route('competition-participants.edit',$participant->id)}}" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form method="get" action="{{ route('competition-participants.destroy', $participant->id) }}">
                                    <a href="#" data-bs-toggle ="modal" data-bs-target="#move{{$participant->id}}">
                                        <button class = "btn  btn-warning me-2" title="Move Participant to Recycle Bin">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </a>
                                        @csrf
                                    </form>
                                    {{-- <form method="POST" action="{{ route('competition-participants.delete', $participant->id) }}">
                                        @method('DELETE')
                                        <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$participant->id}}">
                                          <button class = "btn  btn-danger" >
                                            <i class="fa fa-close"></i>
                                          </button>
                                        </a>
                                        @csrf
                                    </form> --}}
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
            <h3 class="text-uppercase fw-bold text-gradient " style="letter-spacing: 0.1em">{{$competition->name}}'s Recycle Bin </h3>  
            @if ($trashed->count())
                <table class="table table-striped table-bordered dataTables">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{{$competition->need_team == 1 ? 'Team' : ''}}</th>
                        <th scope="col">Participant Name</th>
                        <th scope="col">Institution Name</th>
                        <th scope="col">Country</th>
                        <th scope="col">PIC Name </th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($trashed as $participant)
                        <tr class="text-center">
                            <th>{{$participant->id}}</th>
                            <th>{{$participant->competition->need_team == 1 ? $participant->competitionTeam->name : ''}}</th>
                            <th>{{$participant->name}}</th>
                            <th>{{$participant->user->institution_name}}</th>
                            <th>{{$participant->user->country->name}}</th>
                            <th>{{$participant->user->pic_name}}</th>
                            <th>
                                <div class="d-flex justify-content-around">
                                    <a class ="btn  btn-primary me-2" href="{{route('competition-participants.edit',$participant->id)}}" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form method="get" action="{{ route('competition-participants.restore', $participant->id) }}" >
                                        <button class = "btn  btn-info me-2" title="Restore Participant">
                                        <i class="fa fa-repeat"></i>
                                        </button>
                                        @csrf
                                    </form>
                                    {{-- <form method="POST" action="{{ route('competition-participants.delete', $participant->id) }}">
                                        @method('DELETE')
                                        <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$participant->id}}">
                                        <button class = "btn  btn-danger" >
                                            <i class="fa fa-close"></i>
                                        </button>
                                        </a>
                                        @csrf
                                    </form> --}}
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
@foreach ($competitionParticipants as $participant)
<div class="modal fade p-5" id="move{{$participant->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content rounded-20 border-0 shadow p-5">
            <div class="modal-headers mb-4">
            <span class="fa-stack fa-4x d-block mx-auto" >
                <i class="fas fa-circle fa-stack-2x text-danger"></i>
                <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
            </span>
            </div>
            <div class="body mb-3">
            <h1 class="fw-bold fs-3 text-center" > Are you sure want to move "<span class="fw-bolder text-danger">{{$participant->name}}</span>" to recycle bin ? </h1>
            </div>
            <div class="modal-footers">
                <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-outline-secondary w-100  rounded-pill "  data-bs-dismiss="modal">Back</button>
                </div>
                <div class="col">
                    <form method="POST" action="{{route('competition-participants.destroy',$participant->id)}}">
                    <input type="hidden" name="_method" value = "DELETE">
                        <button class="btn btn-outline-danger  rounded-pill w-100 " title="delete">
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
@foreach ($competitionParticipants as $participant)
<div class="modal fade p-5" id="modal{{$participant->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content rounded-20 border-0 shadow p-5">
            <div class="modal-headers mb-4">
            <span class="fa-stack fa-4x d-block mx-auto" >
                <i class="fas fa-circle fa-stack-2x text-danger"></i>
                <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
            </span>
            </div>
            <div class="body mb-3">
            <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$participant->user->pic_name}}</span>"? </h1>
            <p class="text-warning"> note: this action can't be undone  </p>
            </div>
            <div class="modal-footers">
                <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-outline-secondary rounded-pill w-100"  data-bs-dismiss="modal">Back</button>
                </div>
                <div class="col">
                    <form method="POST" action="{{route('competition-participants.delete',$participant->id)}}">
                    <input type="hidden" name="_method" value = "DELETE">
                        <button class="btn btn-outline-danger rounded w-100 rounded-pill" title="delete">
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
  {{-- @foreach ($trashed as $participant)
  <div class="modal fade p-5" id="modal{{$participant->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered ">
          <div class="modal-content rounded-20 border-0 shadow p-5">
              <div class="modal-headers mb-4">
              <span class="fa-stack fa-4x d-block mx-auto" >
                  <i class="fas fa-circle fa-stack-2x text-danger"></i>
                  <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
              </span>
              </div>
              <div class="body mb-3">
              <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$participant->user->pic_name}}</span>"? </h1>
              <p class="text-warning"> note: this action can't be undone  </p>
              </div>
              <div class="modal-footers">
                  <div class="row">
                  <div class="col">
                      <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                  </div>
                  <div class="col">
                      <form method="POST" action="{{route('competition-participants.delete',$participant->id)}}">
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
@endforeach --}}
</x-admin>