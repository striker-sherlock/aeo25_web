<x-layout>
    <x-navbar></x-navbar>
    <div class="container " style="margin-top: 100px">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card class="car" >
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <h1 class="mb-4 text-center text-gradient fw-bold display-5">Create New Account </h1>
                        <h3 class="text-uppercase fw-bold aeo-title" style="letter-spacing: 0.1em">Institutional Data</h3>
                        <div class="form-group mb-3">
                            <label for="ins_name" class="col-form-label"> Institutional Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ins_name" name="institution_name" value="{{old('institution_name')}}" required>
                        </div>
                        <div class="form-group mb-3" >
                            <label for="type" class="col-form-label"> Institutional Type<span class="text-danger">*</span></label>
                            <select class="form-select"  name="institution_type" required>
                                <option selected class="d-none">Select The Institutional Type</option>
                                <option value="high school" {{old('institution_type') == 'high school' ? 'selected':''}}>High School</option>
                                <option value="university" {{old('institution_type') == 'university' ? 'selected':''}}>University</option>
                            </select>
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="ins_email" class="col-form-label"> Institutional Email<span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="ins_email" name="institution_email" value="{{old('institution_email')}}" required> 
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="institution_logo" class="col-form-label"> Institutional Logo<span class="text-danger">*</span> </label>
                            <input type="file" accept="image/png,image/jpeg,image/jpg" class="form-control" id="institution_logo" name="institution_logo" required> 
                            <small class="text-danger"  style="font-size: 0.7em;letter-spacing:0.03em;">Type : PNG, JPEG, JPG | Max : 2MB | Size : (3 X 4)</small>
                        </div>
                        <hr class="my-3">

                        <h3 class="text-uppercase fw-bold aeo-title" style="letter-spacing: 0.1em">PIC Data</h3>
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
                                    <select name="country_id" class="form-select  @error('country_id') is-invalid
                                    @enderror" required>
                                    <option value="" selected disabled>Choose...
                                    </option>
                                    
                                    @foreach ($countries as $country)
                                    <option value="{{ $country->id }}"
                                        {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="form-group mb-2 position-relative">
                                    <label for="password" class="col-form-label">Password<span class="text-danger">*</span><small class="text-muted"  style="font-size: 0.7em"> (Min: 8 Character)</small></label>
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

                        {{-- <button type="submit" class="btn btn-outline-theme w-100 rounded-pill" >
                            {{ __('Register') }}
                        </button>
                        <span class="d-block mx-auto text-center mt-3">Already Have an Account ? <a href="/login" class="" > Login</a></span> --}}
                        
                        
                    </form>
                </x-card>
                <x-card>
                    <h3 class="text-center text-capitalize fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Registration Closed </h3>
                </x-card>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
</x-layout>

<style>
    .card-header {
        background-color: #3f3b74;p
    }
</style>
 