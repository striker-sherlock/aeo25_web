<x-admin>
    
    <div class="container mx-5 px-5 mt-5">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
        <div class="card-header bg-secondary"></div>
        <div class="card-body my-3">
            <div class="my-2">
                <a class="" href="{{ route('follow-up-types.index') }}" title="Back to Main Menu">
                  <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>
              </div>
            <h3 class="fw-bold my-2 text-primary">Follow Up Types</h3>
            <h6> Edit Follow Up Types</h6>
            <form method="POST" action="{{route('follow-up-types.update', $followUpType->id) }}" enctype="multipart/form-data">
                @csrf
                @method('UPDATE')
                <div class="mb-3">
                    <label for="name" class="col-form-label">Follow Up Type </label>
                    <input type="text" class="form-control" name="name" value="{{ $followUpType->name }}">
                </div>
                @method('PUT')
                <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Update</button>
            </form>


        </div>


        



    </div>



</x-admin>
