<x-admin>
    <div class="container mt-4">
        <x-card>
            <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Create New Merchandise</h3>
           <form action="{{route('merchandises.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="form-group mb-3">
                <label for="nama" class="col-form-label">Nama <span class="text-danger">*</span></label>
                <input type="text"  class="form-control"   name="nama" id="nama" value="{{old('nama')}}" required>
                
            </div>

            <div class="form-group mb-3">
                <label for="type" class="col-form-label" >Type<span class="text-danger">*</span></label>
                <select class="form-control" name="type" id="type" required>
                    <option value="" class="d-none" disabled selected> Choose ... </option>    
                    <option value="piece" {{old('type') == 'piece' ? 'selected' : ''}}>Piece</option>
                    <option value="bundle" {{old('type') == 'bundle' ? 'selected' : ''}}>Bundle</option>
                </select>    
            </div>

            <div class="form-group mb-3">
                <label for="price" class="col-form-label">Price <span class="text-danger">*</span></label>
                <input type="text"  class="form-control"   name="price" id="price" value="{{old('price')}}" required>
                
            </div>

            <div class="form-gruop mb-3">
                <label for="product_detail" class="col-form-label">Product Detail <span class="text-danger">*</span></label>
                <textarea class="form-control text-area" name="product_detail"  id="product_detail" rows="2"></textarea>
            </div>

           

            <div class="form-group mb-3">
                <label for="image" class="col-form-label">Image<span class="text-danger">*</span></label>
                <input type="file"  class="form-control"  name="image[]" id="image" accept="image/png,image/jpeg,image/jpg" required multiple>    
                <small class="text-danger"  style="font-size: 0.7em">Type: PNG, JPG, JPEG | Max: 2MB</small>
            </div>

            
            <div class="row">
                <div class="col"><a href="{{route('merchandises.index')}}" class="btn btn-outline-dark w-100 rounded-pill">Back</a></div>
                <div class="col"><button type="submit" class="btn w-100 rounded-pill btn-outline-theme">Submit</button></div>
            </div>
          </form>
    </x-card>
</div>
</x-admin>
     

  