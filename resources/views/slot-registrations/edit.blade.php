<x-admin>
    <div class="container mt-4">
        {{-- {{dd($competitionSlots)}} --}}
        <x-card>
            <h4>Slot Registration</h4>
            <h2 class="fw-bold text-capitalize">{{$pic->pic_name}} - slot detail</h2>
            <hr>
            {{-- <a href=""></a> --}}
            <table class="table table-striped table-bordered">
                <thead class="text-center">
                    <tr>
                        <th scope="col">Competition Field</th>
                        <th scope="col">Registered</th>
                        <th scope="col"> Total Registered Slot</th>
                        <th scope="col"> Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($competitionSlots as $competitionSlot)
                    <form action="{{route('slot-registrations.update',$competitionSlot)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <input type="text" hidden value="{{$competitionSlot->competition->id }}" name="compet_id">
                         <tr>
                            <th>{{$competitionSlot->competition->name}}</th>
                            <th>{{  \Carbon\Carbon::parse($competitionSlot->created_at)->diffForHumans()}}</th>
                            <th>
                                <div class="form-row">
                                    <div class="col">
                                        <input type="number" class="form-control" value="{{$competitionSlot->quantity}}" name="quantity" min="0" max="{{$competitionSlot->competition->id == 'OBS' ||$competitionSlot->competition->id == 'IA' ? '' : '3' }}">
                                    </div>
                                </div>
                            </th>
                            <th>
                                <button type="submit" class="btn btn-outline-theme w-100 rounded-20">Submit</button>
                            </th>
                        </tr>
                    </form>
                    @endforeach
                </tbody>
            </table>
        </x-card>
    </div>
</x-admin>