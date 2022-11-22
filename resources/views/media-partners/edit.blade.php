<x-admin>
    
    <div class="container mx-5 px-5 mt-5">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
        <div class="card-header bg-secondary"></div>
        <div class="card-body my-3">
            <div class="my-2">
                <a class="" href="{{ route('media-partners.index') }}" title="Back to Main Menu">
                  <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>
              </div>
            <h3 class="fw-bold my-2 text-primary">Media Partners</h3>
            <h6> Edit Media Partner</h6>
            <form method="POST" action="{{route('media-partners.update', $media_partner->id) }}" enctype="multipart/form-data">
                @csrf
                @method('UPDATE')
                <div class="mb-3">
                    <label for="name" class="col-form-label">Media Partner Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $media_partner->name }}">
                </div>
                <div class="mb-3">
                    <label for="logo" class="col-form-label">Media Partner Logo</label>
                    <input type="text" class="form-control" name="logo" value="{{ $media_partner->logo }}" hidden>
                    <input type="file" accept="image/jpg, image/png, image/jpeg" class="form-control" name="logo_new" >
                </div>
                @method('PUT')
                <button type="submit" class="btn btn-outline-primary rounded-pill w-100">Update</button>
            </form>


        </div>


        



    </div>



</x-admin>
