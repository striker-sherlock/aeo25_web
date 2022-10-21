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
                <h3 class="fw-bold  text-primary">Inventory</h3>
                <h6> Create New Item</h6>
                <form method="POST" action="{{ route('inventories.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="item_name" class="">Item Name</label>
                        <input type="text" class="form-control" name="item_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" name="qty" required>
                    </div>
                    <div class="mb-3">
                        <label for="borrowed_by" class="">Borrowed By</label>
                        <input type="text" class="form-control" name="borrowed_by" required>
                    </div>

                    <div class="mb-3">
                        <label for="borrowed_from" class="">Borrowed From</label>
                        <input type="text" class="form-control" name="borrowed_from" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="">Status</label>
                        <input type="text" class="form-control" name="status" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="">Location</label>
                        <input type="text" class="form-control" name="location" required>
                    </div>

                    <div class="mb-3">
                        <label for="additional_notes" class="">Additional Notes</label>
                        <textarea class="form-control" name="additional_notes" rows="3"></textarea>

                    </div>


                    <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Submit</button>
                </form>

            </div>

        </div>
    </div>

</x-admin>
