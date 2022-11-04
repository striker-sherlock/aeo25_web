<x-admin>
    <div class="mt-2 container">
        <h1 class="fw-bold">Step 2</h1>
        <x-card>
            <h3 class="fw-bold"> Additional Information</h3 >
            <p>We highly suggest you to complete your payment once your registration has been confirmed. If 10 days have passed and the confirmed slot has not been paid yet, we will move your slot to the pending list again.
        </x-card>
        <div class="row">
            <div class="col-md-6">
                <x-card >
                    <h2 class="fw-bold ">Confirmed Registration Slot</h2>
                    <a href="{{route('competition-payments.create',0)}}" class="btn btn-outline-primary rounded-20 my-2">Pay All Slot Registration</a>
                    @foreach ($confirmedSlot as $competition)
                        <div class="row border p-2 mx-1 mb-3 rounded-20">
                            <div class="col-md-4"></div>
                            <div class="col-md-8 ">
                                <h5> {{$competition->competition->name}}: {{$competition->quantity}} {{$competition->competition->need_team == 0 ? 'People' : 'Team'}}</h5>
                                <h5>Payment Status : 
                                    @if ($competition->payment == NULL)
                                        <span class="text-danger">No Payment</span>
                                        
                                    @else
                                        @if ($competition->payment->is_confirmed == 1)
                                            <span class="text-success fw-bold">Payment Confirmed</span>
                                        @endif
                                        @if ($competition->payment->is_confirmed == 0)
                                            <span class="text-warning fw-bold">Pending</span>
                                        @endif
                                        @if ($competition->payment->is_confirmed == -1)
                                            <span class="text-danger fw-bold">Payment Rejected</span>
                                        @endif 
                                    @endif
                                </h5>
                                <a href="{{route('competition-payments.create',$competition->id)}}" class="btn btn-outline-info rounded-20">Pay This Slot Only</a>
                            </div>
                        </div>
                    @endforeach
                </x-card>
            </div>
            @if ($history->count())
                <div class="col-md-6">
                    <x-card>
                        <h2 class="fw-bold mb-3">Payment History</h2>
                        @foreach ($history as $item)
                        <div class="row border border-3 p-2 mx-1 mb-3 rounded-20">
                            <h3 class="mb-2">Payment {{$item->competition->name}}</h3>
                            <hr>
                            <h6 ><span class="fw-bold">Created At</span> : {{$item->payment->created_at}}</h6>
                            <h6 class="fw-bold">Status : 
                                @if ($item->payment->is_confirmed == 0)<span class="text-warning">Waiting for the confirmation</span>

                                @elseif ($item->payment->is_confirmed == 1)<span class="text-success">Payment is Confirmed</span> <span>At {{$item->payment->updated_at}}</span>

                                @else <span class="text-danger">Payment is Rejected</span>     
                                @endif
                            </h6>
                            <h6 ><span class="fw-bold">Registered for:</span> <span>{{$item->quantity}} {{$item->competition->need_team == 1? 'team' : 'people'}}</span></h6>
                            <div class="row">
                                <div class="col">
                                    <a href="" class="btn btn-outline-primary w-100 rounded-pill">Edit</a>
                                </div>
                                <div class="col">
                                    <a href="" class="btn btn-outline-danger w-100 rounded-pill">Delete</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </x-card>
                </div>
            @endif
        </div>
    </div>
</x-admin>