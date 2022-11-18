<x-admin>
    <div class="container mt-4">
      <x-card>
            <h1>Create Accomodation Slot</h1>
              <form action="{{route('accommodation-slot-registrations.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                  <label class="col-form-label" for="room_type">Room Type<span class="text-danger">*</span></label>
                  <select name="accommodation_id" id="accommodation_id" class="form-select" required>
                    <option value="" selected disabled class="d-none">Choose...</option>
                      @foreach($accommodations as $accommodation)
                        <option value="{{ $accommodation->id }}">{{ $accommodation->room_type }}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group mb-3">
                  <label for="check_in_date" class="col-form-label">Check In Date <span class="text-danger">*</span></label>
                  <input type="datetime-local" class="form-control" id="check_in_date" placeholder="Enter Check In Date" name="check_in_date" required value="{{old('check_in_date')}}">
                </div>

                <div class="form-group mb-3">
                  <label for="check_out_date" class="col-form-label">Check Out Date <span class="text-danger">*</span></label>
                  <input type="datetime-local" class="form-control" id="check_out_date" placeholder="Enter Check Out Date" name="check_out_date" required value="{{old('check_out_date')}}">
                </div>

                <div class="form-group mb-3">
                  <label class="col-form-label" for="special_req">Special Request <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="special_req" id="special_req" placeholder="Enter Request" value="{{old('special_req')}}">
                </div>

                <div class="form-group mb-3">
                  <label class="col-form-label" for="quantity">Total Room <span class="text-danger">*</span></label>
                  <input type="number" class="form-control" name="quantity" id="max_guests" placeholder="Enter Number of Room for Order" value="{{old('quantity')}}">
                </div>
                <button type="submit" class="btn btn-outline-primary w-100 rounded mb-4">Submit</button>
              </form>
      </x-card>
    </div>
  </x-admin>