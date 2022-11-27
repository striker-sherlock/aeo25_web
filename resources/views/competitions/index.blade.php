<x-admin>
    <div class="container mt-4">
        <x-card>
          <h3 class="text-uppercase fw-bold text-gradient" style="letter-spacing: 0.1em">Competition List</h3>
                <div class="table-responsive py-2">
                    <table class="table table-sm table-striped table-bordered no-footer">
                      <thead class="thead-light">
                        <tr>
                          <th class="align-middle text-center">ID</th>
                          <th class="align-middle text-center">Name</th>
                          <th class="align-middle text-center">Fixed Quota</th>
                          <th class="align-middle text-center">Temp Quota</th>
                          <th class="align-middle text-center">Price</th>
                          <th class="align-middle text-center">Need Submission</th>
                          <th class="align-middle text-center">Need Team</th>
                          <th class="align-middle text-center">Max People</th>
                          <th class="align-middle text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($competitions as $competition)
                          <tr class="align-middle text-center">
                            <td>{{$competition->id}}</td>
                            <td>{{$competition->name}}</td>
                            <td>{{$competition->fixed_quota}}</td>
                            <td>{{$competition->temp_quota}}</td>
                            <td>Rp. {{ number_format($competition->price, 0, ',', '.') }}</td>
                            <td>{{($competition->need_submission) ? 'YES' : 'NO' }}</td>
                            <td>{{($competition->need_team) ? 'YES' : 'NO' }}</td>
                            <td>{{$competition->max_people}}</td>
                            <td class="d-flex justify-content-center">
                              <div class="btn-toolbar flex-nowrap justify-content-center" role="toolbar">
                                <a class ="btn btn-sm btn-primary me-2" href="{{ route('competitions.edit', $competition->id) }}" title="Edit">
                                  <i class="fa fa-edit"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
        </x-card>
    </div>
</x-admin>