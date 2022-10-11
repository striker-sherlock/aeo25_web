<a href="{{ route('countries.create') }}" class="btn btn-primary rounded-20 mb-3">Create New Country</a>
<div class="table-responsive py-2">
    <table class="table table-sm table-striped table-bordered no-footer">
      <thead class="thead-light">
        <tr>
          <th class="align-middle text-center">ID</th>
          <th class="align-middle text-center">Created At</th>
          <th class="align-middle text-center">Updated At</th>
          <th class="align-middle text-center">Name</th>
          <th class="align-middle text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($countries as $country)
          <tr class="align-middle text-center">
            <td>{{$country->id}}</td>
            <td class="align-middle text-center">
                @if ($country->created_at == null)
                    NO DATA
                    @else
                    {{ $country->created_at }}
                @endif
            </td>
            <td class="align-middle text-center">
                @if ($country->updated_at == null)
                    NO DATA
                    @else
                    {{ $country->updated_at }}
                @endif
            </td>        
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