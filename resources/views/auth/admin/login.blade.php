<x-layout>
    <x-navbar></x-navbar>
    <div id="mainBackground" class="py-5">
        <div class="container my-4 py-4">
            <div class="row justify-content-center align-items-center ">
                <div class="col-lg-6 col-md-8 col-sm-9 col-11">
                    <div class="card card-shadow rounded-20 overflow-hidden">
                        <div class="card-header py-3 w-100"></div>
                        <div class="card-body m-lg-3 m-2">
                            <div class="title-line"></div>
                            <div class="text-center">
                                <h5 class="fw-bold mt-3 text-center" id="loginText">ADMIN LOGIN</h5>
                                <h1 class="c-text-1 fw-bold mt-2 mb-4">Welcome back Admin!</h1>
                            </div>
                            <form method="POST" action="{{ route('admin.login-auth') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="col-form-label ms-1" for="pic_email">Email</label>
                                    <input type="text"
                                        class="form-control  @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-2 position-relative">
                                    <label class="col-form-label ms-1" for="pic_email">Password</label>
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
                                <div class="d-grid mt-4 mx-2">
                                    <button type="submit" class="btn c-button-1 rounded-pill btnSubmit">Login</button>
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

        background-color: #3f3b74;
    }


    input[type=password]::-ms-reveal,
    input[type=password]::-ms-clear {
        display: none;
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

