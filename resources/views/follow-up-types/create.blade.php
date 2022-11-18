<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
              <div class="my-2">
                <a class="" href="{{ route('inventories.index') }}" title="Back to Main Menu">
                  <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>

              </div>
                <h3 class="fw-bold  text-primary">Follow Up Types</h3>
                <h6> Create New Follow Up Type</h6>
                <form method="POST" action="{{ route('follow-up-types.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Follow Up Type <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Submit</button>
                </form>

            </div>

        </div>
    </div>

</x-admin>
