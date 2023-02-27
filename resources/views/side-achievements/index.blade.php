<x-admin>
    <div class="container mt-4">
        <x-card>
            <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Side Achievement List </h3>
            <a href="{{route('side-achievements.create', "DB")}}" class="btn btn-primary btn-rounded mb-3"><i class="fa-solid fa-plus"></i> Add new Side Achievement</a>
            @if ($sideAchievements->count())
            <div class="table-responsive py-2">
                <table class="table table-striped table-bordered" id="dataTables">
                    <thead class="text-center">
                    <tr>
                        <th scope="col" class="align-middle text-center">No</th>
                        <th scope="col" class="align-middle text-center">Participant ID</th>
                        <th scope="col" class="align-middle text-center">Name</th>
                        <th scope="col" class="align-middle text-center">Title</th>
                        <th scope="col" class="align-middle text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach ($sideAchievements as $key => $sideAchievement)
                        <tr>
                            <td class="align-middle text-center">{{ $key + 1}}</td>
                            <td class="align-middle text-center">{{ $sideAchievement->participant_id}}</td>
                            <td class="align-middle text-center">{{ $sideAchievement->competitionParticipant->name }}</td>
                            <td class="align-middle text-center">{{ $sideAchievement->name }}</td>
                            
                            <td class="d-flex justify-content-center"> 
                                <form method="POST" action="{{route('side-achievements.destroy', $sideAchievement->id)}}">
                                    <input type="hidden" name="_method" value = "DELETE">
                                    <a  href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$sideAchievement->id}}">
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
    @foreach ($sideAchievements as $sideAchievement)
        <div class="modal fade p-5" id="modal{{$sideAchievement->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content rounded-20 border-0 shadow p-5">
                    <div class="modal-headers mb-4">
                        <span class="fa-stack fa-4x d-block mx-auto" >
                            <i class="fas fa-circle fa-stack-2x text-danger"></i>
                            <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="body mb-3">
                        <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$sideAchievement->name}}</span>"? </h1>
                        <p class="text-warning"> note: this action can't be undone </p>
                    </div>
                    <div class="footer">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary w-100"  data-bs-dismiss="modal">Back</button>
                            </div>
                            <div class="col">
                                <form method="POST" action="{{route('side-achievements.destroy', $sideAchievement->id)}}">
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