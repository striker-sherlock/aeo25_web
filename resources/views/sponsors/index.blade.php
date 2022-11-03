<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <h1>Sponsors List</h1>
                <a href="{{route('sponsors.create')}}" class="btn btn-outline rounded btn-sm my-3">Add New Sponsor</a>
                <table class="table table-striped table-bordered">
                    <thead class="text-center">
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      @foreach ($sponsors as $sponsor)
                        <tr>
                            <th>{{$sponsor->id}}</th>
                            <td>{{$sponsor->name}}</td>
                            @if ($sponsor->is_showed == 1)
                                <td class="text-success fw-bold ">Showed</td>
                            @else    
                                <td class="text-danger fw-bold">Hidden</td>
                            @endif
                            <td class="d-flex justify-content-center"> 
                                <a href="{{route('sponsors.edit', $sponsor->id)}}" class="btn btn-primary btn-sm rounded me-2 " title="edit">
                                    E
                                </a>
                                
                                <a href="{{route('sponsors.updateVisibility', $sponsor->id)}}" class="btn btn-success btn-sm rounded me-2 " title={{ $sponsor->is_showed ? 'Hide' : 'Show'}}>
                                    U
                                </a>
                                <form method="POST" action="{{route('sponsors.destroy',$sponsor->id)}}">
                                    <input type="hidden" name="_method" value = "DELETE">
                                    <a  href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$sponsor->id}}">
                                    <button class="btn btn-danger rounded btn-sm" title="delete" id ="delete">
                                        D
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

        </div>
    </div>
    @foreach ($sponsors as $sponsor)
    <div class="modal fade p-5" id="modal{{$sponsor->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-20 border-0 shadow p-5">
                <div class="modal-headers mb-4">
                    <span class="fa-stack fa-4x d-block mx-auto" >
                        <i class="fas fa-circle fa-stack-2x text-danger"></i>
                        <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="body mb-3">
                    <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$sponsor->name}}</span>"? </h1>
                    <p class="text-warning"> note: this action can't be undone  </p>
                </div>
                <div class="footer">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary w-100"  data-bs-dismiss="modal">Back</button>
                        </div>
                        <div class="col">
                            <form method="POST" action="{{route('sponsors.destroy',$sponsor->id)}}">
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
