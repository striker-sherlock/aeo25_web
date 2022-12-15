<x-admin>
    <div class="container mt-4">
      <x-card>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Edit  {{$accommodation->room_type}}</h3>
        <form method="POST" action="{{ route('accommodations.update', $accommodation->id) }}" enctype="multipart/form-data">
          @csrf
          @method('UPDATE')
            <div class="form-group mb-3">
              <label class="col-form-label" for="room_type">Room Type<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="room_type" id="room_type" placeholder="Enter Type" value="{{ $accommodation->room_type }}">
            </div>

            <div class="form-group mb-3">
              <label class="col-form-label" for="max_guests">Max Guests<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="max_guests" id="max_guests" placeholder="Enter Number of Guests" value="{{$accommodation->max_guests}}">
            </div>

            <div class="form-group mb-3">
              <label class="col-form-label" for="price">Price<span class="text-danger">*</span></label>
              <input type="number" class="form-control" name="price" id="price" placeholder="Enter Number of Guests" value="{{$accommodation->price}}">
            </div>

            <div class="form-group mb-3">
              <label for="picture" class="col-form-label">Picture</label>
              <input type="text" class="form-control" name="picture_old" value="{{ $accommodation->picture }}" hidden>
              <input type="file" class="form-control" id="picture_new" name="picture_new" accept="image/png, image/jpeg, image/jpg">
              <small class="text-danger "  style="font-size: 0.7em">Type: png,jpg, jpeg max: 3MB</small>
            </div>
            @if ($accommodationFacilities->count() > 0)
              @foreach ($accommodationFacilities as $accommFacility)
                <div class="my-3">
                  <div class="form-check my-2">
                    </label>
                    <input class="form-check-input" type="checkbox"
                        value="1" name="{{ $accommFacility->facility_id }}"
                        id="{{ $accommFacility->id }}" {{ ($accommFacility->is_available) ? 'checked' : '' }}>
                    <label class="form-check-label" for="{{ $accommFacility->id }}">
                        {{ $accommFacility->facility->name }}
                    </label>
                  </div>
                </div>
              @endforeach
            @else
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
            @endif
            <div class="row my-4">
              <div class="col">
                <a href="{{ route("accommodations.index") }}" class="btn btn-outline-secondary rounded-pill mb-3 w-100">Back</a>
              </div>
              <div class="col">
                @method('PUT')
                <button type="submit" class="btn btn-outline-theme btn-rounded w-100 rounded-pill">Update</button>
              </div>
            </div>
        </form>
    </x-card>
  </div>
  </x-admin>