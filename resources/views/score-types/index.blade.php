<x-admin>
    <div class="container mt-4">
      <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
          <div class="card-header bg-secondary"></div>
          <div class="card-body my-3">
            <h1>Score Types List</h1>
              <a href="{{ route('score-types.create') }}" class="btn btn-primary btn-rounded mb-3">Create New Score Type</a>
              @if ($scoreTypes->count() > 0)
                <div class="table-responsive py-2">
                    <table class="table table-sm table-striped table-bordered no-footer" id="dataTables">
                        <thead class="thead-light">
                        <tr>
                            <th class="align-middle text-center">ID</th>
                            <th class="align-middle text-center">Type</th>
                            <th class="align-middle text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($scoreTypes as $scoreType)
                            <tr class="align-middle text-center">
                            <td>{{$scoreType->id}}</td>
                            <td>{{$scoreType->type_name}}</td>
                            <td class="d-flex justify-content-center">
                                <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar">
                                <a class ="btn btn-sm btn-primary me-2" href="{{ route('score-types.edit', $scoreType->id) }}" title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('score-types.destroy', $scoreType->id) }}">
                                    @method('DELETE')
                                    <button type="button" class = "btn btn-sm btn-danger" data-bs-toggle ="modal" data-bs-target="#modal{{ $scoreType->id }}" title="Delete">
                                    <i class="fa fa-close"></i>
                                    </button>
                                    @csrf
                                </form>
                                </div>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">No Data.</p>
              @endif
          </div>
      </div>
    </div>
    @foreach ($scoreTypes as $scoreType)
    {{-- Delete Confirmation Modal --}}
      <div class="modal fade p-5" id="modal{{$scoreType->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content rounded-20 border-0 shadow p-5">
                  <div class="modal-headers mb-4">
                  <span class="fa-stack fa-4x d-block mx-auto" >
                      <i class="fas fa-circle fa-stack-2x text-danger"></i>
                      <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                  </span>
                  </div>
                  <div class="body mb-3">
                  <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$scoreType->type_name}}</span>" </h1>
                  </div>
                  <div class="footer">
                      <div class="row">
                      <div class="col">
                          <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                      </div>
                      <div class="col">
                          <form method="POST" action="{{route('score-types.destroy',$scoreType->id)}}">
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