<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
              <h1>Edit Flight Ticket</h1>
                <form action="{{route('flight-tickets.update', $flight->id)}}" method="POST" enctype="multipart/form-data">
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
                    <button type="submit" class="btn btn-outline-theme w-100 btn-rounded my-2">Submit</button>
                </form>
</x-admin>