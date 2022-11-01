<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <a class=" my-2 " href="{{ route('inventories.index') }}" title="Back to Main Menu">
                  <i class="fas fa-arrow-circle-left fa-2x"></i>
                  </a>
                  <h3 class="fw-bold  text-primary">Inventory</h3>
                  <h6> Edit Item</h6>
                  <form method="POST" action="{{ route('inventories.update', $inventory->id) }}" enctype="multipart/form-data">   
                      @csrf
                      <div class="mb-3"> 
                        <label for="item_name" class="">Item Name</label>
                        <input type="text" class="form-control" value="{{ $inventory->item_name }}" name="item_name" >
                      </div>
                      <div class="mb-3">
                        <label for="qty">Quantity</label>
                        <input type="number"  class="form-control" name="qty" value="{{ $inventory->qty }}" >
                      </div>
                      <div class="mb-3">
                        <label for="borrowed_by" class="">Borrowed By</label>
                        <input type="text" class="form-control" name="borrowed_by" value="{{ $inventory->borrowed_by }}" >
                      </div>

                      <div class="mb-3">
                        <label for="borrowed_from" class="">Borrowed From</label>
                        <input type="text" class="form-control" name="borrowed_from" value="{{ $inventory->borrowed_from }}">
                      </div>
                      <div class="mb-3">
                        <label for="status" class="">Status</label>
                        <input type="text" class="form-control" name="status" value="{{ $inventory->status }}" >
                      </div>
                      <div class="mb-3">
                        <label for="location" class="">Location</label>
                        <input type="text" class="form-control" name="location" value="{{ $inventory->location }}" >
                      </div>
                      
                      <div class="mb-3">
                        <label for="additional_notes" class="">Additional Notes</label>
                        <textarea class="form-control" name="additional_notes" rows="3" > {{ $inventory->additional_notes }}</textarea>

                      </div>

                      
                      @method('PUT')
                      <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Submit</button>
                    </form>
                
            </div>

        </div>
    </div>

</x-admin>