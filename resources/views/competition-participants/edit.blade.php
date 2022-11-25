<x-admin>
    <div class="container mt-4">
        {{-- PIC PERSONAL DATA --}}
        <x-card>
            <h4 class="text-uppercase">PIC Information</h4>
            <h2 class="fw-bold">PIC's Personal Detail</h2>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="col-form-label"> PIC Name </label>
                        <input type="text"  class="form-control" value="{{$participant->user->pic_name}}" disabled>
                    </div> 
                    <div class="form-group mb-3">
                        <label class="col-form-label"> Institution </label>
                        <input type="text"  class="form-control" value="{{$participant->user->institution_name}}" disabled>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label class="col-form-label"> Phone Number </label>
                        <input type="text"  class="form-control" value="{{$participant->user->pic_phone_number}}" disabled>
                    </div> 
                    <div class="form-group mb-3">
                        <label class="col-form-label"> PIC Email</label>
                        <input type="text"  class="form-control" value="{{$participant->user->email}}" disabled>
                    </div> 
                </div>
            </div>
        </x-card>
        <x-card>
            <form action="{{route('competition-participants.update',$participant->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h4 class="text-uppercase">Edit Participant</h4>
                <h2 class="fw-bold">{{$participant->competition->name}} Participant</h2>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="nama" class="col-form-label">Name<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="nama" id="nama" value="{{$participant->name}}" required>
                            @if ($errors->has('nama'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('nama') }}.</strong>
                                </span>
                            @endif
                        </div>    
                        <div class="form-group mb-3">
                            <label for="email" class="col-form-label">Email<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control"  name="email" id="email" value="{{$participant->email}}" required>
                            @if ($errors->has('email'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('email') }}.</strong>
                                </span>
                            @endif
                        </div> 
                        
                        <div class="form-group mb-2">
                            <label for="gender" class="col-form-label">Gender<span class="text-danger">*</span></label>
                            <select class="form-select"  name="gender" required id="gender">
                                <option class="d-none">Select participant's gender</option>
                                <option value="Male" {{$participant->gender == 'Male' ? 'selected':''}}>Male</option>
                                <option value="Female" {{$participant->gender == 'Female' ? 'selected':''}}>Female</option>
                            </select>
                        </div>  
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="birth" class="col-form-label">Date Of Birth <span class="text-muted">(yyyy-mm-dd)</span></label>
                            <input type="text"  class="form-control"  name="birth" id="birth" value="{{$participant->birth_date}}" required>
                            @if ($errors->has('birth'))
                                <span class="invalid feedback text-danger"role="alert">
                                    <strong>*{{ $errors->first('birth') }}.</strong>
                                </span>
                            @endif
                        </div>  

                        <div class="form-group mb-3">
                            <label for="phone" class="col-form-label">Phone Number</label>
                            <input type="text"  class="form-control "  name="phone" id="phone" value="{{$participant->phone_number}}" required>
                            @if ($errors->has('phone'))
                            <span class="invalid feedback text-danger"role="alert">
                                <strong>*{{ $errors->first('phone') }}.</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" hidden name="profile_picture_old" value="{{$participant->profile_picture}}">
                            <label for="profile_picture" class="col-form-label">Profile Picture</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" id="profile_picture" name="profile_picture_new" accept="image/png,image/jpeg,image/jpg">
                                <div class="input-group-append">
                                <button class="btn btn-outline-theme" type="button" data-bs-toggle ="modal" data-bs-target="#profile_picture" >Profile Picture</button>
                                </div>
                                
                            </div> 
                        </div>
                    </div>  
                </div>    
                <button type="submit" class="btn btn-outline-theme w-100 rounded-pill"> Confirm Edit </button>
            </form>
        </x-card>
    </div>
    <div class="modal fade p-5" id="profile_picture" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-20 border-0 shadow p-5">
                <div class="modal-headers mb-4"></div>
                <div class="body mb-3">
                    <img src="/storage/profile_picture/{{$participant->competition->id}}/{{$participant->profile_picture}}" class="img-fluid" alt="{{$participant->name}}'s profile picture">
                </div>
                <div class="footer">
                   
                </div>
            </div>
        </div>  
    </div>
</x-admin>