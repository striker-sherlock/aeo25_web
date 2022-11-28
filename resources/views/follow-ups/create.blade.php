<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">

                <h3 class="fw-bold  text-primary ">Follow Up</h3>
                <h6> Create New Follow Up</h6>

                <form action="{{ route('follow-ups.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-3">
                        <label for="is_national" class="col-form-label">
                            Nationality Type <span class="text-danger">*</span></label>

                        <select name="is_national" class="form-select" required autofocus>
                            @if ($type == 'national')
                                <option value='1' @if (old('is_national') == true) selected @endif>National</option>
                            @else
                                <option value='0' @if (old('is_national') == false) selected @endif>International
                                </option>
                            @endif

                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="type" class="col-form-label">
                            Follow Up Type <span class="text-danger">*</span></label>
                        <select name="type_id" class="form-select " required autofocus>
                            <option value="" selected disabled>Choose...
                            </option>
                            @foreach ($followUpTypes as $followUpType)
                                <option value={{ $followUpType->id }} selected>{{ $followUpType->name }} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="priority" class="col-form-label">
                            Priority <span class="text-danger">*</span></label>
                        <select name="priority" class="form-select" required autofocus>
                            <option value="" selected disabled>Choose...
                            </option>
                            <option value="1" @if (old('priority') == '1') selected @endif>Low</option>
                            <option value="2" @if (old('priority') == '2') selected @endif>Medium</option>
                            <option value="3" @if (old('priority') == '3') selected @endif>High</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="detail">Follow Up Detail <span
                                class="text-danger">*</span></label>
                        <textarea class="form-control rounded-20" cols="30" rows="7" id="detail" name="detail"
                            value="{{ old('detail') }}" class="form-control"required autofocus>{{ old('detail') }}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="user_id">PIC ID <span class="text-danger">*</span></label>
                        <input list="users" type="number" min="1" name="user_id" id="user_id"
                            class="form-control rounded-20" value="{{ old('user_id') }}" required autofocus>
                        <datalist id="users">
                            @foreach ($users as $user)
                                <option value={{ $user->id }}>{{ $user->id }} ({{ $user->institution_name }})
                                </option>
                            @endforeach
                        </datalist>
                    </div>
                    <input type="hidden" id="status" name="status" class="form-control" value="1">
                    <div class="form-group row mt-5">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-theme rounded-pill w-100">Submit</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>

</x-admin>
