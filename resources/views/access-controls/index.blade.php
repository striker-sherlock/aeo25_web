<x-admin title="Access Control">
    <div class="container mt-3">
        <x-card>
            <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Access Controll List </h3>
          @if ($admins->count() > 0)
            <div class="table-responsive py-2">
              <table class="table table-sm table-striped table-bordered no-footer" id="dataTables">
                <thead class="thead-light">
                  <tr>
                    <th class="align-middle text-center">ID</th>
                    <th class="align-middle text-center">Name</th>
                    <th class="align-middle text-center">Division</th>
                    <th class="align-middle text-center">Position</th>
                    <th class="align-middle text-center">Accesses</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($admins as $user)
                    <tr class="align-middle text-center">
                      <td>{{$user->id}}</td>
                      <td>{{$user->name}}</td>
                      <td>{{$user->division}}</td>
                      <td>{{$user->position}}</td>
                      <td><a href="{{route("access-controls.show",$user->id)}}" class="btn btn-primary"> Access list</a></td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <p class="text-center">No Data</p>
          @endif
        </x-card>
    </div>
  </x-admin>