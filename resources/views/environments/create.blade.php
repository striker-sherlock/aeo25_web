<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
              <h1>Environment List</h1>
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
                        <input type="date" class="form-control" name="start" placeholder="Enter start time">
                    </div>
                    <div class="form-group mb-3">
                        <label for="end" class="col-form-label">End Time</label>
                        <input type="date" class="form-control" name="end" placeholder="Enter end time">
                    </div>
                    <div class="row my-4">
                        <div class="col">
                            <a href="{{ route("environments.index") }}" class="btn btn-outline-secondary btn-rounded w-100 mb-3">Back</a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-outline-primary btn-rounded w-100">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </x-admin>
        