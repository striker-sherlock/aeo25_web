<x-admin title="Create New Schedule - The 2022 Asian English Olympics">
        <div class="container mt-4 ">
            <x-card>
                <div class="row justify-content-center align-items-center">
                    <div class="col-11 col-lg-11">
                         <h3 class="fw-bold my-3 c-text-1 text-gradient">Create New Schedule</h3>
                         <hr>
                        <form action="{{ route('schedules.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            @if (Auth::guard('admin')->user()->department_id == "CP"  ||Auth::guard('admin')->user()->department_id == "SC" || (Auth::guard('admin')->user()->division_id == "MIT"))
                                 @php
                                     $competitions = App\Models\Competition::all();
                                 @endphp
                                 <div class="form-group mb-3">
                                     <label class="col-form-label" for="event_init">Schedule Type<span class="text-danger"> *</span></label>
                                     <select class="form-select " aria-label="select event" name="event_init">
                                         <option selected>Select Schedule Type</option>
                                         @foreach ($competitions as $competition)
                                             <option value="{{ $competition->id }}" name="event_init">{{ $competition->name }}</option>
                                         @endforeach
                                     </select>
                                 </div>
                             @elseif (Auth::guard('admin')->user()->department_id == "EV")
                                 <div class="form-group mb-3">
                                     <label class="col-form-label" for="event_init">Schedule Type<span class="text-danger"> *</span></label>
                                     <input type="text" name="event_initial" id="event_initial" class="form-control " value="Main Event" required disabled readonly>
                                     <input type="hidden" name="event_init" id="event_init" class="form-control " value="EV" hidden>
                                 </div>
                              @endif
                             <div class="form-group mb-3">
                                 <label class="col-form-label" for="event_name">Event Name<span class="text-danger"> *</span></label>
                                 <input type="text" name="event_name" id="event_name" class="form-control " value="{{ old('event_name') }}" required autofocus>
                             </div>
                             <div class="form-group mb-3">
                                 <label class="col-form-label" for="start_time">Event Start<span class="text-danger"> *</span><small class="text-muted"> format : dd-mm-yyyy H:i</small></label>
                                 <input type="text" name="start_time" id="start_time" class="form-control " value="{{ old('start_time') }}" placeholder="dd-mm-yyyy H:i" required autofocus>
                             </div>
                             <div class="form-group mb-3">
                                 <label class="col-form-label" for="end_time">Event End<span class="text-danger"> *</span> <small class="text-muted"> format : dd-mm-yyyy H:i</small> </label>
                                 <input type="text" name="end_time" id="end_time" class="form-control " value="{{ old('end_time') }}" placeholder="dd-mm-yyyy H:i" required autofocus>
                             </div>
                            <div class="form-group my-4">
                                <div class="d-grid gap-2 mt-3 p-0">
                                    <button type="submit" class="btn btn-outline-primary btnSubmit  text-uppercase">Create New Schedule</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </x-card>
        </div>
</x-admin>





