<x-admin>
  <div class="container mt-4">
    <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
        <div class="card-header bg-secondary"></div>
        <div class="card-body my-3">
          <h1>Edit Country</h1>
            <form action="{{ route('countries.update', $country->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              {{-- @method('UPDATE') --}}
                <div class="form-group mb-3">
                  <label class="col-form-label" for="name">Country Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" value="{{ $country->name }}">
                </div>

                <div class="row my-4">
                  <div class="col">
                    <a href="{{ route("countries.index") }}" class="btn btn-outline-secondary btn-rounded w-100 mb-3">Back</a>
                  </div>
                  <div class="col">
                    {{-- @method('PUT') --}}
                    <button type="submit" class="btn btn-outline-primary btn-rounded w-100">Submit</button>
                  </div>
                </div>
            </form>
</x-admin>
