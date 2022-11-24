<x-admin>
    {{-- {{dd($countries)}} --}}
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card >
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <h1 class="mb-4 text-center">Create New account </h1>
                        <hr>
                        <h3 class="text-uppercase fw-bold" style="letter-spacing: 0.1em">Institutional Data</h3>
                        <div class="form-group mb-3">
                            <label for="ins_name" class="col-form-label"> Institutional Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ins_name" name="institution_name" value="{{old('institution_name')}}" required>
                        </div>
                        <div class="form-group mb-3" >
                            <label for="type" class="col-form-label"> Institutional Type<span class="text-danger">*</span></label>
                            <select class="form-select"  name="institution_type" required>
                                <option selected class="d-none">Select The Institutional Type</option>
                                <option value="school" {{old('institution_type') == 'school' ? 'selected':''}}>school</option>
                                <option value="university" {{old('institution_type') == 'university' ? 'selected':''}}>university</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="ins_email" class="col-form-label"> Institutional Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="ins_email" name="institution_email" value="{{old('institution_email')}}" required> 
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="ins_logo" class="col-form-label"> Institutional Logo<span class="text-danger">*</span></label>
                            <input type="file" accept="image/png,image/jpeg,image/jpg" class="form-control" id="ins_logo" name="institution_logo" required> 
                            <small class="text-danger"  style="font-size: 0.7em">Type: png,jpg, jpeg | Max: 2MB</small>
                        </div>
                        <hr class="my-3">

                        <h3 class="text-uppercase fw-bold" style="letter-spacing: 0.1em">PIC Data</h3>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="name" class="col-form-label">PIC Name<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" value="{{old('pic_name')}}" name="pic_name" required>
                                </div>
                                
                    
                                
                                <div class="form-group mb-2">
                                    <label for="email" class="col-form-label">PIC Email<span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"  value="{{old('email')}}" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label for="phone" class="col-form-label">Phone<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="pic_phone_number"  value="{{old('pic_phone_number')}}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="country" class="col-form-label">Country<span class="text-danger">*</span></label>
                                    <select class="form-select" id="countries"  name="country_id" required>
                                        <option selected class="d-none">Select The Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}" {{old('country_id') == $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-2 position-relative">
                                    <label for="password" class="col-form-label">Password<span class="text-danger">*</span></label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" required>
                                    <i class="fa fa-eye position-absolute" id="toggle-password" style="top:50px; right:10px; cursor:pointer;"></i>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-2 position-relative">
                                    <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                    <i class="fa fa-eye position-absolute" id="toggle-confirm-password" style="top:50px; right:10px; cursor:pointer;"></i>
                                </div>
                            </div>
                            
                            
                        </div>

                        <button type="submit" class="btn btn-outline-primary w-100 rounded-pill" >
                            {{ __('Register') }}
                        </button>
                        <a href="/login" class="mx-auto d-block text-dark btn mt-3" >Already Have an Account ? <span class="text-primary">Login</span></a>
                        
                    </form>
                </x-card>
            </div>
        </div>
    </div>
</x-admin>
 