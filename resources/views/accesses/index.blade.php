<x-admin >
    <div class="container mt-3">
        <x-card>
            <a href="{{ route('accesses.create') }}" class="btn btn-primary mb-3">
              <i class="fas fa-plus me-2"></i> Create New Access
            </a>
          <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Access List</h3>
          @if ($accesses->count() > 0)
            <div class="table-responsive py-2">
              <table class="table table-sm   table-bordered no-footer" id="dataTables">
                <thead class="thead-light">
                  <tr>
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Name</th>
                    <th class="align-middle text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($accesses as $access)
                    <tr class="align-middle text-center">
                      <td>{{$access->id}}</td>
                      <td>{{$access->name}}</td>
                      <td>
                        <form method="POST" action="{{route('accesses.destroy',$access->id)}}">
                          <input type="hidden" name="_method" value = "DELETE">
                          <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$access->id}}">
                            <button class="btn btn-sm btn-danger text-white">
                              <i class="fas fa-trash"></i>
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
            <hr> <p class="text-center">No Data</p>
          @endif
        </x-card>
    </div>
    
    {{-- confirmation delete --}}
    @foreach ($accesses as $access)
      <div class="modal fade p-5" id="modal{{$access->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content rounded-20 border-0 shadow p-5">
                  <div class="modal-headers mb-4">
                  <span class="fa-stack fa-4x d-block mx-auto" >
                      <i class="fas fa-circle fa-stack-2x text-danger"></i>
                      <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                  </span>
                  </div>
                  <div class="body mb-3">
                  <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete access "<span class="fw-bolder text-danger">{{$access->name}}</span>"? </h1>
                  <p class="text-warning"> note: this action can't be undone  </p>
                  </div>
                  <div class="footer">
                      <div class="row">
                      <div class="col">
                          <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                      </div>
                      <div class="col">
                          <form method="POST" action="{{route('accesses.destroy',$access->id)}}">
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