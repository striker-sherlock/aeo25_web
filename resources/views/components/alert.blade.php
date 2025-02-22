@if (count($errors) > 0)
    <div class="modal fade pe-0" style="z-index: 9999;" id="alert" tabindex="-1" role="dialog"
            aria-labelledby="alertTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-20 border-0">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" data-keyboard="false" data-backdrop="static">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-12 mb-3 text-center">
                                <span class="fa-stack fa-4x">
                                    <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                                </span>
                            </div>
                            <div class="col-12 my-2 text-center">
                                <h3 class="font-weight-bold">Error</h3>
                                <ul class="fa-ul">
                                    @foreach ($errors->all() as $error)
                                        <li><h5 class="font-weight-normal"><i class="fas fa-exclamation-triangle text-danger"></i>{{$error}}</h5></li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn btn-outline-danger rounded-50 my-3 px-5"
                                    data-bs-dismiss="modal">
                                    OK, I got it
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endif 

@if (session('error'))

    <div class="modal fade pe-0" style="z-index: 9999;" id="alert" tabindex="-1" role="dialog"
        aria-labelledby="alertTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-20 border-0">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" data-keyboard="false" data-backdrop="static">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 mb-3 text-center">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                <i class="fas fa-times fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="col-12 my-2 text-center">
                            <h3 class="font-weight-bold">Error</h3>
                            <h5 class="font-weight-normal">{!! session('error') !!}</h5>
                            <button type="button" class="btn btn-outline-danger rounded-50 my-3 px-5"
                                data-bs-dismiss="modal">
                                OK, I got it
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if (session('success'))
{{-- {{dd('masuk sini')}} --}}
    <div class="modal fade pe-0" style="z-index: 9999;" id="alert" tabindex="-1" role="dialog"
            aria-labelledby="alertTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content rounded-20 border-0">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" data-keyboard="false" data-backdrop="static">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-12 mb-3 text-center">
                                <span class="fa-stack fa-4x">
                                    <i class="fas fa-circle fa-stack-2x text-success"></i>
                                    <i class="fas fa-check fa-stack-1x fa-inverse"></i>
                                </span>
                            </div>
                            <div class="col-12 my-2 text-center">
                                <h3 class="font-weight-bold">Success</h3>
                                <h5 class="font-weight-normal">{!! session('success') !!}</h5>
                                <button type="button" class="btn btn-outline-success rounded-50 my-3 px-5"
                                    data-bs-dismiss="modal">
                                    OK, I got it
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endif

@if (session('successRegist'))
    <div class="modal fade pe-0" style="z-index: 9999;" id="alert" tabindex="-1" role="dialog"
    aria-labelledby="alertTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content rounded-20 border-0">
                <div class="modal-header border-bottom-0">
                </div>
                <div class="modal-body" data-keyboard="false" data-backdrop="static">
                    <h3 class="font-weight-bold text-center text-success fw-bold">Registration Complete</h3>
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 mb-3 text-center">
                            <img src="{!! session('successRegist')[1] !!}" class="img-fluid" alt="QR Code">
                        </div>
                        <div class="col-12 my-2 text-center">
                            <h5 class="font-weight-normal">Join Group: <br><a href="{!! session('successRegist')[0] !!}" target="_blank" class="text-decoration-none" >{!! session('successRegist')[0] !!}</a></h5>
                            <button type="button" class="btn btn-outline-success rounded-50 my-3 px-5"
                                data-bs-dismiss="modal">
                                OK, I got it
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

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
                        <h5 class="fw-bold">Success</h5>
                        <h6 class="fw-normal">Fresh verification link has been sent!</h6>
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

