<x-admin>
    <div class="container mt-4">
         <x-card>
            <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Create New Ambassadors </h3>
            <form action="{{route('ambassadors.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label for="name" class="col-form-label"> Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name"  >
                </div>
                <div class="form-group mb-3">
                    <label for="institution" class="col-form-label">Institution <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="institution"  >

                </div>
                <div class="form-group mb-3">
                    <label for="testimony" class="col-form-label">Testimony <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="testimony" rows="3"></textarea>

                </div>
                <div class="form-group mb-3">
                    <label for="photo" class="col-form-label">Photo <span class="text-danger">*</span></label>
                    <input type="file" accept="image/jpg, image/png, image/jpeg" class="form-control" name="photo">
                </div>

                <button type="submit" class="btn btn-outline-theme w-100 btn-rounded my-2">Submit</button>
            </form>
        </x-card>
    </div>
</x-admin>