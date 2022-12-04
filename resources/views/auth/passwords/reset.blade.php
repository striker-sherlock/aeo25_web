<x-layout> 
    <x-navbar></x-navbar>
    <br>
    <br>
    <br>
    <br>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="custom-border w-25 my-2"></div>
                    <h4 class="text-uppercase fw-bold mb-3 pb-3">Reset Password</h4>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col d-flex justify-content-center">
                                <button type="submit" class="btn btn-send text-light rounded w-50 text-center ">
                                    {{ __('Reset Password') }}
                                </button>

                            </div>
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
 <x-footer></x-footer>
</x-layout>
<style>
    main {
        font-family: "Roboto", "Helvetica Neue", Helvetica, Arial;
    }

    .card-header {
        background-color: #3f3b74;
        color: #ffff;
        border-top-left-radius: 30px;
        border-top-right-radius: 30px;
    }

    .card {
        border-radius: 8px !important;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

    }

    .custom-border {
        background-color: #f175ad;
        height: 2px;
    }

    h4 {
        font-weight: bold;
        background-image: -webkit-linear-gradient(#3F3B74, #32649E);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .btn-send {
        background-image: linear-gradient(#7FBCD2, #80679E);
    }



</style>

