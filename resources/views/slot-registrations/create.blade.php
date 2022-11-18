<x-admin>
    <div class="container mt-3">
        <h1 class="display-4  fw-bold text-primary">Select The Competition Below</h1><hr class="mb-3">
        <form action="{{route('slot-registrations.store')}}" method="POST" enctype="multipart/form-data"> 
            <div class="row">
                @csrf
                @foreach ($competitions as $competition)    
                <div class="col-md-6">
                    <x-card>
                        <h3 class="text-center mb-3">{{$competition->name}}</h3>
                        <input type="text" name="compet_id[]" hidden value="{{$competition->id}}">
                        <div class="mx-auto text-center">
                            @for($i=0 ; $i <= 3; $i++ )
                                <input type="radio" class="btn-check" name="quantity[]-{{$competition->id}}" id="{{$competition->id.$i}}" value="{{$i}}" {{$i == 0 ? 'checked' : ''}}>
                                <label class="btn btn-outline-secondary" for="{{$competition->id.$i}}">{{$i}}</label>
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