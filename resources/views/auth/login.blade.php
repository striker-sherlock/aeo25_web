{{-- <x-layout>
    <div class="container  my-5 py-5">
        <div class="row justify-content-center align-item-center my-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout> --}}

<x-layout>
  <x-navbar></x-navbar>
    <div id="landing">
        <div class="container mt-4 pt-4">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6 col-md-8 col-sm-9 col-11">
                    <div class="card card-shadow rounded  ">
                        <div class="card-header py-3"></div>
                        <div class="card-body m-lg-3 m-2">
                            <div class="title-line"></div>
                            <div class="text-center">
                                <h5 class="fw-bold mt-3 text-center" id="loginText">LOGIN</h5>
                                <h1 class="c-text-1 fw-bold mt-2">Welcome back!</h1>
                            </div>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="col-form-label ms-1" for="email">PIC Email</label>
                                    <input type="text" class="form-control  @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-2 position-relative">
                                    <label class="col-form-label ms-1" for="password">Password</label>
                                    <input type="password" id="password"
                                        class="position-relative form-control  @error('password') is-invalid @enderror"
                                        name="password" value="{{ old('password') }}" required>
                                    <div class="position-absolute" style="right:15px; top:48px;cursor:pointer;">
                                        <i class="fa fa-eye c-text-1" style="font-size: 20px;display:none"
                                            id="eye-password" onclick="hidePassword()"></i>
                                        <i class="fa fa-eye-slash c-text-1" style="font-size: 20px;"
                                            id="eye-password-slash" onclick="showPassword()"></i>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                @if (Route::has('password.request'))
                                    <div class="text-end ms-1">
                                        <a class="text-decoration-none c-text-1" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                @endif
                                <div class="d-grid mt-5 mx-2">
                                    <button type="submit" class="btn c-button-1 rounded-pill btnSubmit">Login</button>
                                </div>
                                <hr>
                                <div class="text-center mt-2 ms-1">
                                    <span class="text-center pl-2">Don't have an account?
                                        <a href="{{ route('register') }}" class="c-text-1 text-decoration-none">Create
                                            New Account</a>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-footer></x-footer>
</x-layout>

<style>
    .container {
        font-family: 'Roboto', 'Lexend', Arial, Helvetica, sans-serif; 
    }

    input[type=password]::-ms-reveal,
    input[type=password]::-ms-clear {
        display: none;
    }

    #loginText {
        color: #32649E;
    }

    h1 {
        color: #7fbcd2;
    }

    .card-shadow {
        box-shadow: 0 2px 4px rgb(0 0 0 / 10%), 0 8px 16px rgb(0 0 0 / 10%);
    }

    .card-header {
        background-image: linear-gradient(#7fbcd2, #80679e, #f175ad);
    }
</style>

<script>
    function showPassword() {
        document.getElementById("password").type = "text";
        document.getElementById("eye-password").style.display = "block";
        document.getElementById("eye-password-slash").style.display = "none";
    }

    function hidePassword() {
        document.getElementById("password").type = "password";
        document.getElementById("eye-password").style.display = "none";
        document.getElementById("eye-password-slash").style.display = "block";
    }
</script>
