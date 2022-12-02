<x-admin>
    <div class="container mt-5">
        <x-card>
            <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Create New Sponsor</h3>
           <form action="{{route('sponsors.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="form-group mb-3">
                <label for="nama" class="col-form-label">Nama <span class="text-danger">*</span></label>
                <input type="text"  class="form-control"  placeholder="Enter sponsor's name" name="nama" id="nama" value="{{old('nama')}}" required>
                
            </div>

            <div class="form-group mb-3">
                <label for="logo" class="col-form-label">Logo<span class="text-danger">*</span></label>
                <input type="file"  class="form-control"  name="logo" id="logo" accept="image/png,image/jpeg,image/jpg" required>    
                <small class="text-danger "  style="font-size: 0.7em">Type: png,jpg, jpeg max: 2MB</small>
            </div>

            <div class="form-group mb-3">
                <label for="nama" class="col-form-label" >Status<span class="text-danger">*</span></label>
                <select class="form-control" name="is_showed" id="is_showed" required>
                  <option value="1" {{old('is_showed') == '1' ? 'selected' : ''}}>Showed </option>
                  <option value="0" {{old('is_showed') == '0' ? 'selected' : ''}}>Hidden</option>
                </select>    
            </div>
            
            <div class="row">
                <div class="col"><a href="{{route('sponsors.index')}}" class="btn btn-outline-dark w-100 rounded-pill">Back</a></div>
                <div class="col"><button type="submit" class="btn w-100 rounded-pill btn-outline-theme">Submit</button></div>
            </div>
          </form>
    </x-card>
</div>
</x-admin>
     

  