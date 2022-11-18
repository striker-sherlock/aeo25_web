<x-admin>
    <div class="container mt-4">
      <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
          <div class="card-header bg-secondary"></div>
          <div class="card-body my-3">
            <h1>Environment List</h1>
              <a href="{{ route('environments.create') }}" class="btn btn-primary btn-rounded mb-3">Create New Environment</a>
                <div class="table-responsive py-2">
                    <table class="table table-sm table-striped table-bordered no-footer">
                      <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center">Code</th>
                            <th class="align-middle text-center">Name</th>
                            <th class="align-middle text-center">Status</th>
                            <th class="align-middle text-center">Updated At</th>
                            <th class="align-middle text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($environments as $environment)
                          <tr class="align-middle text-center">
                            <td>{{$environment->env_code}}</td>
                            <td>{{$environment->env_name}}</td>
                            <td class="align-middle text-center">{{$environment->is_showed ? "Visible":"Hidden"}}</td>
                            <td class="align-middle text-center">{{$environment->updated_at ? $environment->updated_at : "-"}}</td>
                            <td class="d-flex justify-content-center">
                            @if($environment->is_showed)
                                <a class="btn btn-sm btn-info me-2" href="{{ route('environments.update-visibility', $environment->id) }}" title="Hide">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            @else
                                <a class="btn btn-sm btn-danger me-2" href="{{ route('environments.update-visibility', $environment->id) }}" title="Show">
                                    <i class="fa fa-eye-slash"></i>
                                </a>
                            @endif
                            <form method="POST" action="{{route('environments.destroy',$environment->id)}}">
                                <input  type="hidden" name="_method" value = "DELETE">
                                <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$environment->id}}">
                                <button title="delete" class="btn btn-sm btn-danger" >
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
          </div>
      </div>
    </div>
    @foreach ($environments as $environment)
    <div class="modal fade p-5" id="modal{{$environment->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-20 border-0 shadow p-5">
                <div class="modal-headers mb-4">
                <span class="fa-stack fa-4x d-block mx-auto" >
                    <i class="fas fa-circle fa-stack-2x text-danger"></i>
                    <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                </span>
                </div>
                <div class="body mb-3">
                <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete environment "<span class="fw-bolder text-danger">{{$environment->env_name}}</span>"? </h1>
                <p class="text-warning"> note: this action can't be undone  </p>
                </div>
                <div class="footer">
                    <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                    </div>
                    <div class="col">
                        <form method="POST" action="{{route('environments.destroy',$environment->id)}}">
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