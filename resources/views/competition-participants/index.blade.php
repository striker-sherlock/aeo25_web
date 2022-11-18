<x-admin>
    <div class="container mt-4">
        {{-- {{dd($competitionParticipants[0]->user->country)}} --}}
        <x-card>
            <h2 class="fw-bold">{{$competition->name}}'s Participants</h2>
            @if ($competitionParticipants->count())
                <table class="table table-striped table-bordered">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">{{$competitionParticipants[0]->competition->need_team == 1 ? 'Team' : 'Participant Name'}}</th>
                        <th scope="col">Institution Name</th>
                        <th scope="col">Country</th>
                        <th scope="col">PIC Name </th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($competitionParticipants as $participant)
                        <tr class="text-center">
                            <th>{{$participant->id}}</th>
                            <th>{{$participant->competition->need_team == 1 ? $participant->competitionTeam->name : $participant->name}}</th>
                            <th>{{$participant->user->institution_name}}</th>
                            <th>{{$participant->user->country->name}}</th>
                            <th>{{$participant->user->pic_name}}</th>
                            <th>
                                <div class="d-flex justify-content-around">
                                    {{-- <a href="{{route('competition-payments.cancel',$payment->id)}}" class="btn btn-outline-warning" title="cancel payment">X</a> --}}
                                    {{-- <a href="{{route('competition-payments.reject')}}" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#reason{{$payment->id}}" >R</a> --}}
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