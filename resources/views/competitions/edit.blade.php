<x-admin>
    <x-card>
        <h1>Edit Competition</h1>
              <form method="POST" action="{{ route('competitions.update', $competition->id) }}" enctype="multipart/form-data">
                @csrf
                @method('UPDATE')
                  <div class="form-group mb-3">
                    <label class="col-form-label" for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" value="{{ $competition->name }}">
                  </div>
                  <div class="form-group mb-3">
                    <label class="col-form-label" for="fixed_quota">Fixed Quota <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="fixed_quota" id="fixed_quota" placeholder="Enter Fixed Quota" value="{{$competition->fixed_quota}}">
                  </div>
                  <div class="form-group mb-3">
                    <label class="col-form-label" for="temp_quota">Temp Quota <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="temp_quota" id="temp_quota" placeholder="Enter Temp Quota" value="{{$competition->temp_quota}}">
                  </div>
                  <div class="form-group mb-3">
                    <label class="col-form-label" for="price">Price <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="price" id="price" placeholder="Enter Price" value="{{$competition->price}}">
                  </div>

                  <div class="form-group mb-3">
                    <label class="col-form-label" for="content">Content <span class="text-danger">*</span></label>
                    <textarea class="form-control text-area" name="content" rows="3" id="content" placeholder="Enter Content" value="{{ $competition->content }}"></textarea>
                  </div>

                  <div class="form-group mb-3">
                    <label for="picture" class="col-form-label">Logo </label>
                    <input type="text" class="form-control" name="logo_old" value="{{ $competition->logo }}" hidden>
                    <input type="file" class="form-control" id="logo_new" name="logo_new" accept="image/png, image/jpeg, image/jpg">
                    <small class="text-danger "  style="font-size: 0.7em">Type: png,jpg, jpeg max: 3MB</small>
                  </div>
                  <div class="form-group mb-3">
                    <label class="col-form-label" for="type">Need Submission <span class="text-danger">*</span></label><br>
                    <input type="radio" name="need_submission" id="1" value="1"{{ $competition->need_submission == "1" ? 'checked' : '' }}>
                    <label for="1">Yes</label>
                    <input type="radio" name="need_submission" id="0" value="0"{{ $competition->need_submission == "0" ? 'checked' : '' }}>
                    <label for="0">No</label>
                </div>
                <div class="form-group mb-3">
                    <label class="col-form-label" for="type">Need Team <span class="text-danger">*</span></label><br>
                    <input type="radio" name="need_team" id="1" value="1"{{ $competition->need_team == "1" ? 'checked' : '' }}>
                    <label for="DEPARTURE">Yes</label>
                    <input type="radio" name="need_team" id="0" value="0"{{ $competition->need_team == "0" ? 'checked' : '' }}>
                    <label for="DEPARTURE">No</label>
                </div>
                <div class="form-group mb-3">
                    <label class="col-form-label" for="max_people">Max People <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="max_people" id="max_people" placeholder="Enter Max People" value="{{$competition->max_people}}">
                  </div>
                  <div class="row my-4">
                    <div class="col">
                      <a href="{{ route("competitions.index") }}" class="btn btn-outline-secondary btn-rounded mb-3 w-100">Back</a>
                    </div>
                    <div class="col">
                      @method('PUT')
                      <button type="submit" class="btn btn-outline-primary btn-rounded w-100 ">Update</button>
                    </div>
                  </div>
              </form>
    </x-card>
</x-admin>
<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
<script>
    let textArea = document.querySelectorAll(".text-area");
    textArea.forEach( el => {
        ClassicEditor
            .create(el)
            .catch( error => {
                console.error( error );
            } );
    });
</script>