<x-admin>
    <div class="container mt-4">
      <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
          <div class="card-header bg-secondary"></div>
          <div class="card-body my-3">
            <h1>Edit Accomodation</h1>
              <form action="{{ route('accomodations.update', $accomodation->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- @method('UPDATE') --}}
                <div class="form-group mb-3">
                    <label class="col-form-label" for="room_type">Room Type<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="room_type" id="room_type" placeholder="Enter Type" value="{{ $accomodation->name }}">
                  </div>

                  <div class="form-group mb-3">
                    <label class="col-form-label" for="max_guests">Max Guests<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="max_guests" id="max_guests" placeholder="Enter Number of Guests" value="{{$accomodation->max_guests}}">
                  </div>

                  <div class="form-group mb-3">
                    <label for="picture" class="col-form-label">Picture <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="picture_old" value="{{ $accomodation->picture }}" hidden>
                    <input type="file" class="form-control" id="picture_new" name="picture_new" required accept="image/png, image/jpeg, image/jpg">
                    <small class="text-danger "  style="font-size: 0.7em">Type: png,jpg, jpeg max: 3MB</small>
                  </div>

                  <div class="row my-4">
                    <div class="col">
                      <a href="{{ route("accomodations.index") }}" class="btn btn-outline-secondary btn-rounded mb-3 w-100">Back</a>
                    </div>
                    <div class="col">
                      <button type="submit" class="btn btn-outline-primary btn-rounded w-100 ">Create</button>
                    </div>
                  </div>
                  </div>
              </form>
  </x-admin>
  