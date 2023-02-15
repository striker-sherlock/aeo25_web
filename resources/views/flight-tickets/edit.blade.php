<x-layout>
    <x-navbar></x-navbar>
    <div class="container mt-5">
        <form action="{{route('flight-tickets.update', $flight->id)}}" method="POST" enctype="multipart/form-data">
            <x-card>
                <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Edit {{$flight->airline_name}} Flight Ticket </h3>
                @csrf
                @method('UPDATE')
                <div class="form-group mb-3">
                    <label class="col-form-label" for="type">Type <span class="text-danger">*</span></label><br>
                    <input type="radio" name="type" id="DEPARTURE" value="DEPARTURE"{{ $flight->type == "DEPARTURE" ? 'checked' : '' }}>
                    <label for="DEPARTURE">Departure</label>
                    <input type="radio" name="type" id="ARRIVAL" value="ARRIVAL"{{ $flight->type == "ARRIVAL" ? 'checked' : '' }}>
                    <label for="DEPARTURE">Arrival</label>
                </div>
                <div class="form-group mb-3">
                    <label for="airline_name" class="col-form-label">Airline Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="airline_name" placeholder="Enter Airline Name" value="{{$flight->airline_name}}">
                </div>
                <div class="form-group mb-3">
                    <label for="flight_time" class="col-form-label">Flight Time <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="flight_time" placeholder="Enter Flight Time" name="flight_time" required value="{{$flight->flight_time}}">
                </div>
                <div class="form-group mb-3">
                    <input type="text" hidden name="ticket_proof_old[]" value="{{$flight->ticket_proof}}" hidden>
                    <label for="ticket_proof" class="col-form-label">Ticket Proof <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" name="ticket_proof_new[]" accept="image/png, image/jpeg, image/jpg" multiple>
                    <small class="text-danger "  style="font-size: 0.7em">Type: png,jpg, jpeg max: 3MB</small>
                </div>
                @method('PUT')
            </x-card>
            @if (Auth::guard('admin')->check())
                <x-card>
                    <h3 class="text-uppercase fw-bold text-gradient mb-4" style="letter-spacing: 0.1em">Select Pick Up Schedule</h3>
                    <div class="form-group mb-2">
                        <label for="schedule" class="col-form-label">Pick Up Schedule<span class="text-danger">*</span></label>
                        <select class="form-select"  name="schedule" id="schedule" >  
                            <option selected class="d-none" disabled id="first-option"> Please select the pick up schedule </option>
                            @foreach ($schedules as $schedule)
                                <option value="{{$schedule->id}}" {{$flight->schedule_id == $schedule->id? 'selected' : ''}} >{{date('D, d M Y h:i',strtotime($schedule->schedule))}} (GMT + 7)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="people" class="col-form-label">How many people will be there <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="people" placeholder="" value="{{$flight->number_of_people}}">
                    </div>
                </x-card>
            @endif
            <button type="submit" class="btn btn-outline-theme w-100 rounded-pill my-2">Save Changes</button>
        </form>
    </div>
    <x-footer></x-footer>
</x-layout>