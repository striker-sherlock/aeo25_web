<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <div class="container mt-5">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
               <h1 class="text-primary ">Add New Sponsors </h1>
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
                    <div class="col"><a href="{{route('sponsors.index')}}" class="btn btn-outline-dark w-100">Back</a></div>
                    <div class="col"><button type="submit" class="btn w-100 btn-outline-primary">Submit</button></div>
                </div>
              </form>
            </div>
        </div>
    </div>

        
</body>
</html>