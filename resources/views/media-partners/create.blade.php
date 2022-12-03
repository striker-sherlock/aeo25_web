<x-admin>
    
    <div class="container mx-5 mt-5 px-5">
      <x-card>
          <div class="my-2">
            <a class="" href="{{ route('media-partners.index') }}" title="Back to Main Menu">
              <i class="fas fa-arrow-circle-left fa-2x p-4"></i>
            </a>
          </div>

          <h3 class="fw-bold  text-primary">Media Partners</h3>
          <h6> Create New Media Partner</h6>
          <form method="POST" action="{{ route('media-partners.store') }}" enctype="multipart/form-data">   
              @csrf
              <div class="mb-3">
                <label for="name" class="col-form-label">Media Partner Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name"  >
              </div>
              <div class="mb-3">
                <label for="logo" class="col-form-label">Media Partner Logo <span class="text-danger">*</span></label>
                <input type="file" accept="image/jpg, image/png, image/jpeg" class="form-control" name="logo" >
              </div>
              <button type="submit" class="btn btn-outline-theme rounded-pill w-100">Submit</button>
            </form>

          
        </div>
      </div>


    </x-card>
    </div>



</x-admin>
