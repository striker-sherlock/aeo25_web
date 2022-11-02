<x-admin>
    <div class="container mt-4">
        <x-card>
            <h1 class="mb-3">Registration Summary</h1>
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
                        <th>Remaining Slot</th>
                        @foreach ($competitions as $competition)
                            <th> {{$competition->temp_quota}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Registered Slot</th>
                        @foreach ($competitions as $competition)
                            <th> {{$competition->fixed_quota -$competition->temp_quota }}</th>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </x-card>
        {{-- pending --}}
        <x-card>
            <h1 class="mb-3 text-warning">Pending</h1>
            <table class="table table-striped table-bordered">
                <thead class="text-center">
                  <tr>
                    <th scope="col">Competition Field</th>
                    <th scope="col">Institution Name</th>
                    <th scope="col">PIC Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Registered At</th>
                    <th scope="col">Total Slot</th>
                    <th scope="col">Action </th>
                    
                  </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($pending as $competition)
                        <tr>
                            <th>{{$competition->competition->name}}</th>
                            {{-- <th>{{$competition->user->institution_name}}</th> --}}
                            <th>{{$competition->user->pic_name}}</th>
                            <th>{{$competition->user->pic_phone_number}}</th>
                            <th>{{$competition->created_at}}</th>
                            <th>{{$competition->quantity}}</th>
                            <th class="m-auto"> 
                                <div class="d-flex  justify-content-center">
                                    <a href="{{route('slot-registrations.confirm',$competition->id)}}" class="btn btn-success btn-sm me-2">C</a>
                                    <a  class="btn btn-danger btn-sm me-2" data-bs-toggle="modal" data-bs-target="#reason{{$competition->id}}">R</a>
                                    
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
              </table>
        </x-card>

        {{-- confirmed --}}
       @if ($confirmed->count())
        <x-card>
            <h1 class="mb-3 text-success">Confirmed Slot Registration </h1>
            <table class="table table-striped table-bordered">
                <thead class="text-center">
                <tr>
                    <th scope="col">Competition Field</th>
                    <th scope="col">PIC Name</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Registered At</th>
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
                            <th>{{$competition->created_at}}</th>
                            <th>{{$competition->quantity}}</th>
                            <th class="m-auto"> 
                                <div class="d-flex   justify-content-center">
                                     
                                    <a href="{{route('slot-registrations.cancel',$competition->id)}}" class="btn btn-warning  btn-sm">X</a>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-card>
       @endif

        {{-- rejected --}}
        @if ($rejected->count())
            <x-card>
            <h1 class="mb-3 text-danger">Rejected Slot Registration</h1>
            <table class="table table-striped table-bordered">
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
            </x-card>
            
        @endif
    </div>
   
    
    <!-- Modal -->
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