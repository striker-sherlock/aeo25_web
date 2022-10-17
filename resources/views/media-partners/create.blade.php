<x-layout>
    
    <div class="container mx-5 px-5">
        <a class="btn btn-primary rounded-pill my-4" href="{{ route('media-partners.manage') }}" title="Back to Main Menu">
            <i class="fa-solid fa-square-caret-left"></i>
        </a>
        <h3 class="fw-bold my-3 text-primary">Media Partners</h3>
        <h6> Create New Media Partner</h6>
        <form method="POST" action="{{ route('media-partners.store') }}" enctype="multipart/form-data">   
            @csrf
            <div class="mb-3">
              <label for="name" class="">Media Partner Name</label>
              <input type="text" class="form-control" name="name"  >
            </div>
            <div class="mb-3">
              <label for="logo">Media Partner Logo</label>
              <input type="file" accept="image/jpg, image/png, image/jpeg" class="form-control" name="logo" >
            </div>
            <button type="submit" class="btn btn-primary rounded-pill w-100">Submit</button>
          </form>



    </div>



</x-layout>
