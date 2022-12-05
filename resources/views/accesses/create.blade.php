<x-admin >
    <div class="container mt-3">
        <x-card>
            <a href="{{ route("accesses.index") }}" class="btn btn-outline-secondary mb-3">Back</a>
            <h3 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">Create New Access</h3>
            <form method="POST" action="{{route('accesses.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter access name">
                </div>
                <button type="submit" class="btn btn-outline-primary w-100 rounded-pill">Submit</button>
            </form>
            </x-card>    
    </div>    
</x-admin>