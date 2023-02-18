<x-admin>
    <div class="container py-3 my-3">
        <div class="d-flex justify-content-center align-items-center flex-wrap">
            @foreach ($competitions as $competition)
            <div class="btn btn-outline-theme {{ $selectedField->id == $competition->id ? 'bg-primary text-white' : '' }} mx-2 mb-3 p-2">
                <a class="text-decoration-none text-reset" href="{{route('side-achievements.create', $competition->id)}}">
                    {{ $competition->name }}
                </a>
            </div>
            @endforeach
        </div>
            <div class="mt-2">
                <x-card>
                    <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Create New Side Achievement </h3>
                    <hr>
                        <h4 class="fw-bold text-center mt-4">Please Fill The Participant Detail</h4>
                        <form action="{{route('side-achievements.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row justify-content-center align-items-center">
                                <div class="col-11">
                                    <div class="form-group my-2">
                                        <label class="col-form-label" for="participant_id">Participant's Name </label>
                                        <select class="form-select rounded-20 mt-2" name="participant_id" id="participant_id" required>
                                            @if ($competitionParticipants->count() == 0)
                                                <option value="" selected disabled>No Data</option>
                                                @else
                                                    @foreach ($competitionParticipants as $participant)
                                                        <option value="{{$participant->id}}">{{$participant->name}}</option>
                                                    @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group my-2">
                                        <label class="col-form-label" for="name">Side Achievement Detail</label>
                                        <input class="form-control rounded-20 mt-2" type="text" name="name" id="name" required>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col">
                                            <a href="{{ route("side-achievements.index") }}" class="btn btn-outline-secondary btn-rounded mb-3 w-100">Back</a>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-outline-theme btn-rounded w-100 ">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </x-card>
            </div>
    </div>
</x-admin>




