<x-admin>
    <div class="container mt-4">
        <h2 class="fw-bold mb-2">Accommodation's Guest List</h2>
        <div class="row mb-4">
            <div class="col">
                <a href="{{route('accommodation-guests.index',)}}" class="btn btn-outline-primary w-100 rounded-pill {{$roomType == NULL ? 'active' : '' }}">All Guest</a>
            </div>
            @foreach ($accommodations as $accommodation)
            <div class="col">
                <a href="{{route('accommodation-guests.index',$accommodation->room_type)}}" class="btn btn-outline-primary w-100 rounded-pill {{$roomType == $accommodation->room_type ? 'active' : '' }}">{{$accommodation->room_type}}</a>
            </div>
            @endforeach   
        </div>
        <x-card> 
            @if ($roomType)<h3 class="text-uppercase fw-bold mb-4" style="letter-spacing: 0.1em">{{$roomType}}'s Guest List </h3>
            @else <h3 class="text-uppercase fw-bold mb-4" style="letter-spacing: 0.1em">All Guest List</h3>

            @endif
            @if ($guests->count())
                {{-- <a href="{{route('competition-participants.export',$competition->id)}}" class="btn btn-outline-success mb-4">Download Participant</a> --}}
                <table class="table table-striped table-bordered" id="data-table">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">PIC Name </th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Country</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($guests as $guest)
                            <tr class="text-center">
                                <th>{{$guest->id}}</th>
                                <th class="text-capitalize">{{$guest->user->pic_name}}</th>
                                <th>{{$guest->user->institution_name}}</th>
                                <th>{{$guest->user->country->name}}</th>
                                <th>
                                    <div class="d-flex justify-content-around">
                                        <a href="{{route('accommodation-guests.edit',$guest->id)}}" class="btn btn-primary btn-sm me-2">E</a>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>
    </div>
</x-admin>