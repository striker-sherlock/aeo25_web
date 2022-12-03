<x-user title="Create Other Slot">
    <div class="container mt-5">
        <div class="alert alert-primary border-0 shadow-sm mb-3" role="alert" style="letter-spacing: .05em">
            <i class="fa-solid fa-triangle-exclamation me-1"></i> <b>Important rules!</b> <br>
            <ul>
                <li>Spectators are <b>not allowed</b> to take pictures and videos during any
                    participants' performances.
                </li>
                <li>Spectators <b>should refrain</b> from talking with volume that could <b>potentially
                        distract</b> the participants or judges during competitions.
                </li>
                <li>Spectators are <b>not allowed</b> to interfere or distract the participants or
                    judges during competitions.
                </li>
                <li>Spectators are <b>not allowed</b> to bring <b>sharp tools</b> and/or <b>dangerous weapons,
                        liquids, and powders</b> that can litter the performing room.
                </li>
                <li> Applause is <b>only allowed</b> after every performance.
                </li>
                <li> Spectators are <b>not allowed</b> to leave or enter the room when a participant is performing.</li>
            </ul>
        </div>
        <h2 class="aeo-title fw-semibold mb-4">How many spectators would you like to register?</h2>
        <form action="{{route('slot-registrations.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-start align-items-center">
                @foreach ($competitions as $competition)
                    <div class="col-md-4">
                        <div class="card rounded-20 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <img src="/storage/competition_logo/{{$competition->logo}}"
                                            alt="{{$competition->name}}'s logo" class="img-fluid mx-auto d-block">
                                    </div>
                                    <div class="col">
                                        <small class="text-muted text-uppercase"
                                            style="letter-spacing: .05em">spectators - <b>{{ $maxOBS }}</b> slot(s)
                                            available</small>
                                        <h3 class="text-gradient fw-semibold my-1" style="letter-spacing:   .05em">
                                            {{$competition->name}}</h3>
                                        <h5 class="mt-2 mb-3 text-dark-purple" style="letter-spacing: .05em">IDR
                                            {{ number_format($competition->price, 0, ',', '.') }}</h5>
                                        <input type="text" name="compet_id[]" hidden value="{{$competition->id}}">
                                        @if($maxOBS <= 0)
                                            <h5 class=" bg-danger text-white py-2 mx-auto fw-bold text-center" title="You have exceeded the slot limit or you do not have any confirmed slot" style="cursor:pointer">
                                                Unable to select this slot
                                            </h5>
                                            <input type="text" name="quantity[]-{{$competition->id}}"
                                                value="0" hidden>
                                        @else
                                            <div class="form-input">
                                                <button type="button" id="btnDecrement" class="btn btn-outline-primary me-2">-</button>
                                                <input type="text" id="counter" class="input-spinner" step="1"
                                                    name="quantity[]-{{$competition->id}}" value="0" min="0"
                                                    max="{{ $maxOBS }}" style="text-align: center; border: 0; background:
                                                    transparent; padding: 0; max-width: 3rem" readonly/>
                                                <button type="button" id="btnIncrement" class="btn btn-outline-primary ms-2">+</button>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="submit"
                class="btn btn-outline-primary w-100 rounded-20 mt-4 {{$maxOBS == 0 && $competition->id == 'OBS' ? 'disabled bg-secondary' : ''}}">Register
            </button>
        </form>
    </div>
    <script type="module">
        let currentCount = 0;
        var maxSlot = {{ $maxOBS }}

        $("#btnIncrement").click(function(){
            currentCount = parseInt($("#counter").val());
            
            if (currentCount >= maxSlot) {
                $("#btnIncrement").prop("disabled", true);
            }else {
                $("#btnIncrement").prop("disabled", false);
                $("#counter").val(currentCount + 1)
            }
        })
        
        $("#btnDecrement").click(function() {
            currentCount = parseInt($("#counter").val());
            
            if (currentCount <= 0) {
                $("#btnDecrement").prop("disabled", true);
            }else {
                $("#btnDecrement").prop("disabled", false);
                $("#counter").val(currentCount - 1)
            }
        })
    </script>
</x-user>
