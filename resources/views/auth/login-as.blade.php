<x-admin title="Admin Login">
    <div id="mainBackground">
        <div class="container   py-5">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 col-md-8 col-sm-9 col-11">
                    <div class="card card-shadow rounded-20 border">
                        <div class="card-body m-lg-3 m-2">
                            <div class="title-line"></div>
                            <h3 class="text-uppercase fw-bold text-gradient" style="letter-spacing: 0.1em">login as user</h3>
                            <form method="POST" action="{{ route('admin.auth-login-as') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="col-form-label ms-1" for="pic_email">Email</label>
                                    <input type="text"
                                        class="form-control rounded-20 @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-outline-theme w-100 rounded-pill mt-4">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin>
