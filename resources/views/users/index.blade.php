<x-admin>
    <div class="container mt-4">
        <x-card>
            <h3 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">National PIC</h3>
            @if ($nationalPIC->count())
            <div class="table-responsive py-2">
                <table class="table table-striped table-bordered dataTables" >
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Institution</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($nationalPIC as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <th>{{$user->pic_name}}</th>
                            <th>{{$user->email}}</th>
                            <th>{{$user->institution_name}}</th>
                            <th>{{$user->pic_phone_number}}</th>
                                
                            <th class="d-flex justify-content-center"> 
                                <a href="{{route('users.admin-edit', $user->id)}}" class="btn btn-primary btn-sm rounded me-2 " title="edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                            </th>
                        </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else <p class="text-center">No Data</p>
            @endif
        </x-card>
        <x-card>
            <h3 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">International PIC</h3>
            @if ($internationalPIC->count())
            <div class="table-responsive py-2">
                <table class="table table-striped table-bordered dataTables" >
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Institution</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($internationalPIC as $user)
                        <tr>
                            <th>{{$user->id}}</th>
                            <th>{{$user->pic_name}}</th>
                            <th>{{$user->email}}</th>
                            <th>{{$user->institution_name}}</th>
                            <th>{{$user->pic_phone_number}}</th>
                                
                            <th class="d-flex justify-content-center"> 
                                <a href="{{route('users.admin-edit', $user->id)}}" class="btn btn-primary btn-sm rounded me-2 " title="edit">
                                    <i class="fa fa-edit"></i>
                                </a>
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