<x-admin>
    <div class="container mt-4">
        <div class="card border-0 overflow-hidden shadow rounded-20 mb-5" style="border-radius:20px">
            <div class="card-header bg-secondary"></div>
            <div class="card-body my-3">
                <div class="title-line"></div>
                <h5 class="subheading-text mt-3">Follow Ups</h5>
                <h3 class="fw-bold my-3 c-text-1">Edit Follow Up - {{ $followUp->id }} </h3>
                <hr>
                @if ($followUp->status == 1)
                    <form method="POST" action="{{ route('follow-ups.assign-pic', $followUp) }} ">
                    @else
                        <form method="POST" action="{{ route('follow-ups.update', $followUp) }}"
                            enctype="multipart/form-data">
                @endif

                @csrf
                @method('UPDATE')
                <div class="form-group mb-3">
                    <label class="col-form-label" for="creator_id">Creator</label>
                    <input type="text" id="creator_name" name="creator_name" class="form-control "
                        value="{{ $followUp->creator->name }}" readonly>
                    <input type="hidden" name="creator_id" value="{{ $followUp->creator_id }}" />
                </div>
                @if ($followUp->status != 1)
                    <div class="form-group mb-3">
                        <label for="pic_name" class="col-form-label">Follow Up PIC</label>
                        @if ($followUp->pic)
                            <input type="text" id="pic_name" name="pic_name" class="form-control "
                                value="{{ $followUp->pic->name }}" readonly>
                        @else
                            <input type="text" id="pic_name" name="pic_name" class="form-control "
                                value="Unassigned" readonly>
                        @endif
                    </div>
                @endif
                <div class="form-group mb-3">
                    <label for="type" class="col-form-label">
                        Follow Up Type</label>
                    @if ($followUpType == 'Overslot')
                        <input type="text" id="type" name="type" class="form-control " value="Overslot"
                            readonly>
                    @elseif($followUpType == 'Payment')
                        <input type="text" id="type" name="type" class="form-control " value="Payment"
                            readonly>
                    @else
                        <input type="text" id="type" name="type" class="form-control " value="General"
                            readonly>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label for="priority" class="col-form-label">
                        Priority</label>
                    @if ($followUp->priority == 1)
                        <input type="text" id="priority" name="priority" class="form-control " value="Low"
                            readonly>
                    @elseif($followUp->priority == 2)
                        <input type="text" id="priority" name="priority" class="form-control " value="Medium"
                            readonly>
                    @else
                        <input type="text" id="priority" name="priority" class="form-control " value="High"
                            readonly>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label class="col-form-label" for="detail">Follow Up Detail</label>
                    <textarea class="form-control " cols="30" rows="7" id="detail" name="detail"
                        value="{{ $followUp->detail }}" class="form-control"readonly>{{ $followUp->detail }}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label class="col-form-label" for="notes">Notes <span class="text-danger">*</span></label>
                    @if ($followUp->status == 2)
                        <textarea class="form-control " cols="30" rows="7" id="notes" name="notes"
                            value="{{ $followUp->notes }}" class="form-control" required autofocus>{{ $followUp->notes }}</textarea>
                    @elseif($followUp->status == 3)
                        <textarea class="form-control " cols="30" rows="7" id="notes" name="notes"
                            value="{{ $followUp->notes }}" class="form-control" autofocus>{{ $followUp->notes }}</textarea>
                    @else
                        <textarea class="form-control " cols="30" rows="7" id="notes" name="notes"
                            value="{{ $followUp->notes }}" class="form-control" readonly>{{ $followUp->notes }}</textarea>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <label class="col-form-label" for="user_id">Institution PIC</label>
                    <input type="text" id="user_name" name="user_name" class="form-control "
                        value="{{ $followUp->user->pic_name }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label class="col-form-label" for="user_id">PIC Email</label>
                    <input type="text" id="user_name" name="user_name" class="form-control "
                        value="{{ $followUp->user->email }}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="status" class="col-form-label">
                        Status </label>
                    @if ($followUp->status == 1)
                        <input type="text" id="status" name="status" class="form-control " value="Pending"
                            readonly>
                    @elseif($followUp->status == 2)
                        <input type="text" id="status" name="status" class="form-control "
                            value="On Progress" readonly>
                    @else
                        <input type="text" id="status" name="status" class="form-control " value="Done"
                            readonly>
                    @endif
                </div>

                @if ($followUp->status == 1)
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="pic_id">Assigned To <span
                                class="text-danger">*</span></label>
                        <select name="pic_id" class="form-select" placeholder="" required autofocus>
                            <option value="" selected disabled>Choose...
                            </option>
                            @foreach ($staffRegists as $staffRegist)
                                <option value="{{ $staffRegist->id }}">{{ $staffRegist->id }} -
                                    {{ $staffRegist->name }}</option>
                            @endforeach
                        </select>

                        @method('PUT')
                        @csrf
                        <div class="form-group row mt-5">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success text-white rounded-pill onclick="return
                                    confirm('Are you sure you want to Confirm this Follow Up?')">Handle</button>
                            </div>
                        </div>
                    </div>
                @elseif($followUp->status == 3)
                    <div class="form-group row mt-5">
                        <div class="d-grid gap-2">
                            @method('PUT')
                            <button type="submit" class="btn btn-outline-1 ">Save Changes</button>
                        </div>
                    </div>
                @else
                @method('PUT')
                    <div class="form-group row mt-5">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-primary  btn-submit">Proceed</button>
                        </div>
                    </div>
                    </form>

                @endif
            </div>
        </div>

    </div>
    </div>

</x-admin>
