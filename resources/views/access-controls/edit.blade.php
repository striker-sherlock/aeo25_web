<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow  mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <div class="my-2">
                    <a class="" href="{{ route('access-controls.index') }}" title="Back to Main Menu">
                        <i class="fas fa-arrow-circle-left fa-2x"></i>
                    </a>

                </div>
                <h3 class="fw-bold  text-primary">Access Controls</h3>
                <h6> Edit Access Control</h6>
                <form method="POST" action="{{ route('access-controls.update', $accessControl) }}" enctype="multipart/form-data">
                    @csrf
                    @method('UPDATE')
                    <div class="my-3">
                        <label for="access_id" class="mb-2">Accesses Name</label>
                        <select name="access_id" class="form-select " required placeholder="ABCDE"
                            onchange="showFileForm(this)">
                            <option value="" selected disabled>Choose...</option>
                            @foreach ($accesses as $access)
                                <option value="{{ $access->id }}"
                                    {{ $accessControl->access->id == $access->id ? 'selected' : '' }}>
                                    {{ $access->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="my-3">
                        <label for="admin_id" class="mb-2">Admin</label>
                        <select name="admin_id" class="form-select ">
                            <option value="" selected disabled>Choose...</option>
                            @foreach ($admins as $admin)
                                <option value="{{ $admin->id }}" @if ($admin->id == $accessControl->admin_id) selected @endif>
                                    {{ $admin->name }} - <strong>{{ $admin->division }}</strong>
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @method('PUT')
                    <button type="submit" class="btn btn-outline-theme rounded-pill w-100">Submit</button>
                </form>

            </div>

        </div>
    </div>

</x-admin>
