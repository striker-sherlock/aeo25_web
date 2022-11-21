<x-admin>
    
<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <x-card >
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h1 class="mb-4 text-center">Create New account </h1>
                    <hr>
                    <h2>Institutional Data</h2>
                    <div class="form-group mb-3">
                        <label for="ins_name" class="col-form-label"> Institutional Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ins_name" name="ins_name" value="{{old('ins_name')}}">
                    </div>
                    <div class="form-group mb-3" >
                        <label for="type" class="col-form-label"> Institutional Type<span class="text-danger">*</span></label>
                        <select class="form-select"  name="ins_type">
                            <option selected class="d-none">Select The Institutional Type</option>
                            <option value="school">School</option>
                            <option value="university">University</option>
                        </select>
                    </div>
                    
                    <div class="form-group mb-2">
                        <label for="ins_email" class="col-form-label"> Institutional Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="ins_email" name="ins_email" value="{{old('ins_email')}}"> 
                    </div>
                    
                    <div class="form-group mb-2">
                        <label for="ins_logo" class="col-form-label"> Institutional Logo<span class="text-danger">*</span></label>
                        <input type="file" accept="image/png,image/jpeg,image/jpg" class="form-control" id="ins_logo" name="ins_logo">
                        <small class="text-danger"  style="font-size: 0.7em">Type: png,jpg, jpeg | Max: 2MB</small>
                    </div>
                    <hr class="my-3">

                    <h2>PIC Data</h2>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="name" class="col-form-label">PIC Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name">
                            </div>
                            
                  
                            
                            <div class="form-group mb-2">
                                <label for="email" class="col-form-label">PIC Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email"  value="{{old('email')}}">
                            </div>
                            <div class="form-group mb-2">
                                <label for="phone" class="col-form-label">Phone<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone"  value="{{old('phone')}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                                <label for="country" class="col-form-label">Country<span class="text-danger">*</span></label>
                                <select class="form-select"  name="country_id">
                                    <option selected class="d-none">Select The Country</option>
                                    {{-- @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach --}}
                                    <option value="1">Indonesia</option>
                                    <option value="2">Singapore</option>
                                    <option value="3">Malaysia</option>
                                    <option value="4">Thailand</option>
                                    <option value="5">Bangladesh</option>
                                    <option value="6">Vietnam</option>
                                    <option value="7">Cambodia</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="password" class="col-form-label">Password<span class="text-danger">*</span></label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <i class="bi bi-eye-slash" id="togglePassword"></i>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label for="password-confirm" class="col-form-label">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                        
                    </div>

                    <button type="submit" class="btn btn-outline-primary w-100" >
                        {{ __('Register') }}
                    </button>
                    
                    
                </form>
            </x-card>
        </div>
    </div>
</div>
</x-admin>
 