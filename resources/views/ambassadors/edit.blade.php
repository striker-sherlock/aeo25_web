<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
              <h1>Edit Ambassador</h1>
                <form action="{{route('ambassadors.update', $ambassador->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('UPDATE')
                    <div class="form-group mb-3">
                        <label for="name" class="col-form-label"> Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ $ambassador->name }}"  >
                    </div>
                    <div class="form-group mb-3">
                        <label for="institution" class="col-form-label">Institution <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="institution" value="{{ $ambassador->institution }}" >

                    </div>
                    <div class="form-group mb-3">
                        <label for="testimony" class="col-form-label">Testimony <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="testimony" rows="3"> {{ $ambassador->testimony }} </textarea>

                    </div>
                    <div class="form-group mb-3">
                        <label for="photo" class="col-form-label">Photo </label>
                        <input type="text" class="form-control" name="photo" value="{{ $ambassador->photo }}" hidden>
                        <input type="file" accept="image/jpg, image/png, image/jpeg" class="form-control" name="photo_new" >
                
                        <small>JPG, PNG, JPEG | Max 2MB</small>
                    </div>
                    @method('PUT')
                    <button type="submit" class="btn btn-outline-theme w-100 btn-rounded my-2">Update</button>
                </form>

            
</x-admin>