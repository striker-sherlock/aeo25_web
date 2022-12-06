<x-admin  >
    <div class="container my-5">
        <form action="{{route('admins.update',$admin->id)}}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('PUT')
            <x-card>
                <h2 class="text-uppercase fw-bold text-gradient mb-4" style="letter-spacing: 0.1em">Edit Admin Account </h2>
                <div class="row">
                    <div class="col-md-6">
                        {{-- name ,type, email , logo --}}
                        <div class="form-group mb-3">
                            <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$admin->name}}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nim" class="col-form-label">Nim <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nim" name="nim" value="{{$admin->nim}}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="email" name="email" value="{{$admin->email}}" required>
                        </div>
                        <div class="form-group mb-3" >
                            <label for="type" class="col-form-label">Position ID <span class="text-danger">*</span></label>
                            <select class="form-select" name="position_id" required>
                                <option value="{{ $admin->position_id }}" selected hidden>{{ $admin->position }}</option>
                                <option value="1">SC</option>
                                <option value="2">Director</option>
                                <option value="3">Coordinator</option>
                                <option value="4">Senior Staff</option>
                                <option value="5">Staff</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="department_id" class="col-form-label">Department ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="department_id" name="department_id" value="{{$admin->department_id}}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="department" class="col-form-label">Department <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="department" name="department" value="{{$admin->department_id}}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="division_id" class="col-form-label">Division ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="division_id" name="division_id" value="{{$admin->division_id}}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="division" class="col-form-label">Division <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="division" name="division" value="{{$admin->division}}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="col-form-label">Password <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter your old password or create a new one" required>
                        </div>

                    </div>
                </div>
            </x-card>
            <button type="submit" class="btn btn-outline-theme w-100 rounded-pill"> Save Changes </button>
              
        </form>
    </div>
</x-admin>