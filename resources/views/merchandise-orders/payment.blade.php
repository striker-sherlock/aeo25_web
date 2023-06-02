<x-admin>
    <div class="container mt-3">
        {{-- PENDING --}}
        <x-card>
            <h2 class="text-warning fw-bold">Pending Merchandise Payment </h2>
            @if ($pending->count())
            <div class="table-responsive py-2">
                <table class="table table-striped table-bordered dataTables" >
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Paid at </th>
                            <th scope="col">Customer</th>
                            <th scope="col">Items</th>
                            <th scope="col">Contact</th>
                            <th scope="col"> Shipping </th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pending as $payment)
                            <tr class="text-center">
                                <th>{{$payment->id}}</th>
                                <th>{{date('d M h:i', strtotime($payment->created_at))}}</th>
                                <th>{{$payment->name}}</th>

                                <th>
                                    <a href="#" class="btn btn-outline-theme rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#items{{$payment->id}}">
                                       View  Items
                                    </a>
                                </th>
                                <th>{{$payment->phone_number}}</th>
                                <th>{{$payment->address ? 'Delivery' : 'Pick up at binus' }}</th>
                                <th>IDR {{ number_format($payment->amount)}} </th>
                                 
                                <th>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{route('merchandise-orders.edit-payment',$payment->id)}}" class="btn btn-primary me-2" title="edit payment">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="#" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#confirm{{$payment->id}}" title="confirm ">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                        <a href="{{route('merchandise-orders.reject')}}" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#reason{{$payment->id}}" title="reject " >
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <a href="#" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#proof{{$payment->id}}" title="view proof">
                                            <i class="fa-solid fa-receipt"></i>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>

        {{-- Confirmed --}}
        <x-card>
            <h2 class="text-success fw-bold">Confirmed Merchandise Payment </h2>
            <a href="{{route('merchandise-orders.export')}}" class="btn btn-outline-theme mb-3">Download Excel</a>
            @if ($confirmed->count())
            <div class="table-responsive py-2">
                <table class="table table-striped table-bordered dataTables" >
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Paid at </th>
                            <th scope="col">Customer</th>
                            <th scope="col">Items</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Shipping</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($confirmed as $payment)
                            <tr class="text-center">
                                <th>{{$payment->id}}</th>
                                <th>{{date('d M h:i', strtotime($payment->created_at))}}</th>
                                <th>{{$payment->name}}</th>
                                <th>
                                    <a href="#" class="btn btn-outline-theme rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#items{{$payment->id}}">
                                       View  Items
                                    </a>
                                </th>
                                <th>{{$payment->phone_number}}</th>
                                <th>IDR {{ number_format($payment->amount)}} </th>
                                <th>{{$payment->address ? 'Delivery' : 'Pick up at binus' }}</th>
                                 
                                <th>
                                    <div class="d-flex justify-content-center">
                                 

                                        <a href="{{route('merchandise-orders.cancel',$payment->id)}}" class="btn btn-warning me-2" title="cancel payment">
                                            <i class="fa fa-undo"></i>
                                        </a>
                                   
                                        <a href="#" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#proof{{$payment->id}}" title="view proof">
                                            <i class="fa-solid fa-receipt"></i>
                                        </a>

                                        <a href="{{ route('merchandise-receipt', $payment->id) }}" target="_blank" class="btn btn-success text-white"  title="view receipt">
                                            <i class="fa-solid fa-file-invoice"></i>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>

        {{-- REJECTED --}}
        <x-card>
            <h2 class="text-danger fw-bold">Rejected Merchandise Payment </h2>
            @if ($rejected->count())
            <div class="table-responsive py-2">
                <table class="table table-striped table-bordered dataTables" >
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Paid At</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Items</th>
                            <th scope="col">Contact</th>
                            <th scope="col">Grand Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rejected as $payment)
                            <tr class="text-center">
                                <th>{{$payment->id}}</th>
                                <th>{{date('d M h:i', strtotime($payment->created_at))}}</th>
                                <th>{{$payment->name}}</th>
                                <th>
                                    <a href="#" class="btn btn-outline-theme rounded-pill me-2" data-bs-toggle="modal" data-bs-target="#items{{$payment->id}}">
                                       View Items
                                    </a>
                                </th>
                                <th>{{$payment->phone_number}}</th>
                                <th>IDR {{ number_format($payment->amount)}} </th>
                                 
                                <th>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{route('merchandise-orders.edit-payment',$payment->id)}}" class="btn btn-primary me-2" title="edit payment">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="{{route('merchandise-orders.cancel',$payment->id)}}" class="btn btn-warning me-2" title="cancel payment">
                                            <i class="fa fa-undo"></i>
                                        </a>
                                   
                                        <a href="{{route('merchandise-orders.reject')}}" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#reason{{$payment->id}}" title="reject " >
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <a href="#" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#proof{{$payment->id}}" title="view proof">
                                            <i class="fa-solid fa-receipt"></i>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
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
                <form action="{{route('merchandise-orders.reject')}}" method="POST" enctype="multipart/form-data">
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
                                <button type="submit" class="btn btn-outline-danger w-100">   Reject</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
        
    @endforeach

    {{-- modal untuk payment proof --}}
    @foreach ($allMerch as $payment)
        <div class="modal fade p-4" id="proof{{$payment->id}}" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content px-3 py-4">
                <div class="modal-header mb-3">
                    <h3 class="text-uppercase fw-bold text-gradient" style="letter-spacing: 0.1em"> {{$payment->name}}'s Transfer Proof  </h3>
                </div>
                <img src="/storage/merchandise/transfer_proof/{{$payment->payment_proof}}" class="img-fluid" alt="tf_proof">
            </div>
            </div>
        </div>
    @endforeach

    {{-- modal untuk lihat items apa saja yang dipesan --}}
        @foreach ($allMerch as $payment)
            <div class="modal fade p-4" id="items{{$payment->id}}" tabindex="-1" role="dialog" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content px-3 py-4">
                        <div class="modal-header mb-3">
                            <h3 class="text-uppercase fw-bold text-gradient" style="letter-spacing: 0.1em"> {{$payment->name}}'s Order </h3>
                        </div>
                        <div class="table-responsive py-2">
                            <table class="table table-striped table-bordered " >
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Item</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payment->merchandiseOrder as $order)
                                        <tr class="text-center">
                                            <th>{{$order->merchandise->name}}</th>
                                            <th>{{$order->quantity}}</th>
                                            <th>{{$order->merchandise->price}}</th>
                                            <th>
                                                <a href="{{route('merchandise-orders.edit', $order->id)}}" class="btn btn-primary btn-sm rounded me-2 " title="edit">
                                                    <i class="fa fa-edit"> </i>
                                                </a>
                                            </th>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    {{-- modal untuk confirm --}}
    @foreach ($pending as $merchandise)
    <div class="modal fade p-4" id="confirm{{$merchandise->id}}" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-headers p-4 "></div>
                <div class="body px-4">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-12 mb-3 text-center">
                            <span class="fa-stack fa-4x">
                                <i class="fas fa-circle fa-stack-2x text-success"></i>
                                <i class="fas fa-check fa-stack-1x fa-inverse"></i>
                            </span>
                        </div>
                        <div class="col-12 my-2 text-center px-4">
                            <h2 class="fw-bold mb-2 text-success">Merchandise Payment Confirmation</h2>
                            <h4 class="font-weight-bold">Are you sure want to confirm <span class="fw-bold text-uppercase">{{$merchandise->name}}'s</span> payment slot ? </h4>
                        </div>
                    </div>

                </div>
                <div class="modal-footers p-4 mb-5   ">
                    <div class="row justify-content-center">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary w-100 rounded-pill" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="col">
                            <a href="{{route('merchandise-orders.confirm',$merchandise->id)}}" class="btn btn-outline-success w-100 rounded-pill" >
                                Confirm 
                            </a>
                        </div>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
    @endforeach
</x-admin>

<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
<script type="module">

    let textArea = document.querySelectorAll(".text-area");
    textArea.forEach( el => {
        ClassicEditor
            .create(el)
            .catch( error => {
                console.error( error );
            } );
    });
</script>