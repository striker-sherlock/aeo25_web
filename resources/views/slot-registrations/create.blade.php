<x-user title="Competition Slot Registration">
    <div class="container mt-5 pb-5">
        <div class="alert alert-primary border-0 shadow-sm mb-3" role="alert" style="letter-spacing: .05em">
            <i class="fa-solid fa-triangle-exclamation me-1"></i> <b>Important info!</b> <br>
            You may leave the number '0' if you don't choose the competition field.
        </div>
        <h2 class="aeo-title fw-semibold mb-4">Which competition would you like to enter?</h2>
        <form action="{{route('slot-registrations.store')}}" method="POST" enctype="multipart/form-data"> 
            <div class="row justify-content-start align-items-center g-4">
                @csrf
                @foreach ($competitions as $competition) 
                    @if ($competition->id == 'IA' || $competition->id == 'OBS')@continue @endif   
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
                                            style="letter-spacing: .05em">competition</small>
                                        <h3 class="text-gradient fw-semibold my-1" style="letter-spacing: .05em">
                                            {{$competition->name}}</h3>
                                        <h5 class="mt-2 mb-3 text-dark-purple" style="letter-spacing: .05em">IDR
                                            {{ number_format($competition->price, 0, ',', '.') }}</h5>
                                        <input type="text" name="compet_id[]" hidden value="{{$competition->id}}">
                                        @php ($slot = 3)
                                        @if ($competition->temp_quota < $slot) 
                                            @php ($slot=$competition->temp_quota)
                                        @else
                                            @foreach ($competitionSlots as $competitionSlot)
                                                @if($competitionSlot->competition_id == $competition->id)
                                                    @php ($slot -= $competitionSlot->quantity)
                                                @endif
                                            @endforeach
                                        @endif
                                        @for($i=0 ; $i <= $slot; $i++ ) 
                                            @if ($slot==0) 
                                                <h5 class="border bg-danger text-white py-2 mx-auto fw-bold" style="max-width:50%;">
                                                    Unable to select this slot
                                                <h5>
                                                <input type="text" name="quantity[]-{{$competition->id}}" value="0" hidden>
                                                @break
                                            @endif
                                            <input type="radio" class="btn-check" name="quantity[]-{{$competition->id}}" id="{{$competition->id.$i}}" value="{{$i}}" {{$i == 0 ? 'checked' : ''}} hidden data-field="{{$competition->name}}" data-team={{$competition->need_team == 0? 'Person(s)':'Team(s)'}}>
                                            <label class="btn btn-outline-primary" for="{{$competition->id.$i}}">{{$i}}</label>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach    
                <hr>     
            </div>
            {{-- Independent Adjudicator Registration Section --}}
            <h2 class="aeo-title fw-semibold mb-3">Would you also like to register an Independent Adjudicator?</h2>
            {{-- <div class="alert alert-primary border-0 shadow-sm mb-4" role="alert"
                style="letter-spacing: .05em">
                <i class="fa-solid fa-circle-question me-1"></i> <b>What is Independent Adjudicator?</b> <br>
                Independent Adjudicator is Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea praesentium omnis deleniti.
            </div> --}}
            <div class="row justify-content-start align-items-center">
                @foreach ($competitions->where('id', 'IA') as $independentAdju)
                    <div class="col-md-4">
                        <div class="card rounded-20 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        <img src="/storage/competition_logo/{{$independentAdju->logo}}"
                                            alt="{{$independentAdju->name}}'s logo" class="img-fluid mx-auto d-block">
                                    </div>
                                    <div class="col">
                                        <small class="text-muted text-uppercase"
                                            style="letter-spacing: .05em">adjudicator</small>
                                        <h3 class="text-gradient fw-semibold my-1" style="letter-spacing: .05em">
                                            {{$independentAdju->name}}</h3>
                                        <h5 class="mt-2 mb-3 text-dark-purple" style="letter-spacing: .05em">IDR
                                            {{ number_format($independentAdju->price, 0, ',', '.') }}</h5>
                                        <input type="text" name="compet_id[]" hidden value="{{$independentAdju->id}}">
                                        @php ($slot = 3)
                                        @if ($independentAdju->temp_quota < $slot) 
                                            @php ($slot=$independentAdju->temp_quota)
                                        @else
                                            @foreach ($competitionSlots as $competitionSlot)
                                                @if($competitionSlot->competition_id == $competition->id)
                                                    @php ($slot -= $competitionSlot->quantity)
                                                @endif
                                            @endforeach
                                        @endif
                                            @for($i=0 ; $i <= $slot; $i++ ) 
                                                @if ($slot==0) 
                                                    <h5 class="border bg-danger text-white py-2 mx-auto fw-bold" style="max-width:50%;">
                                                        Unable to select this slot
                                                    <h5>
                                                    <input type="text" name="quantity[]-{{$independentAdju->id}}"
                                                        value="0" hidden>
                                                    @break
                                                @endif
                                                <input type="radio" class="btn-check" name="quantity[]-{{$independentAdju->id}}" id="{{$independentAdju->id.$i}}" value="{{$i}}" {{$i == 0 ? 'checked' : ''}} hidden data-field="{{$independentAdju->name}}" data-team={{$independentAdju->need_team == 0? 'Person(s)':'Team(s)'}}>
                                                    <label class="btn btn-outline-primary" for="{{$independentAdju->id.$i}}">{{$i}}</label>
                                            @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="btn btn-outline-primary w-100 rounded my-4 rounded-pill" data-bs-toggle="modal"
                data-bs-target="#modal">Register</a>
            </div>
            {{-- modal confirmasi --}}
            <div class="modal fade p-5" id="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content rounded-20 border-0 shadow p-5">
                        <div class="modal-headers mb-4">
                            <span class="fa-stack fa-4x d-block mx-auto">
                                <i class="fas fa-circle fa-stack-2x text-danger"></i>
                                <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                            </span>
                            </div>
                            <div class="body mb-3">
                                <h1 class="fw-bold fs-4 text-center">Registration Slot Confirmation</h1>
                                <h6 class="fs-6">Registration Summary: </h6>
                                <ul class="unstyled-list">
                                </ul>
                            </div>
                            <div class="">
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="close btn rounded-pill btn-outline-secondary w-100" data-bs-dismiss="modal">Back</button>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="rounded-pill btn btn-outline-theme w-100">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            // $('#modal').modal({backdrop: 'static', keyboard: false})  
            $('a.btn').click(function(){
                const radio = document.querySelectorAll('input[name]:checked')
                 
                radio.forEach(el => {
                    if(el.value != 0)$('ul.unstyled-list').append(`<li class="fw-bold">${el.dataset.field} : ${el.value} ${el.dataset.team}</li>`)
                });
            })
            $('button.close').click(function(){
                $('ul li').remove()
            })
        })
    </script>
</x-user>
