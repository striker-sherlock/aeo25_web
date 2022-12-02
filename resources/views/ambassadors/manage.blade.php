<x-admin>
 <div class="container mt-4">
     
     <x-card>
      <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Manage Ambassadors </h3>
        <a href="{{ route('ambassadors.create') }}" class="btn btn-outline-theme  rounded-pill btn-rounded mb-3">Create New Ambassador</a>
      @if ($ambassadors->count())
      <div class="table-responsive py-2">
        <table class="table table-sm table-striped table-bordered " id="dataTables">
          <thead class="table-info">
            <tr>
              <th class="align-middle text-center">ID</th>
              <th class="align-middle text-center">Name</th>
              <th class="align-middle text-center">Institution</th>
              <th class="align-middle text-center">Testimony</th>
              <th class="align-middle text-center">Photo</th>
              <th class="align-middle text-center">Action</th>
            </tr>
          </thead>
            <tbody>
              @foreach ($ambassadors as $ambassador)
                <tr class="align-middle text-center">
                   <td>{{$ambassador->id}}</td>
                   <td>{{$ambassador->name}}</td>
                   <td>{{$ambassador->institution}}</td>
                   <td>{{$ambassador->testimony}}</td>
                   <td class="align-middle text-center">
                       <img src="/storage/images/ambassador/{{ $ambassador->photo }}"  width="75">
                   </td>
                   <td class="d-flex "  >
                       <a class ="btn btn-primary btn-sm mx-2" href="{{ route('ambassadors.edit', $ambassador->id) }}" title="Edit">
                       <i class="fa fa-edit"></i>
                       </a>
                       <form method="POST" action="{{ route('ambassadors.destroy', $ambassador->id) }}">
                        @csrf
                       @method('delete')
                       <button type="submit" class = "btn btn-sm  btn-danger mx-2" title="Delete" onclick="return confirm(&quot;Are you sure you want to delete this data?&quot;)">
                       <i class="fa fa-trash"></i>
                       </button>
                     
                       @csrf
                       </form>

                   </td>
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
      @else <hr><p class="text-center"> No Data</p>
      @endif
     </x-card>
 </div>

</x-admin>