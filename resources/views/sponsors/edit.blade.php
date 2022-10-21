<x-admin>
    
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <h1>Edit Sponsor</h1>
                <form action="{{route('sponsors.update',$sponsor->id)}}" method="POST" enctype="multipart/form-data" >
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="nama" class="col-form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text"  class="form-control"  placeholder="Enter sponsor's name" name="nama" id="nama" value="{{$sponsor->name}}" required>
                    </div>
    
                    <div class="form-group mb-3">
                        <label for="logo_new" class="col-form-label">Logo<span class="text-danger">*</span></label>
                        <input type="file"  class="form-control"  name="logo_new" id="logo_new" accept="image/png,image/jpeg,image/jpg">    
                        <small class="text-danger "  style="font-size: 0.7em">Type: png,jpg, jpeg max: 2MB</small>
                    </div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-image" class="btn btn-outline-info rounded btn-sm">View Current Logo</a>
                    <input type="text" name ="logo_old" value="{{$sponsor->logo}}" hidden>
    
                    <div class="form-group mb-3">
                        <label for="nama" class="col-form-label" >Status<span class="text-danger">*</span></label>
                        <select class="form-control" name="is_showed" id="is_showed" required>
                          <option value="1" {{$sponsor->is_showed == 1  ? 'selected' : ''}}>Showed </option>
                          <option value="0" {{$sponsor->is_showed == 0  ? 'selected' : ''}}>Hidden</option>
                        </select>    
                    </div>
                    <div class="row">
                        <div class="col"><a href="{{route('sponsors.index')}}" class="btn btn-outline-dark w-100">Back</a></div>
                        <div class="col"><button type="submit" class="btn w-100 btn-outline-primary">Update</button></div>
                    </div>
                  </form>
            </div>

        </div>
    </div>
    <div class="modal fade" id="modal-image" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <img src="/storage/sponsor/logo/{{$sponsor->logo}}" class="img-fluid" alt="sponsor's logo">
        </div>
    </div>
</x-admin>
 