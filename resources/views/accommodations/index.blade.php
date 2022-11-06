<x-admin>
    <div class="container mt-4">
      <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
          <div class="card-header bg-secondary"></div>
          <div class="card-body my-3">
            <h1>accommodations List</h1>
              <a href="{{ route('accommodations.create') }}" class="btn btn-primary btn-rounded mb-3">Create New Accomodation</a>
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
                        @foreach ($accommodations as $accommodation)
                          <tr class="align-middle text-center">
                            <td>{{$accommodation->id}}</td>
                            <td>{{$accommodation->room_type}}</td>
                            <td>{{$accommodation->max_guests}}</td>
                            <td class="d-flex justify-content-center">
                              <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar">
                                <button type="button" class ="btn btn-sm btn-info text-white me-2 {{ ($accommodation->facilities->count() > 0) ? '' : 'disabled' }}" data-bs-target="#viewFacility-{{ $accommodation->id }}" data-bs-toggle="modal" title="View Facilities">
                                  <i class="fa fa-eye"></i>
                                </button>
                                <a class ="btn btn-sm btn-primary me-2" href="{{ route('accommodations.edit', $accommodation->id) }}" title="Edit">
                                  <i class="fa fa-edit"></i>
                                </a>
                                <form method="POST" action="{{ route('accommodations.destroy', $accommodation->id) }}">
                                  @method('DELETE')
                                  <button type="button" class = "btn btn-sm btn-danger" data-bs-toggle ="modal" data-bs-target="#modal{{ $accommodation->id }}" title="Delete">
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
          </div>
      </div>
    </div>
    @foreach ($accommodations as $accommodation)
    {{-- Delete Confirmation Modal --}}
      <div class="modal fade p-5" id="modal{{$accommodation->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content rounded-20 border-0 shadow p-5">
                  <div class="modal-headers mb-4">
                  <span class="fa-stack fa-4x d-block mx-auto" >
                      <i class="fas fa-circle fa-stack-2x text-danger"></i>
                      <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                  </span>
                  </div>
                  <div class="body mb-3">
                  <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete "<span class="fw-bolder text-danger">{{$accommodation->name}}</span>" </h1>
                  </div>
                  <div class="footer">
                      <div class="row">
                      <div class="col">
                          <button type="button" class="btn btn-secondary w-100"  data-bs-dismiss="modal">Back</button>
                      </div>
                      <div class="col">
                          <form method="POST" action="{{route('countries.destroy',$accommodation->id)}}">
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

      {{-- View Facility Modal --}}
      <div class="modal fade" id="viewFacility-{{$accommodation->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-20 border-0 shadow">
                <div class="modal-header border-bottom-0">
                  <button type="button" class="btn-close" data-bs-dismiss="modal"
                      aria-label="Close">
                  </button>
                </div>
                <div class="modal-body">
                  <h4 class="text-muted text-center">{{ $accommodation->room_type }} - Room Facility</h4>
                  <hr>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="bg-light">
                        <th class="align-middle text-center">#</th>
                        <th class="align-middle text-center">Facility</th>
                        <th class="align-middle text-center">Availability</th>
                      </thead>
                      <tbody>
                        @foreach ($accommodation->facilities->sortByDesc('is_available') as $accommFacility)
                          <tr class="align-middle text-center">
                            <td>
                              {{ $loop->iteration }}
                            </td>
                            <td>
                              {{ $accommFacility->facility->name }}
                            </td>
                            <td>
                              <span class="{{ ($accommFacility->is_available) ? 'text-success' : 'text-danger' }}">
                                {{ ($accommFacility->is_available) ? 'Available' : 'Not Available' }}
                              </span>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="text-center">
                    <button type="button"
                        class="btn btn-success rounded-pill rounded-20 mb-4 px-4"
                        data-bs-dismiss="modal">
                        OK, I got it
                    </button>
                </div>
            </div>
        </div>  
      </div>  
    @endforeach
    </x-admin>