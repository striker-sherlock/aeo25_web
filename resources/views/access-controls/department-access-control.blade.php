<x-admin  >
    <div class="container mt-4">
        <x-card>
            <a href="{{ route('access-controls.index') }}" class="btn btn-outline-secondary mb-3"> Back </a>
            <x-slot name="subtitle">access control</x-slot>
            <h3 class="text-uppercase fw-bold  text-gradient mb-4" style="letter-spacing: 0.1em">Access List - {{$department}}</h3>
            <form action="{{ route("access-controls.department-store") }}" method="POST">
                @csrf
                <input type="hidden" name="department_id" value="{{$departmentID}}">
                @if ($accesses->count() > 0)
                    <div class="table-responsive py-2">
                        <table class="table table-sm table-striped table-bordered no-footer">
                            <thead class="thead-light">
                                <tr>
                                <th class="align-middle text-center">Access ID</th>
                                <th class="align-middle text-center">Access Name</th>
                                <th class="align-middle text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accesses as $access)
                                <tr class="align-middle text-center">
                                    <td>{{$access->id}}</td>
                                    <td>{{$access->name}}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="access_id[]" value="{{$access->id}}">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-primary w-100 rounded-pill"> Submit</button>
                        </div>
                    </div>
                @else
                <hr>
                    <p class="text-center">No Access List</p>
                    <a href="{{route('accesses.create')}}" class="d-block w-50 btn btn-outline-primary mx-auto rounded-pill">Create Access </a>
                @endif
            </form>
        </x-card>
    </div>
</x-admin>