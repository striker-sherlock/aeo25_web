<x-admin>
    <div class="container mt-3">
        <h1 class="display-4  fw-bold text-primary">Select The Competition Bellow</h1><hr class="mb-3">
        <form action="{{route('slot-registrations.store')}}" method="POST" enctype="multipart/form-data"> 
            <div class="row">
                @csrf
                @foreach ($competitions as $competition)    
                <div class="col-md-6">
                    <x-card>
                        <h3 class="text-center mb-3">{{$competition->name}}</h3>
                        <input type="text" name="compet_id[]" hidden value="{{$competition->id}}">
                        <div class="mx-auto text-center">
                            
                            @php ($slot = 3)
                            @if ($competition->temp_quota < $slot)
                                @php ($slot = $competition->temp_quota)
                            @else
                                @foreach ($competitionSlots as $competitionSlot) 
                                    @if($competitionSlot->competition_id == $competition->id) 
                                        @php ($slot -= $competitionSlot->quantity)
                                    @endif
                                @endforeach
                            @endif
                            
                            @for($i=0 ; $i <= $slot; $i++ )
                                @if ($slot == 0)
                                    <h5 class="border bg-danger text-white py-2 mx-auto" style="max-width:50%;">Out of Slot<h5>
                                    <input type="text" name="quantity[]-{{$competition->id}}" value="0" hidden>
                                    @break      
                                @endif
                                <input type="radio" class="btn-check" name="quantity[]-{{$competition->id}}" id="{{$competition->id.$i}}" value="{{$i}}" {{$i == 0 ? 'checked' : ''}} hidden>
                                <label class="btn btn-outline-secondary " for="{{$competition->id.$i}}">{{$i}}</label>
                            @endfor 
                        </div>
                    </x-card>
                </div>
                @endforeach         
            </div>
            <button type="submit" class="btn btn-outline-primary w-100 rounded mb-4">submit</button>
        </form>
    </div>
</x-admin>