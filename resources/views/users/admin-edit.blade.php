<x-admin  >
    <div class="container my-5">
        <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <x-card>
                <h2 class="text-uppercase fw-bold text-gradient mb-5" style="letter-spacing: 0.1em">Edit Institution Data </h2>
                <div class="row">
                    <div class="col-md-6">
                        <img src="/storage/institution_logo/{{ $user->institution_logo }}" class="img-fluid" alt="institutional logo">
                    </div>
                    <div class="col-md-6">
                        {{-- name ,type, email , logo --}}
                        <div class="form-group mb-3">
                            <label for="ins_name" class="col-form-label"> Institution Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ins_name" name="institution_name" value="{{$user->institution_name}}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="ins_email" class="col-form-label"> Institution Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="ins_email" name="institution_email" value="{{$user->institution_email}}" required>
                        </div>
                        <div class="form-group mb-3" >
                            <label for="type" class="col-form-label"> Institution Type<span class="text-danger">*</span></label>
                            <select class="form-select"  name="institution_type" required>
                                <option value="high school" {{$user->institution_type == 'high school' ? 'selected':''}}>High School</option>
                                <option value="university" {{$user->institution_type == 'university' ? 'selected':''}}>University</option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="institution_logo_new" class="col-form-label"> Institutional Logo <small class="text-muted">(Optional)</small></label>
                            <input type="file" accept="image/png,image/jpeg,image/jpg" class="form-control" id="institution_logo_new" name="institution_logo_new" > 
                            <small class="text-danger"  style="font-size: 0.7em">Type : PNG, JPEG, JPG | Max : 2MB</small>
                        </div>
                        <input type="text" hidden name="institution_logo_old" value="{{$user->institution_logo}}">
                    </div>
                </div>
            </x-card>
            <x-card>
                <h2 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">Edit PIC Data </h2>
                <div class="form-group mb-2">
                    <label for="name" class="col-form-label">PIC Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" value="{{$user->pic_name}}" name="pic_name" required>
                </div>
    
                
        
                <div class="form-group mb-2">
                    <label for="phone" class="col-form-label">Phone<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="phone" name="pic_phone_number"  value="{{$user->pic_phone_number }}" required>
                </div>
                <div class="form-group mb-2">
                    <label for="country" class="col-form-label">Country<span class="text-danger">*</span></label>
                    <select name="country_id" class="form-select  @error('country_id') is-invalid
                    @enderror" required>
                    
                    
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}"
                        {{$user->country_id == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                    @endforeach
                </select>
                </div>
            </x-card>
            <button type="submit" class="btn btn-outline-theme w-100 rounded-pill"> Save Changes </button>
        </div>
                    

    </form>

    </div>
</x-admin>