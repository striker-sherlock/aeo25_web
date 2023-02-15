<x-admin>
    <div class="container mt-4">
            <div class="card-header bg-secondary"></div>
                <x-card>
                    <h1 class="text-gradient">Create New Environment</h1>
                      <form action="{{route('environments.store')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="form-group mb-3">
                              <label class="col-form-label" for="env_code">Environment Code <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="env_code" id="env_code" placeholder="Enter code">
                          </div>
                          <div class="form-group mb-3">
                              <label for="env_name" class="col-form-label">Environment Name <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="env_name" placeholder="Enter name">
                          </div>
                          <div class="form-group mb-3">
                              <label for="start" class="col-form-label">Start Time</label>
                              <input type="text" class="form-control" name="start_time" placeholder="dd-mm-yyyy HH:mm">
                          </div>
                          <div class="form-group mb-3">
                              <label for="end" class="col-form-label">End Time</label>
                              <input type="text" class="form-control" name="end_time" placeholder="dd-mm-yyyy HH:mm">
                          </div>
                          <div class="row my-4">
                              <div class="col">
                                  <a href="{{ route("environments.index") }}" class="btn btn-outline-secondary btn-rounded w-100 mb-3">Back</a>
                              </div>
                              <div class="col">
                                  <button type="submit" class="btn btn-outline-theme btn-rounded w-100">Submit</button>
                              </div>
                          </div>
                      </form>

                </x-card>
    </div>
  </x-admin>
        