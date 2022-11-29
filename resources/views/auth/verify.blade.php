<x-layout>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="w-25 custom-border my-2"></div>
                        <h4 class="text-uppercase">Verify Your Email Account</h4>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email please click the button below') }}
                        <br>
                        <div class="d-flex justify-content-center">
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" id="verify-email" title="Resend Verification"
                                    class="btn  p-0 m-0 align-baseline py-2">
                                    <span class="fa-stack fa-2x" style="--fa-inverse: #fff;">
                                        <i class="fa-solid fa-circle fa-stack-2x fa-gradient"></i>
                                        <i class="fa-solid fa-envelope fa-stack-1x fa-inverse"></i>
                                    </span>

                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layout>


    <style>
        main {
            min-height: 75vh;
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

        .btn-link {
            -color: #f175ad;
        }

        .fa-gradient {
            background:-webkit-linear-gradient(#7FB6CF, #80679E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
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

@if(session('resent'))
<div class="modal fade show pe-0" style="z-index: 9999;" id="alert" tabindex="-1" role="dialog"
    aria-labelledby="alertTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-20">
            <div class="modal-header border-bottom-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body border-0">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-12 text-center mb-3">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-success"></i>
                            <i class="fas fa-check fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="col-12 my-2 text-center">
                        <h3 class="fw-bold">Success</h3>
                        <h5 class="">Fresh verification link has been sent!</h5>
                        <button type="button" class="btn rounded-20 btn-outline-success my-3 px-5"
                            data-bs-dismiss="modal" aria-label="Close">
                            OK, I got it
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
