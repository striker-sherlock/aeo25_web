<x-admin>
    <div class="container mt-4">
      <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
          <div class="card-header bg-secondary"></div>
          <div class="card-body my-3">
            <h1>Accomodations List</h1>
              <a href="{{ route('accomodations.create') }}" class="btn btn-primary btn-rounded mb-3">Create New Accomodation</a>
                <div class="table-responsive py-2">
                    <table class="table table-sm table-striped table-bordered no-footer" id="dataTables">
                      <thead class="thead-light">
                        <tr>
                          <th class="align-middle text-center">ID</th>
                          <th class="align-middle text-center">Room Type</th>
                          <th class="align-middle text-center">Max Guests</th>
                          <th class="align-middle text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($accomodations as $accomodation)
                          <tr class="align-middle text-center">
                            <td>{{$accomodation->id}}</td>
                            <td>{{$accomodation->room_type}}</td>
                            <td>{{$accomodation->max_guests}}</td>
                            <td class="d-flex justify-content-center">
                              <a class ="btn btn-sm btn-primary me-2" href="{{ route('accomodations.edit', $accomodation->id) }}" title="Edit">
                                <i class="fa fa-edit"></i>
                              </a>
                              <form method="POST" action="{{ route('accomodations.destroy', $accomodation->id) }}">
                                @method('DELETE')
                                <a href="#" data-bs-toggle ="modal" data-bs-target="#modal{{ $accomodation->id }}">
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
    @foreach ($accomodations as $accomodation)
        <div class="modal fade p-5" id="modal{{$accomodation->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content rounded-20 border-0 shadow p-5">
                    <div class="modal-headers mb-4">
                    <span class="fa-stack fa-4x d-block mx-auto" >
                        <i class="fas fa-circle fa-stack-2x text-danger"></i>
                        <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>
                    </div>
                    <div class="body mb-3">
                    <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$accomodation->name}}</span>" </h1>
                    </div>
                    <div class="footer">
                        <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                        </div>
                        <div class="col">
                            <form method="POST" action="{{route('countries.destroy',$accomodation->id)}}">
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