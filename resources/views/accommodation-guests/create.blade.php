<x-user title="Create Accommodation Guests">
    <div class="container mt-4 ">
        <h1 class="fs-3">Accommodation Step 3</h1>
        <h2 class="display-5 fw-bold">Guest's Personal Detail</h2>
        <hr class="mb-4">
        <x-card>
            @php($maxPeople = 2*$accommodationSlot->quantity)
            @if ($accommodationSlot->accommodation->room_type == "Suite")@php($maxPeople = 4*$accommodationSlot->quantity)@endif
            <div class="row">
                <div class="col-md-4">
                    <label for="number" class="col-form-label text-danger m-0">* Select the number of guest first</label>
                    <input id="number" class="form-control my-3" type="number" min="{{1*$accommodationSlot->quantity}}" max="{{$maxPeople*$accommodationSlot->quantity}}" required >
                </div>
                <small class="text-muted" style="margin-top: -12px">{{$accommodationSlot->quantity}} room(s) {{$accommodationSlot->accommodation->room_type }} (MAX:{{$maxPeople}} Peoples) </small>
            </div>
 
            <form action="{{route('accommodation-guests.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <input type="text" value="{{$accommodationSlot->id}}" name="accommodation_slot_id" hidden>
                <input type="text" value="{{$accommodationSlot->user->id}}" name="user_id" hidden>
                <input type="text" value="{{$accommodationSlot->accommodation->id}}" name="accommodation_id" hidden>
                <div class="row append mt-4 ">
                    
                </div>
                <button type="submit" class="d-none btn btn-outline-primary w-100 rounded-pill">Submit</button>
            </form>
        </x-card>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('input[type="number"]').on('keyup change', function(e) {
                let max = parseInt($(this).attr('max'));
                let min = parseInt($(this).attr('min'));
                if ($(this).val() > max) $(this).val(max);
                else if ($(this).val() < min)$(this).val(min);
                $('button[type="submit"]').removeClass('d-none')
                console.log(document.querySelector('.append'));
                $(('.append')).empty();
                const loop = $(this).val();
                for (let i = 0; i < loop; i++){
                    $(('.append')).append(`
                    <div class="col-md-12 mb-5 border border-1 rounded-20 p-4 shadow-sm">
                        <h3 class="text-uppercase fw-bold" style="letter-spacing: 0.1em">Guest  ${i+1}</h3>
                        <div class="form-group mb-3">
                            <label for="guest_name${i}" class="col-form-label">Guest Name <span class="text-danger">*</span> </label>
                            <input type="text"  class="form-control"  name="guest_name[]" id="guest_name${i}" value="{{old('guest_name.${i}')}}" required>
                            @if ($errors->has('guest_name.${i}'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('guest_name.*') }}.</strong>
                            </span>
                            @endif
                        </div> 
                        <div class="form-group mb-2">
                            <label for="gender${i}" class="col-form-label">Gender<span class="text-danger">*</span></label>
                            <select class="form-select"  name="gender[]" id="gender${i}" required>
                                <option selected class="d-none" disabled>Select guest's gender</option>
                                <option value="M" >Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>      
                    </div>`);
                }
            });
        })
    </script>
</x-user>