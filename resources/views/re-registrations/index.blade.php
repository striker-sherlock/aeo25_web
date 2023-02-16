<x-admin>
    <div class="container mt-4">
        <x-card>
            <h1 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">Not Attend Participant  </h1>
            @if ($notAttend->count())
                <div class="table-responsive py-2">
                    <table class="table table-striped table-bordered dataTables">
                        <thead class="text-center">
                        <tr>
                            <th scope="col">Participant ID</th>
                            <th scope="col">Participant Name</th>
                            <th scope="col">Institution Name</th>
                            <th scope="col">PIC Name</th>
                            <th scope="col">Competition Field</th>
                            <th scope="col">Country</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($notAttend as $participant)
                            <tr class="text-center">
                                <th>{{$participant->id}}</th>
                                <th>{{ $participant->name}}</th>
                                <th>{{$participant->user->institution_name}}</th>
                                <th>{{$participant->user->pic_name}}</th>
                                <th>{{$participant->competition->name}}</th>
                                <th>{{$participant->user->country->name}}</th>
                                <th>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal{{$participant->id}}" class ="btn btn-primary me-2" title="confirm attendance">
                                        <i class="fas fa-user"></i>
                                    </a>

                                    
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>

        <x-card>
            <h1 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">Attend Participant  </h1>
            @if ($attend->count())
                <div class="table-responsive py-2">
                    <table class="table table-striped table-bordered dataTables">
                        <thead class="text-center">
                        <tr>
                            <th scope="col">Participant ID</th>
                            <th scope="col">Participant Name</th>
                            <th scope="col">Institution Name</th>
                            <th scope="col">PIC Name</th>
                            <th scope="col">Competition Field</th>
                            <th scope="col">Country</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($attend as $participant)
                            <tr class="text-center">
                                <th>{{$participant->id}}</th>
                                <th>{{ $participant->name}}</th>
                                <th>{{$participant->user->institution_name}}</th>
                                <th>{{$participant->user->pic_name}}</th>
                                <th>{{$participant->competition->name}}</th>
                                <th>{{$participant->user->country->name}}</th>
                                <th>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#cancel{{$participant->id}}" class ="btn btn-danger me-2" title="cancel attendance">
                                        <i class="fas fa-x"></i>
                                    </a>

                                    
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @else <hr> <p class="text-center">no data </p>
            @endif
        </x-card>
    </div>

    {{-- confirm attendance modal --}}
    @foreach ($allParticipants as $participant )
        <div class="modal fade  " id="modal{{$participant->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content rounded-20 border-0 shadow p-0 m-0 overflow-hidden">
                    <div class="modal-headers mb-4 text-white m-0 px-3 py-2"  style="background-color:#3F3B74;">
                        <h3 class="text-capitalize aeo-title">Competition Re-registration</h3>
                    </div>
                    <div class="body px-4">
                        <form action="{{route('re-regists.update',$participant->id)}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('PUT')
                            <div class="form-group row align-items-center mb-3">
                                <label class="control-label col-3" for="id">ID</label>
                                <div class="col-9">
                                    <input type="text" class="form-control rounded-pill" id="id" name="id" value="{{$participant->id}}" disabled>
                                </div>
                            </div>

                            <div class="form-group row align-items-center mb-3">
                                <label class="control-label col-3" for="pic_name">PIC Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control rounded-pill" id="pic_name" name="pic_name" value="{{$participant->user->pic_name}}" disabled>
                                </div>
                            </div>

                            <div class="form-group row align-items-center mb-3">
                                <label class="control-label col-3" for="name">Participant Name</label>
                                <div class="col-9">
                                    <input type="text" class="form-control rounded-pill" id="name" name="name" value="{{$participant->name}}" >
                                </div>
                            </div>

                            <div class="form-group row align-items-center mb-3">
                                <label class="control-label col-3" for="field">Field</label>
                                <div class="col-9">
                                    <input type="text" class="form-control rounded-pill" id="field" name="field" value="{{$participant->competition->name}}" disabled >
                                </div>
                            </div>
            
                        </div>
                        <div class="footers mx-4 mb-4">
                            <button type="submit" class="btn btn-outline-success w-100 rounded-pill"> Confirm Attendance</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>  
    @endforeach

    {{-- cancel attendance modal --}}
    @foreach ($allParticipants as $participant )
    <div class="modal fade p-5" id="cancel{{$participant->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-20 border-0 shadow p-5">
                <div class="modal-headers mb-4">
                <span class="fa-stack fa-4x d-block mx-auto" >
                    <i class="fas fa-circle fa-stack-2x text-danger"></i>
                    <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                </span>
                </div>
                <div class="body mb-3">
                <h1 class="fw-bold fs-3 text-center" > Are you sure want to cancel "<span class="fw-bolder text-danger">{{$participant->name}}</span>"? </h1>
                </div>
                <div class="footers">
                    <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-outline-secondary rounded-pill w-100"  data-bs-dismiss="modal">Back</button>
                    </div>
                    <div class="col">
                         <a href="{{route('re-regists.unconfirm',$participant->id)}}" class=" btn btn-outline-warning rounded-pill w-100 cancel"> Unconfirm</a>
                    </div>
                    </div>  
                </div>
            </div>
        </div>  
    </div>  
    @endforeach
</x-admin>