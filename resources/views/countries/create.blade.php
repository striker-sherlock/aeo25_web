<x-admin>
  <div class="container mt-4">
    <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
        <div class="card-header bg-secondary"></div>
        <div class="card-body my-3">
          <h1>Create Country</h1>
            <form action="{{route('countries.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
                <div class="form-group mb-3">
                  <label class="col-form-label" for="name">Country Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{old('name')}}">
                </div>
                <div class="row my-4">
                  <div class="col">
                    <a href="{{ route("countries.index") }}" class="btn btn-outline-secondary btn-rounded mb-3 w-100">Back</a>
                  </div>
                  <div class="col">
                    <button type="submit" class="btn btn-outline-theme btn-rounded w-100 ">Create</button>
                  </div>
                </div>
            </form>
        </div>
    </div>
  </div>
</x-admin>