<x-admin>
    <div class="container mt-4">
      <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
          <div class="card-header bg-secondary"></div>
          <div class="card-body my-3">
            <h1>Edit Score Type</h1>
              <form action="{{route('score-types.update', $scoreType->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('UPDATE')
                  <div class="form-group mb-3">
                    <label class="col-form-label" for="type_name">Type<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="type_name" id="type_name" placeholder="Enter Type" value="{{ $scoreType->type_name }}">
                  </div>
                  <div class="row my-4">
                    <div class="col">
                      <a href="{{ route("score-types.index") }}" class="btn btn-outline-secondary btn-rounded mb-3 w-100">Back</a>
                    </div>
                    <div class="col">
                    @method('PUT')
                      <button type="submit" class="btn btn-outline-primary btn-rounded w-100 ">Update</button>
                    </div>
                  </div>
              </form>
          </div>
      </div>
    </div>
</x-admin>