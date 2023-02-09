<x-user title="Create Flight Registration">
    <div class="container mt-5">
        <x-card>
            <h3 class="text-uppercase fw-bold text-gradient " style="letter-spacing: 0.1em">Create Flight Registration</h3>
                <form action="{{route('flight-registrations.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label class="col-form-label" for="type">Type <span class="text-danger">*</span></label><br>
                        <input type="radio" class="btn-check" name="options" id="option1" autocomplete="off" checked>
                        <input type="radio" name="type" id="DEPARTURE" value="DEPARTURE" required>
                        <label for="DEPARTURE">Departure</label>
                        <input type="radio" name="type" id="ARRIVAL" value="ARRIVAL" required>
                        <label for="ARRIVAL">Arrival</label>
                        <br><small class="text-muted fw-bold">Departure = Departure from Jakarta</small>
                        <br><small class="text-muted fw-bold">Arrival = Arrival in Jakarta</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="airline_name" class="col-form-label">Airline Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="airline_name" placeholder="Enter Airline Name" value="{{old('airline_name')}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="flight_time" class="col-form-label">Flight Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" class="form-control" id="flight_time" placeholder="Enter Flight Time" name="flight_time" required value="{{old('flight_time')}}" min="2023-02-09T00:00:00" >
                    </div>
                    <div class="form-group mb-3">
                        <label for="ticket_proof" class="col-form-label">Ticket Proof <span class="text-danger">*</span></label>
                        <small class="text-muted" style="font-size: 0.8em">(You are able to upload more than one file by pressing <b>CTRL</b> while selecting picture)</small>
                        <input type="file" class="form-control" name="ticket_proof[]" accept="image/png, image/jpeg, image/jpg" multiple required>
                        <small class="text-danger " style="font-size: 0.7em">Type: PNG, JPG, JPEG max: 3MB</small>
                    </div>
            </x-card>
            <x-card>
                <h3 class="text-uppercase fw-bold text-gradient mb-4" style="letter-spacing: 0.1em">Select Pick Up Schedule (OPTIONAL)</h3>
                
                <div class="form-group mb-2">
                    <label for="schedule" class="col-form-label">Pick Up Schedule<span class="text-danger">*</span></label>
                    <select class="form-select"  name="schedule" id="schedule" >  
                        <option selected class="d-none" disabled id="first-option"> Please fill the flight time first </option>
                        @foreach ($schedules as $schedule)
                            <option value="{{$schedule->id}}" {{old('schedule') == $schedule->id? 'selected' : ''}} data-date="{{$schedule->schedule}}" class="schedules">{{date('D, d M Y H:i',strtotime($schedule->schedule))}} (GMT + 7)</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="people" class="col-form-label">How many people will be there <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="people" placeholder="" value="{{old('people')}}">
                </div>


                <button id="confirm" type="button" data-bs-toggle ="modal" data-bs-target="#confirmation "class="btn btn-outline-primary w-100 rounded mb-4 rounded-pill">Submit</button>   
            </x-card>
        </div>
        <div class="modal fade p-5" id="confirmation" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content rounded-20 border-0 shadow p-5">
                <div class="modal-headers mb-4">
                    <span class="fa-stack fa-4x d-block mx-auto" >
                        <i class="fas fa-circle fa-stack-2x text-danger"></i>
                        <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                    </span>
                </div>
                <div class="body mb-3">
                    <h1 class="fs-3 text-center" > Are you sure about your ticket registration? </h1>
                </div>
                <div class="modals-footer">
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-outline-secondary w-100 rounded-pill"  data-bs-dismiss="modal">Back</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-outline-theme w-100 rounded-pill">Submit</button>
                        </div>
                    </div>  
                </div>
            </div>
        </div>  
      </div> 
    </form>
    <script type="module">
        function checkDate(date1, date2){
            return date1 < date2 ? true : false
        }

        $(document).ready(function(){
            if ($('#flight_time').val() == '')$('#schedule').attr('disabled',true)
            else {$('#schedule').attr('disabled',false)}

            $('#flight_time').change(function(){
                $('#schedule').attr('disabled',false)
                $('#first-option').text('Please choose the pick up time here ....')
                $('.schedules').attr('disabled',false)
                
                let date2 = $(this).val();
                console.log(date2)
                let schedules = document.querySelectorAll('.schedules');
                schedules.forEach(element => {
                    let date1 = element.dataset.date
                    console.log(date1);
                    if (checkDate(date1,date2))element.setAttribute('disabled',true)
                     
                });

            })
        })
    </script>
</x-user>