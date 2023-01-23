<x-admin>
    <div class="container mt-4">
        <x-card>
            <h2 class="mb-3 fw-bold">Registration Summary</h2>
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
                        <th>Initial Slot</th>
                        @foreach ($competitions as $competition)
                            <th> {{$competition->temp_quota + $registeredSlot[$competition->name]}}</th>
                        @endforeach
                    </tr>
                    
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
            <div class="table-responsive py-2">
                <table class="table table-striped table-bordered dataTables">
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
                                <th>{{chunk_split($competition->user->pic_phone_number,3,' ')}}</th>
                                <th>{{$competition->quantity}}</th>
                                <th class="m-auto"> 
                                    <div class="d-flex  justify-content-center">
                                        <a href="{{route('slot-registrations.edit',$competition->id)}}"class="btn  btn-primary me-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a  class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#confirm{{$competition->id}}">
                                            <i class="fas fa-check-circle"></i>
                                        </a>
                                        <a class="btn btn-danger  me-2" data-bs-toggle="modal" data-bs-target="#reason{{$competition->id}}">
                                            <i class="fas fa-times"></i>
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

        {{-- confirmed (unpaid)  --}}
        <x-card>
            <h2 class="mb-3 text-success fw-bold">Confirmed Slot Registration (Unpaid) </h2>
            <a href="{{route('slot-registrations.export')}}" class="btn btn-outline-theme rounded-pill" style="min-width: 200px"> <i class="fa fa-file-excel" aria-hidden="true"></i> Export Excel</a>
            @if ($confirmed->count())
            <div class="table-responsive py-2">
                <table class="table table-striped table-bordered dataTables" id="">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Competition Field</th>
                        <th scope="col">PIC Name</th>
                        <th scope="col">Institution</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Country</th>
                        <th scope="col">Expired</th>
                        <th scope="col">Total Slot</th>
                        <th scope="col">Action </th>
                        
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($confirmed as $competition)
                            <tr>
                                <th>{{$competition->competition->name}}</th>
                                <th>{{$competition->user->pic_name}}</th>
                                <th>{{$competition->user->institution_name}}</th>
                                <th>{{chunk_split($competition->user->pic_phone_number,3,' ')}}</th>
                                <th>{{$competition->user->country->name}}</th>
                                @php($diff = \Carbon\Carbon::parse( now() )->diffInDays( $competition->confirmed_at ))
                                <th class="{{$diff > 9 ? 'text-danger' : 'text-success'}}">{{$diff}}</th>
                                 
                                <th>{{$competition->quantity}}</th>
                                <th class="m-auto"> 
                                    <div class="d-flex justify-content-center">
                                        <a href="{{route('slot-registrations.edit',$competition->id)}}"class="btn  btn-primary me-2">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('slot-registrations.cancel',$competition->id)}}" class="btn btn-warning cancel">
                                            <i class="fas fa-undo" ></i>
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

        {{-- confirmed (paid)  --}}
        <x-card>
            <h2 class="mb-3 text-success fw-bold">Confirmed Slot Registration (Paid) </h2>
            @if ($confirmedPaid->count())
            <div class="table-responsive py-2">
                <table class="table table-striped table-bordered dataTables" id="">
                    <thead class="text-center">
                    <tr>
                        <th scope="col">Competition Field</th>
                        <th scope="col">PIC Name</th>
                        <th scope="col">Institution</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Country</th>
                        <th scope="col">Total Slot</th>
                       
                        
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($confirmedPaid as $competition)
                            <tr>
                                <th>{{$competition->competition->name}}</th>
                                <th>{{$competition->user->pic_name}}</th>
                                <th>{{$competition->user->institution_name}}</th>
                                <th>{{chunk_split($competition->user->pic_phone_number,3,' ')}}</th>
                                <th>{{$competition->user->country->name}}</th>
                                
                                <th>{{$competition->quantity}}</th>
                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else <hr><p class="text-center">No Data</p>
            @endif
        </x-card>

        {{-- rejected --}}
        <x-card>
            <h2 class="mb-3 text-danger fw-bold">Rejected Slot Registration</h2>
                @if ($rejected->count())
                <div class="table-responsive py-2">
                    <table class="table table-striped table-bordered dataTables" id="data-table">
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
                                    <th>{{chunk_split($competition->user->pic_phone_number,3,' ')}}</th>
                                    <th>{{$competition->created_at}}</th>
                                    <th>{{$competition->quantity}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
                            <textarea class="form-control text-area" name="reason"  id="reason" rows="3"></textarea required>
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

    {{-- modal untuk confirm --}}
    @foreach ($pending as $competition)
        <div class="modal fade p-4" id="confirm{{$competition->id}}" tabindex="-1" role="dialog" >
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
                        <div class="col-12 my-2 text-center">
                            <h2 class="fw-bold mb-2 text-success">Slot Registration Confirmation</h2>
                            <h4 class="font-weight-bold">Are you sure want to confirm <span class="fw-bold">{{$competition->user->pic_name}}'s</span> slot ? </h4>
                        </div>
                    </div>

                    <input type="text" name="slot" value="{{$competition->id}}" hidden>
                </div>
                <div class="modal-footers p-4   mb-5">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary w-100 rounded-pill" data-bs-dismiss="modal">Close</button>
                        </div>
                        <div class="col">
                            <a href="{{route('slot-registrations.confirm',$competition->id)}}" class="btn btn-outline-success w-100 rounded-pill confirm" >
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
    console.log(textArea);
    textArea.forEach( el => {
        ClassicEditor
            .create(el)
            .catch( error => {
                console.error( error );
            } );
    });
</script>