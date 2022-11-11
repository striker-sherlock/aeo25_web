<x-admin>
 
    <div class="mt-2 container">
        <h1 class="fw-bold">Step 2</h1>
        <hr class="mb-4">
        <x-card>
            <h3 class="fw-bold"> Additional Information</h3 >
            <p>We highly suggest you to complete your payment once your registration has been confirmed. If 10 days have passed and the confirmed slot has not been paid yet, we will move your slot to the pending list again.
        </x-card>
        <div class="row">
            <div class="col-md-6">
                <x-card >
                    <h2 class="fw-bold ">Confirmed Registration Slot</h2>
                    @if ($isPaidAll->count())
                        <a href="{{route('competition-payments.create',0)}}" class="btn btn-outline-primary rounded-20 my-2">Pay All Slot Registration</a>
                    @endif
                    @foreach ($confirmedSlot as $competition)
                    {{-- {{dd($competition->payment_id)}} --}}
                        <div class="row border p-2 mx-1 mb-3 rounded-20">
                            <div class="col-md-4"></div>
                            <div class="col-md-8 ">
                                <h5> {{$competition->competition->name}}: {{$competition->quantity}} {{$competition->competition->need_team == 0 ? 'People' : 'Team'}}</h5>
                                <h5>Payment Status : 
                                    @if ($competition->payment == NULL)
                                        <span class="text-danger fw-bold">No Payment Yet</span>
                                        
                                    @else
                                        @if ($competition->payment->is_confirmed == 1)
                                            <span class="text-success fw-bold">Was Confirmed</span>
                                        @endif
                                        @if ($competition->payment->is_confirmed == 0)
                                            <span class="text-warning fw-bold">Wait For Confirmation</span>
                                        @endif
                                        @if ($competition->payment->is_confirmed == -1)
                                            <span class="text-danger fw-bold">Was Rejected</span>
                                        @endif 
                                    @endif
                                </h5>
                                @if (!$competition->payment_id)
                                    <a href="{{route('competition-payments.create',$competition->id)}}" class="btn btn-outline-info rounded-20">Pay This Slot Only</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </x-card>
            </div>

            {{-- history --}}
            @if ($history->count())
                <div class="col-md-6">
                    <x-card>
                        <h2 class="fw-bold mb-3">Payment History</h2>
                        @foreach ($history as $item)
                        <div class="row   p-2 mx-1 mb-3 rounded-20">
                            <h3 class="mb-2">{{$item->name}}'s Payment</h3>
                            <hr>
                            <h6 ><span>Created At</span> : <span class="fw-bold">{{ date("F j, Y", strtotime($item->created_at)) }} {{ date("H : i", strtotime($item->created_at))}}</span></h6>
                            <h6 class="">Status : 
                                @if ($item->is_confirmed == 0)<span class="text-warning fw-bold">Pending</span>

                                @elseif ($item->is_confirmed == 1)<span class="text-success fw-bold">Was Confirmed</span> <span>At {{ date("F j, Y", strtotime($item->updated_at))}}</span>

                                @else <span class="text-danger fw-bold">Was rejected</span> <span>At {{ date("F j, Y", strtotime($item->updated_at))}}</span>     
                                @endif
                            </h6>
                            <h6 ><span >Registered for:</span> <span class="fw-bold">{{$item->quantity}} {{$item->need_team == 1? 'team' : 'people'}}</span></h6>
                            <div class="row">
                                @if ($item->is_confirmed != 1)
                                    <div class="col">
                                        <a href="{{route('competition-payments.edit',$item->id)}}" class="btn btn-outline-primary w-100 rounded-pill">Edit</a>
                                    </div>
                                    <div class="col">
                                        <a  href="#" data-bs-toggle ="modal" data-bs-target="#modal{{$item->id}}" class="btn btn-outline-danger rounded-pill w-100"> Delete</a>
                                
                                    </div>
                                    
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </x-card>
                </div>
            @endif
        </div>
    </div>

    {{-- modal untuk delete paymentnya --}}
    @foreach ($history as $item)
    <div class="modal fade p-5" id="modal{{$item->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-20 border-0 shadow p-5">
                <div class="modal-headers mb-4">
                    <span class="fa-stack fa-4x d-block mx-auto" >
                        <i class="fas fa-circle fa-stack-2x text-danger"></i>
                        <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="body mb-3">
                    <h1 class="fw-bold fs-3 text-center" > Are you sure want to delete this payment ?</h1>
                    <p class="fs-4">This payment consist of: </p>
                    <ul style="margin-top:-20px;">
                        @foreach ($history as $competition)
                            @if ($competition->id == $item->id)
                                <li class="fw-bold">{{$competition->quantity}} {{$competition->need_team == 0 ? 'team' : 'people'}} of {{$competition->name}}'s field</li>
                            @endif
                        @endforeach
                    </ul>
                    <p class="text-warning"> NOTE : this action can't be undone  </p>
                </div>
                <div class="footer">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary w-100"  data-bs-dismiss="modal">Back</button>
                        </div>
                        <div class="col">
                            <form method="POST" action="{{route('competition-payments.destroy',$item->id)}}">
                            <input type="hidden" name="_method" value = "DELETE">
                                <button class="btn btn-outline-danger rounded w-100" title="delete">
                                Delete
                                </button>
                            @csrf
                            </form>
                        </div>
                    </div>  
                </div>
            </div>
        </div>  
    </div>  
    @endforeach
</x-admin>