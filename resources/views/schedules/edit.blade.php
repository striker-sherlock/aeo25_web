<x-admin>
        <div class="container mt-4">
            <x-card>
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-11 col-11">
                        <div class="title-line"></div> 
                         <h3 class="fw-bold my-3 c-text-1 text-gradient">Edit Schedule - ID: {{ $schedule->id }}</h3>
                         <hr>
                         <form method="POST" action="{{ route('schedules.update', $schedule)}}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('UPDATE')
                            <div class="form-group mb-3">
                                <input type="hidden" id="event_init" name="event_init" class="form-control " value="{{ $schedule->event_init }}">
                                <div class="callout callout-primary card-shadow-sm"><b>Schedule type:</b> {{ ($schedule->schedule_type == "EV") ? 'Event' : 'Competition' }} - {{ $schedule->event_init }}</div>
                            </div>
                             <div class="form-group mb-3">
                                 <label class="col-form-label" for="event_name">Event Name <span class="text-danger">*</span></label>
                                 <input type="text" id="event_name" name="event_name"
                                 class="form-control " value="{{ $schedule->event_name }}" required autofocus>
                             </div>
                             <div class="form-group mb-3">
                                 <label class="col-form-label" for="start_time">Event Start <span class="text-danger">*</span><small class="text-muted"> format : dd-mm-yyyy H:i</small></label>
                                 <input type="text" id="start_time" name="start_time"
                                 class="form-control " value="{{ $schedule->start_time }}" required autofocus placeholder="dd-mm-yyyy H:i">
                             </div>
                             <div class="form-group mb-3">
                                 <label class="col-form-label" for="end_time">Event End <span class="text-danger">*</span><small class="text-muted"> format : dd-mm-yyyy H:i</small></label>
                                 <input type="text" id="end_time" name="end_time"
                                 class="form-control " value="{{ $schedule->end_time }}" required autofocus placeholder="dd-mm-yyyy H:i">
                             </div>
                            
                             <div class="form-group my-4">
                                 @method('PUT')
                                 <div class="d-grid gap-2 mt-3">
                                     <button type="submit" class="btn btn-outline-primary  btnSubmit text-uppercase">save changes</button>
                                 </div>
                             </div>
                         </form>
                    </div>
                </div>

            </x-card>
        </div>
</x-admin>
