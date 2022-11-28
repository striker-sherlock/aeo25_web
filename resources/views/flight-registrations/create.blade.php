<x-user title="Create Flight Registration">
    <div class="container mt-4">
        <x-card>
              <h1>Create Flight Registration</h1>
                <form action="{{route('flight-registrations.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="type">Type <span class="text-danger">*</span></label><br>
                        <input type="radio" name="type" id="DEPARTURE" value="DEPARTURE">
                        <label for="DEPARTURE">Departure</label>
                        <input type="radio" name="type" id="ARRIVAL" value="ARRIVAL">
                        <label for="DEPARTURE">Arrival</label>
                    </div>
                    <div class="form-group mb-3">
                        <label for="airline_name" class="col-form-label">Airline Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="airline_name" placeholder="Enter Airline Name" value="{{old('airline_name')}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="flight_time" class="col-form-label">Flight Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="flight_time" placeholder="Enter Flight Time" name="flight_time" required value="{{old('flight_time')}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="ticket_proof" class="col-form-label">Ticket Proof <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="ticket_proof[]" accept="image/png, image/jpeg, image/jpg" multiple>
                        <small class="text-danger "  style="font-size: 0.7em">Type: png,jpg, jpeg max: 3MB</small>
                    </div>
                    <button type="submit" class="btn btn-outline-theme w-100 btn-rounded my-2">Submit</button>
                </form>
            </x-card>
    </div>
</x-user>