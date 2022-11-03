<x-admin>
<div class="container mt-4">
  <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
      <div class="card-header bg-secondary"></div>
      <div class="card-body my-3">
        <h1>Countries List</h1>
          <a href="{{ route('countries.create') }}" class="btn btn-primary btn-rounded mb-3">Create New Country</a>
            <div class="table-responsive py-2">
                <table class="table table-sm table-striped table-bordered no-footer" id="dataTables">
                  <thead class="thead-light">
                    <tr>
                      <th class="align-middle text-center">ID</th>
                      <th class="align-middle text-center">Name</th>
                      <th class="align-middle text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($countries as $country)
                      <tr class="align-middle text-center">
                        <td>{{$country->id}}</td>
                        <td>{{$country->name}}</td>
                        <td class="d-flex justify-content-center">
                          <a class ="btn btn-sm btn-primary me-2" href="{{ route('countries.edit', $country->id) }}" title="Edit">
                            <i class="fa fa-edit"></i>
                          </a>
                          <form method="POST" action="{{ route('countries.destroy', $country->id) }}">
                            @method('DELETE')
                            <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{ $country->id }}">
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
      </div>
  </div>
</div>
@foreach ($countries as $country)
    <div class="modal fade p-5" id="modal{{$country->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-20 border-0 shadow p-5">
                <div class="modal-headers mb-4">
                <span class="fa-stack fa-4x d-block mx-auto" >
                    <i class="fas fa-circle fa-stack-2x text-danger"></i>
                    <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                </span>
                </div>
                <div class="body mb-3">
                <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$country->name}}</span>" </h1>
                </div>
                <div class="footer">
                    <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                    </div>
                    <div class="col">
                        <form method="POST" action="{{route('countries.destroy',$country->id)}}">
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