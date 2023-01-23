<x-admin>
    <div class="container mt-4">
        <x-card>
            <h1 class="text-uppercase fw-bold text-gradient mb-4" style="letter-spacing: 0.1em">Create New Schedule </h1>
            <form action="{{route('pick-up-schedules.update',$schedule->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="schedule" class="col-form-label">Schedule Time<span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" id="schedule" placeholder="Enter Flight Time" name="schedule" required value="{{$schedule->schedule}}" min="2023-02-10T00:00:00">
                </div>
                <div class="row">
                    <div class="col">
                        <a href="{{route('pick-up-schedules.index')}}" class="btn btn-outline-secondary rounded-pill  w-100"> Back</a>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-outline-theme rounded-pill  w-100"> Save Changes</button>
                    </div>
                </div>
            </form>
        </x-card>
    </div>
</x-admin>