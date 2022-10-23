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
                            <button class = "btn btn-sm btn-danger" onclick="return confirm('confirm')" title="Delete">
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
      </div>
  </div>
</div>
</x-admin>