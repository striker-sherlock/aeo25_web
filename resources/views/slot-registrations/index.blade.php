<x-admin>
    <div class="container mt-4">
        <x-card>
            <h2 class="mb-3">Registration Summary</h2>
            <table class="table table-striped table-bordered">
                <thead class="text-center">
                  <tr>
                    <th scope="col"> </th>
                    @foreach ($competitions as $competition)
                        <th scope="col">{{$competition->id}}</th>
                    @endforeach
                  </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <th>Remaining Slot (Temp)</th>
                        @foreach ($competitions as $competition)
                            <th> {{$competition->temp_quota}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Registered Slot</th>
                        @foreach ($competitions as $competition)
                            <th> {{$registeredSlot[$competition->name]}}</th>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </x-card>
        
        {{-- pending --}}
        <x-card>
            <h2 class="mb-3 text-warning fw-bold">Pending Slot Registration</h2>
            @if ($pending->count())
                <table class="table table-striped table-bordered data-table" id="data-table">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Competition Field</th>
                        <th scope="col">Institution Name</th>
                        <th scope="col">PIC Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Total Slot</th>
                        <th scope="col">Action </th>
                        
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($pending as $competition)
                            <tr>
                                <th>{{$competition->competition->name}}</th>
                                <th>{{$competition->user->institution_name}}</th>
                                <th>{{$competition->user->pic_name}}</th>
                                <th>{{$competition->user->pic_phone_number}}</th>
                                <th>{{$competition->quantity}}</th>
                                <th class="m-auto"> 
                                    <div class="d-flex  justify-content-center">
                                        <a href="{{route('slot-registrations.edit',$competition->id)}}"class="btn btn-sm btn-primary me-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('slot-registrations.confirm',$competition->id)}}" class="btn btn-success btn-sm me-2">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                        <a class="btn btn-danger btn-sm me-2" data-bs-toggle="modal" data-bs-target="#reason{{$competition->id}}">
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

        {{-- confirmed --}}
        <x-card>
            <h2 class="mb-3 text-success fw-bold">Confirmed Slot Registration </h2>
            @if ($confirmed->count())
                <table class="table table-striped table-bordered data-table" id="">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Competition Field</th>
                        <th scope="col">PIC Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Country</th>
                        <th scope="col">Expired</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Total Slot</th>
                        <th scope="col">Action </th>
                        
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($confirmed as $competition)
                            <tr>
                                <th>{{$competition->competition->name}}</th>
                                <th>{{$competition->user->pic_name}}</th>
                                <th>{{$competition->user->pic_phone_number}}</th>
                                <th>{{$competition->user->country->name}}</th>
                                @php($diff = \Carbon\Carbon::parse( now() )->diffInDays( $competition->confirmed_at ))
                                <th class="{{$diff > 2 ? 'text-danger' : 'text-success'}}">H + {{$diff}} Days</th>
                                <th class="{{$competition->payment_id == NULL ? 'text-danger' : 'text-warning'}}">{{$competition->payment_id == NULL ? 'No Payment Yet' : 'Payment is on progress'}}</th>
                                <th>{{$competition->quantity}}</th>
                                <th class="m-auto"> 
                                    <div class="d-flex justify-content-center">
                                        <a href="{{route('slot-registrations.cancel',$competition->id)}}" class="btn btn-warning  btn-sm">
                                            <i class="fas fa-undo" ></i>
                                        </a>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{route('competition-payments.index','National')}}" class="btn btn-outline-info rounded-pill my-4 me-2" >View National Payment</a>
                <a href="{{route('competition-payments.index','international')}}" class="btn btn-outline-info rounded-pill my-4">View International Payment</a>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>

        {{-- rejected --}}
        <x-card>
            <h2 class="mb-3 text-danger fw-bold">Rejected Slot Registration</h2>
                @if ($rejected->count())
                <table class="table table-striped table-bordered data-table" id="data-table">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Competition Field</th>
                        <th scope="col">Institution Name</th>
                        <th scope="col">PIC Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Registered At</th>
                        <th scope="col">Total Slot</th>
                        
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($rejected as $competition)
                            <tr>
                                <th>{{$competition->competition->name}}</th>
                                <th>{{$competition->user->institution_name}}</th>
                                <th>{{$competition->user->pic_name}}</th>
                                <th>{{$competition->user->pic_phone_number}}</th>
                                <th>{{$competition->created_at}}</th>
                                <th>{{$competition->quantity}}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              @else <hr><p class="text-center">No Data</p>
              @endif
            </div>
        </x-card>
   
    
    <!-- Modal untuk reject -->
    @foreach ($pending as $competition)
        <div class="modal fade p-4" id="reason{{$competition->id}}" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-headers p-4 ">
                    <h5 class="modal-title text-center fs-2" >Are you sure want to reject ?</h5>
                </div>
                <form action="{{route('slot-registrations.reject')}}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-gruop mb-3">
                            <label for="reason" class="col-form-label">State The Reason<span class="text-danger">*</span></label>
                            <textarea class="form-control text-area" name="reason"  id="reason" rows="3"></textarea>
                        </div>

                        <input type="text" name="slot" value="{{$competition->id}}" hidden>
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
    

    
</x-admin>

<script src="https://cdn.ckeditor.com/ckeditor5/35.2.1/classic/ckeditor.js"></script>
<script>
    let textArea = document.querySelectorAll(".text-area");
    console.log(textArea);
    textArea.forEach( el => {
        ClassicEditor
            .create(el)
            .catch( error => {
                console.error( error );
            } );
    });
</script>