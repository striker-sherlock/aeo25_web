<x-user title="Create Other Slot">
    <style>
        span.position-absolute{
            top:3px;
            right:3px;
            width:20px;
            height:20px;
            cursor: pointer; 
            transition: 0.5s;
        }

        span.position-absolute:hover{
            background-color: #000;
            color:white;
        }
    </style>
    <div class="container mt-5">
        <x-card>
            <h3 class="text-uppercase fw-bold  aeo-title mb-4" style="letter-spacing: 0.1em">Select The Slot Bellow</h3>
            <br>
            <table class="table  table-bordered">
                <thead class="text-center">
                    <tr>
                        <th scope="col">Competition Field</th>
                        <th scope="col"> Number of Slot Registration</th>
                        <th scope="col"> Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($competitions as $competition )
                        <form action="{{route('slot-registrations.store')}}" method="POST" enctype="multipart/form-data">@csrf
                            @php($maxOBS = $competSlot-$registeredSpectators)
                            <input type="text" hidden name="compet_id[]" value="{{$competition->id}}">
                            <tr class="text-center">
                                <th class="position-relative ">{{$competition->name}} 
                                    <small class="text-muted">
                                        @if ($competition->id == 'OBS')
                                            ( Max slot = {{$maxOBS}})  
                                            <span class="d-flex justify-content-center align-items-center fs-6 position-absolute rounded-circle border fw-bold" title="see details" data-bs-toggle="modal" data-bs-target="#spectator-detail">!</span>
                                        @else 
                                            (Max slot = {{$maxIA}})
                                        @endif
                                    </small>

                                </th>
                                <th>
                                    <div class="form-row">
                                        
                                        @if ($competition->id =='OBS' && $maxOBS <= 0 )
                                            <a href="{{route('slot-registrations.create')}}" title="You have reached your spectators's slot limit or you might not have any confirmed competition slot yet "> Unable to register for Spectators </a>
                                        @elseif($competition->id == 'IA' && $maxIA <= 0)
                                            <a href="{{route('slot-registrations.create')}}" title="You have reached your Independent Adjudicator's slot limit or you might not have any confirmed atleast 2 debate competition slot yet "> Unable to register for Independent Adjudicator </a>
                                        @else
                                            <div class="col">
                                                <input type="number" class="form-control" value="" name="quantity[]-{{$competition->id}}" min="0" max="{{$competition->id == 'OBS' ? $maxOBS : $maxIA}}" placeholder="Enter number of slot that you want to register" required>
                                            </div>
                                        @endif
                                    </div>
                                </th>
                                <th>
                                    <button type="submit" class="btn btn-outline-theme w-100 rounded-20 {{($maxOBS == 0 && $competition->id == 'OBS')|| $maxIA == 0 && $competition->id == 'IA' ? 'disabled bg-secondary' : ''}}">Submit</button>
                                </th>
                            </tr>
                            
                        </form>
                    @endforeach

                </tbody>
            </table>
            {{-- <span class="fw-bold text-danger">*NB: Spectators </span> --}}
        </x-card>
    </div>
    {{-- modal untuk spectaros detail  --}}
    <div class="modal fade p-3" id="spectator-detail" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-20 border-0 shadow">
                <div class="modal-headers border-bottom-0 p-3 text-center    ">
                  <h3 class="text-uppercase fw-bold  text-center text-gradient mb-4" style="letter-spacing: 0.1em">Spectators Details </h3>
                   
                </div>
                <div class="modal-body" style="margin-top:-20px;">
                    <ul class="list-group" style="">
                        <li class="list-group-item">Spectators are not allowed to take pictures and videos during any participants’ performances.
                        </li>
                        <li class="list-group-item">Spectators should refrain from talking with volume that could potentially distract the participants or judges during competitions. 
                        </li>
                        <li class="list-group-item">Spectators are not allowed to interfere or distract the participants or judges during competitions.
                        </li>
                        <li class="list-group-item">Spectators are not allowed to bring sharp tools and/or dangerous weapons, liquids, and powders that can litter the performing room.
                        </li>
                        <li class="list-group-item"> Applause is only allowed after every performance.
                        </li>
                        <li class="list-group-item"> Spectators are not allowed to leave or enter the room when a participant is performing.</li>
                      </ul>
                   
                </div>
                <div class="modal-footers text-center">
                    <button type="button"
                        class="btn btn-success rounded-pill rounded-20 mb-4 px-4"
                        data-bs-dismiss="modal">
                        OK, I got it
                    </button>
                </div>
            </div>
        </div>  
      </div>  
    <script type="module">
        $(document).ready(function(){
            $('input[type="number"]').on('keyup change', function(e) {
                let max = parseInt($(this).attr('max'));
                let min = parseInt($(this).attr('min'));
                if ($(this).val() > max) $(this).val(max);
                else if ($(this).val() < min)$(this).val(min);}
            );
        })
    </script>
</x-user>