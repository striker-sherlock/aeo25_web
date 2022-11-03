<x-admin>
  <div class="container mt-4">
    <x-card>
      <h1>Flights List</h1>
        <a href="{{ route('flight-registrations.create') }}" class="btn btn-primary btn-rounded mb-3">Create Flight Registration</a>
          <div class="table-responsive py-2">
            <table class="table table-sm table-striped table-bordered no-footer" id="dataTables">
              <thead class="thead-light">
                <tr>
                  <th class="align-middle text-center">ID</th>
                  <th class="align-middle text-center">Airline Name</th>
                  <th class="align-middle text-center">Flight Time</th>
                  <th class="align-middle text-center">Action</th>
                </tr>
              </thead>
                <tbody>
                  @foreach ($flights as $flight)
                    <tr class="align-middle text-center">
                      <td>{{$flight->id}}</td>
                      <td>{{$flight->airline_name}}</td>
                      <td>{{date("F j, Y G:i ", strtotime($flight->flight_time))}}</td>
                      <td class="d-flex justify-content-center">
                        <a class ="btn btn-sm btn-primary me-2" href="{{ route('flight-tickets.edit', $flight->id) }}" title="Edit">
                          <i class="fa fa-edit"></i>
                        </a>
                        <form method="POST" action="{{ route('flight-tickets.destroy', $flight->id) }}">
                          @method('DELETE')
                            <button class = "btn btn-sm btn-warning me-2" title="Move to Recycle Bin" onclick="return confirm('confirm')">
                              <i class="fa fa-trash"></i>
                            </button>
                          @csrf
                        </form>
                        <form method="POST" action="{{ route('flight-tickets.delete', $flight->id) }}">
                          @method('DELETE')
                            <button class = "btn btn-sm btn-danger" title="Delete" onclick="return confirm('confirm')">
                              <i class="fa fa-close"></i>
                            </button>
                          @csrf
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
          </div>
    </x-card>
      {{-- TRASHED --}}
    <x-card>
      <h1>Recycle Bin</h1>
        <div class="table-responsive py-2">
          <table class="table table-sm table-striped table-bordered no-footer" id="dataTables">
            <thead class="thead-light">
              <tr>
                <th class="align-middle text-center">ID</th>
                <th class="align-middle text-center">Airline Name</th>
                <th class="align-middle text-center">Flight Time</th>
                <th class="align-middle text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($trashed as $trash)
                <tr class="align-middle text-center">
                  <td>{{$trash->id}}</td>
                  <td>{{$trash->airline_name}}</td>
                  <td>{{date("F j, Y G:i ", strtotime($trash->flight_time))}}</td>
                  <td class="d-flex justify-content-center">
                    <a class ="btn btn-sm btn-primary me-2" href="{{ route('flight-tickets.edit', $trash->id) }}" title="Edit">
                      <i class="fa fa-edit"></i>
                    </a>
                    <form method="get" action="{{ route('flight-tickets.restore', $trash->id) }}">
                      <button class = "btn btn-sm btn-info me-2">
                        <i class="fa fa-repeat"></i>
                      </button>
                      @csrf
                    </form>
                    <form method="POST" action="{{ route('flight-tickets.delete', $trash->id) }}">
                      @method('DELETE')
                        <a href="#" {{-- data-bs-toggle ="modal" data-bs-target="#modal{{$flight->id}}" --}}>
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
    </x-card>
  </div>
</x-admin>