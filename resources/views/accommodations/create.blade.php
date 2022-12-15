<x-admin>
    <div class="container mt-4">
      <x-card>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Create New Accommodation </h3>
          <form action="{{route('accommodations.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="form-group mb-3">
                <label class="col-form-label" for="room_type">Room Type <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="room_type" id="room_type" placeholder="Enter Type" value="{{old('room_type')}}">
              </div>
              <div class="form-group mb-3">
                <label class="col-form-label" for="max_guests">Max Guests <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="max_guests" id="max_guests" placeholder="Enter Number of Guests" value="{{old('max_guests')}}">
              </div>
              <div class="form-group mb-3">
                <label class="col-form-label" for="max_guests">Price <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="price" id="price" placeholder="Enter Room Price" value="{{old('price')}}">
              </div>
              <div class="form-group mb-3">
                <label for="picture" class="col-form-label">Picture <span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="picture" name="picture" required accept="image/png, image/jpeg, image/jpg">
                <small class="text-danger "  style="font-size: 0.7em">Type: png,jpg, jpeg max: 3MB</small>
              </div>
              <label for="check_facilities" class="mb-2">Put a check mark on the facilities that <b>will be included</b> in the room. <span class="text-danger">*</span>
              </label>
              @if ($facilities->count() > 0)
                @foreach ($facilities as $facility)
                  <div class="my-3">
                    <div class="form-check my-2">
                      </label>
                      <input class="form-check-input" type="checkbox"
                          value="1" name="{{ $facility->id }}"
                          id="{{ $facility->id }}" {{ old($facility->id) == 1 ? 'checked' : '' }}>
                      <label class="form-check-label" for="{{ $facility->id }}">
                          {{ $facility->name }}
                      </label>
                    </div>
                  </div>
                @endforeach
              @endif
              <div class="row my-4">
                <div class="col">
                  <a href="{{ route("accommodations.index") }}" class="btn btn-outline-secondary btn-rounded mb-3 w-100">Back</a>
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-outline-theme btn-rounded w-100 ">Create</button>
                </div>
              </div>
          </form>
        </x-card>
    </div>
</x-admin>