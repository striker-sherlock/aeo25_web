<x-user title="edit profile">
    <div class="container mt-5">
        <form action="{{route('users.update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <x-card>
                <h2 class="text-uppercase fw-bold text-gradient mb-5" style="letter-spacing: 0.1em">Edit Institution Data </h2>
                <div class="row">
                    <div class="col-md-6">
                        <img src="/storage/institution_logo/{{ Auth::user()->institution_logo }}" class="img-fluid" alt="institutional logo">
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
            <div class="row">
                <div class="col-md-6">
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
                </div>
                <div class="col-md-6">
                    <x-card>
                        <h2 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">Change Password</h2>
                        <div class="alert alert-primary border-0 shadow-sm mb-3" role="alert" style="letter-spacing: .05em">
                            <i class="fa-solid fa-triangle-exclamation me-1"></i>Fill this part if and only if you want to change password<br>
                        </div>

                        <div class="form-group mb-2 position-relative">
                            <label for="old_password" class="col-form-label">Old Password</label>
                            <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password"   >
                            <i class="fa fa-eye position-absolute " id="old-toggle-password" style="top:50px; right:10px; cursor:pointer;"></i>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2 position-relative">
                            <label for="password" class="col-form-label">Password <small class="text-muted"  style="font-size: 0.7em"> (Min: 8 Character)</small></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password"  >
                            <i class="fa fa-eye position-absolute toggle-password" id="toggle-password" style="top:50px; right:10px; cursor:pointer;"></i>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2 position-relative">
                            <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }} </label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"   autocomplete="new-password">
            
                            <i class="fa fa-eye position-absolute" id="toggle-confirm-password" style="top:50px; right:10px; cursor:pointer;"></i>
                        </div>
                    
                    </x-card>
                </div>
            </div>

            <button type="submit" class="btn btn-outline-theme w-100 rounded-pill"> Save Changes </button>
        </form>

    </div>
</x-user>