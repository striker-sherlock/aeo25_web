<x-layout>
    <x-navbar></x-navbar>
    <div class="container my-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-body">
                        <div class="custom-border w-25 my-2"></div>
                        <h4 class="text-uppercase fw-bold">Reset Password</h4>
                        @if (session('status'))
                            <div class="alert alert-success " role="alert">
                                <i class="fas fa-check-circle "></i>
                                &nbsp;
                                {{ session('status') }}
                            </div>
                        @endif
                        <br>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-send text-light">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    input[type="email"]:focus {
        outline: none;
        box-shadow: 0 0 0 1px #f175ad;
    }

    .btn-send {
        background-image: linear-gradient(#7FBCD2, #80679E);
    }

    .alert {
        padding: 12px 16px;
        border-radius: 4px;
        border-style: solid;
        border-width: 1px;
        margin-bottom: 12px;
        font-size: 16px;
    }

    .alert.alert-success {
        background-color: rgba(227, 253, 235, 1);
        border-color: rgba(38, 179, 3, 1);
        color: rgba(60, 118, 61, 1);
    }
</style>
