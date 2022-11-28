<x-admin>
    <div class="container mt-3">
        {{-- PENDING --}}
        <x-card>
            <h2 class="text-warning fw-bold">Pending Accommodation Payment </h2>
            @if ($pending->count())
                <table class="table table-striped table-bordered dataTables">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Institution Name</th>
                            <th scope="col">Room Type</th>
                            <th scope="col">PIC Name</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending as $payment)
                            <tr class="text-center">
                                <th>{{$payment->id}}</th>
                                <th>{{$payment->institution_name}}</th>
                                <th>{{$payment->room_type}}</th>
                                <th>{{$payment->user->pic_name}}</th>
                                <th>{{$payment->amount}}</th>
                                 
                                <th>{{$payment->created_at}}</th>
                                <th>
                                    <div class="d-flex justify-content-around">

                                        <a href="{{route('competition-payments.edit',$payment->id)}}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{route('accommodation-payments.confirm',$payment->id)}}" class="btn btn-success">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                        <a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#proof{{$payment->id}}" >
                                            <i class="fa-solid fa-receipt"></i>
                                        </a>
                                        <a href="{{route('accommodation-payments.reject')}}" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#reason{{$payment->id}}" >
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>

        {{-- CONFIRMED --}}
        <x-card>
            <h2 class="mb-3 text-success fw-bold ">Confirmed Accommodation Payment </h2>
            @if ($confirmed->count())
                <a href="{{route('accommodation-payments.export')}}" class="btn btn-outline-theme mb-3">Download Excel</a>
                <table class="table table-striped table-bordered dataTables">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Institution Name</th>
                        <th scope="col">PIC Name</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Grand Total</th>
                        <th scope="col">Action</th>
                    
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($confirmed as $payment)
                        <tr class="text-center">
                            <th>{{$payment->id}}</th>
                            <th>{{$payment->institution_name}}</th>
                            <th>{{$payment->pic_name}}</th>
                            <th>{{$payment->room_type}}</th>
                            <th>{{$payment->amount}}</th>
                            <th>
                                <div class="d-flex justify-content-around">
                                    <a href="{{route('accommodation-payments.edit',$payment->id)}}" class="btn btn-primary" title="edit payment">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{route('accommodation-payments.cancel',$payment->id)}}" class="btn btn-warning" title="cancel payment">
                                        <i class="fas fa-undo"></i>
                                    </a>
                                    <a href="{{route('payments.paid-accommodation-invoice', $payment->id)}}" class="btn btn-success " title="View Invoice" target="_blank">
                                        <i class="fas fa-file-invoice"></i>
                                    </a>

                                    {{-- <a href="{{route('competition-payments.reject')}}" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#reason{{$payment->id}}" >R</a> --}}
                                </div>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>

        {{-- REJECTED --}}
        <x-card>
            <h2 class="mb-3 text-danger fw-bold">Rejected Competition Payment </h2>
            @if ($rejected->count())
                <table class="table table-striped table-bordered dataTables">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Institution Name</th>
                        <th scope="col">PIC Name</th>
                        <th scope="col">Room Type</th>
                        <th scope="col">Grand Total</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                        
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($rejected as $payment)
                        <tr class="text-center">
                            <th>{{$payment->id}}</th>
                            <th>{{$payment->institution_name}}</th>
                            <th>{{$payment->pic_name}}</th>
                            <th>{{$payment->room_type}}</th>
                            <th>{{$payment->amount}}</th>
                            <th>{{$payment->created_at}}</th>
                        
                            <th>
                                <div class="d-flex justify-content-around">
                                    <a href="{{route('accommodation-payments.cancel',$payment->id)}}" class="btn btn-warning" title="cancel payment">
                                        <i class="fas fa-undo"></i>
                                    </a>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>
    </div>

    {{-- modal untuk reason direject --}}
    @foreach ($pending as $payment)
        <div class="modal fade p-4" id="reason{{$payment->id}}" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-headers p-4 ">
                    <h5 class="modal-title text-center fs-2" >Are you sure want to reject ?</h5>
                </div>
                <form action="{{route('competition-payments.reject')}}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-gruop mb-3">
                            <label for="reason" class="col-form-label">State The Reason<span class="text-danger">*</span></label>
                            <textarea class="form-control text-area" name="reason"  id="reason" rows="3"></textarea>
                        </div>

                        <input type="text" name="payment" value="{{$payment->id}}" hidden>
                    </div>
                    <div class="modal-footers p-4">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn btn-outline-secondary w-100" data-bs-dismiss="modal">Close</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-outline-danger w-100">Reject</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        
    @endforeach

    {{-- modal untuk payment proof --}}
    @foreach ($pending as $payment)
        <div class="modal fade p-4" id="proof{{$payment->id}}" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <img src="/storage/transfer_proof/{{$payment->payment_proof}}" class="img-fluid" alt="tf_proof">
            </div>
            </div>
        </div>
        
    @endforeach
</x-admin>

<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
<script>
    let textArea = document.querySelectorAll(".text-area");
    textArea.forEach( el => {
        ClassicEditor
            .create(el)
            .catch( error => {
                console.error( error );
            } );
    });
</script>