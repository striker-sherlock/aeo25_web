<x-admin>
    <div class="container mt-4">
        <x-card>
            <h3 class="text-uppercase fw-bold mb-4" style="letter-spacing: 0.1em"> Edit {{$guest->guest_name}}</h3>
            <form action="{{route('accommodation-guests.update',$guest->id)}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PUT')
                <a href="{{route('accommodation-guests.index')}}" class="btn btn-outline-secondary rounded-pill mb-4">Go back</a>
                <div class="col-md-12 mb-5 border border-1 rounded-20 p-4 shadow-sm">
                    <div class="form-group mb-3">
                        <label for="guest_nam" class="col-form-label">Guest Name <span class="text-danger">*</span> </label>
                        <input type="text"  class="form-control"  name="guest_name" id="guest_nam" value="{{$guest->guest_name}}" required>
               
                    </div> 
                    <div class="form-group mb-2">
                        <label for="gender" class="col-form-label">Gender<span class="text-danger">*</span></label>
                        <select class="form-select"  name="gender" id="gender" required>
                            <option selected class="d-none" disabled>Select guest's gender</option>
                            <option value="M" {{$guest->guest_gender == "M" ? "selected" : ""}} >Male</option>
                            <option value="F" {{$guest->guest_gender == "F" ? "selected" : ""}}>Female</option>
                        </select>
                    </div>      
                </div>
               
                <button type="submit" class="btn btn-outline-theme w-100 rounded-pill">Edit</button>
             
            </form>
        </x-card>
    </div>
</x-admin>