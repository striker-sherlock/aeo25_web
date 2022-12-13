<x-admin>
    <div class="container mt-4">
        <x-card>
            <h3 class="text-uppercase fw-bold text-gradient mb-4" style="letter-spacing: 0.1em">Admin Accounts</h3>
            @if ($admins->count())
            <div class="table-responsive py-2">
                <table class="table table-sm table-striped table-bordered dataTables" >
                    <thead class="text-center">
                    <tr>
                        <th class= "align-middle text-center" scope="col">ID</th>
                        <th class= "align-middle text-center" scope="col">Name</th>
                        <th class= "align-middle text-center" scope="col">Department ID</th>
                        <th class= "align-middle text-center" scope="col">Position</th>
                        <th class= "align-middle text-center" scope="col">Department</th>
                        <th class= "align-middle text-center" scope="col">Division</th>
                        <th class= "align-middle text-center" scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($admins as $admin)
                        <tr>
                            <th>{{$admin->id}}</th>
                            <th>{{$admin->name}}</th>
                            <th>{{$admin->department_id}}</th>
                            <th>{{$admin->position}}</th>
                            <th>{{$admin->department}}</th>
                            <th>{{$admin->division}}</th>
                                
                            <th > 
                                <div class="d-flex justify-content-center">

                                    <a href="{{route('admins.edit', $admin->id)}}" class="btn btn-primary btn-sm rounded me-2 " title="edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </th>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else <p class="text-center">No Data</p>
            @endif
        </x-card>
    </div>
</x-admin>