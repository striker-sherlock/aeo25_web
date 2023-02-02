<x-user title="Main Dashboard">
    <style>
        table .btn {
            width: 100%;
        }
    </style>
   


    <div class="container mt-5 mb-5">
        <div class="">
            <h2 class="fw-bold text-capitalize text-gradient">Welcome back, {{Auth::user()->pic_name}} </h2>
            <h5 class="text-muted fs-6">Welcome to The 2023 Asian English Olympics!</h5>
            <hr>
        </div>
        <div class="alert alert-info border-0 shadow-sm mb-3" role="alert" style="letter-spacing: .05em">
            <div class="row">
                <div class="col-lg-8">
                    <i class="fas fa-bullhorn"></i>
                    Don't forget to join The 2023 AEO - PICs Group via WhatsApp. If you have any questions regarding the competition, you can also ask it there.
                </div>
                <div class="col-lg-4 text-lg-end text-start">
                    <a href="https://chat.whatsapp.com/Gqcj95O4PAuLgVBFB5N7rG" target="_blank" class="text-reset text-decoration-none">
                        Join Now
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        @if ($confirmedSlotRegistration->count() > 0)
            <div class="alert alert-info border-0 shadow-sm mb-3" role="alert" style="letter-spacing: .05em">
                <div class="row">
                    <div class="col-lg">
                        <i class="fas fa-bullhorn"></i>
                        Want to watch the thrill of our competitions? Let's register as <b>Spectators</b>!
                    </div>
                    <div class="col-lg text-lg-end text-start">
                        <a href="{{route('slot-registrations.create-other')}}" class="text-reset text-decoration-none">
                            Register now
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        {{-- competition step  --}}
        <div class="step-by-step-compet row">
            <h3 class="text-uppercase fw-bold my-4 text-gradient" style="letter-spacing: 0.1em">Competition Step by step Registration</h3>
            <div class="col-md ">
                <a href="{{route('dashboard.step',1)}}" class="d-block text-decoration-none btn ">
                    @php($totalSlot = $allSlotRegistration->count())
                    @php($confirmedRegistration = $confirmedSlotRegistration->count())
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 shadow-sm {{$totalSlot - $confirmedRegistration != 0 || $totalSlot == 0 ? 'focused':'shadow-sm'}}" style="border-radius:20px">
                        <div class="card-header"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 1</h2>
                            <h4>Confirmed Slots Registration </h4>
                            <h1 class="display-3 fw-bold {{$confirmedSlotRegistration->count()- $allSlotRegistration->count() != 0 || $totalSlot == 0 ? 'text-danger':'text-success'}}">{{$confirmedSlotRegistration->count()}}<span class="fs-4">/{{$allSlotRegistration->count()}}</span> </h1>
            
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-md ">
                    <a href="{{route('dashboard.step',2)}}" class="d-block text-decoration-none btn" title="You must have at least 1 confirmed slot registration to move into this step">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5
                    {{-- {{dd($confirmedSlotRegistration->count())}} --}}
                    {{$totalSlot - $confirmedPayment != 0 &&  $confirmedSlotRegistration->count() != 0 ? 'focused':'shadow-sm'}}" style="border-radius:20px">
                        <div class="card-header"></div>
                        <div class="card-body my-3 p-4 position-relative">
                            <h2 class="fw-bold">STEP 2</h2>
                            @if (!$confirmedSlotRegistration->count())
                                <i class="fas fa-lock" style="font-size: 5em"></i>
                                <h4 class="mt-3 fw-bold">LOCKED</h4>
                                <small style="font-size: 0.7em" class="text-danger" >*you have to finish previous step first</small>
                            @else
                                <h4>Total Paid Slots Registration </h4>
                                <h1 class="display-3 fw-bold {{$confirmedPayment - $allSlotRegistration->count() == 0 ? 'text-success' : 'text-danger'}}">{{$confirmedPayment}}<span class="fs-4">/{{$allSlotRegistration->count()}}</span> </h1>
                            @endif
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md">
                <a href="{{route('dashboard.step',3)}}" class="d-block text-decoration-none btn" title="You must have at least 1 confirmed payment slot to move into this step">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 {{ $participantCompetition != 0 && $confirmedPayment ? 'focused':'shadow-sm'}}" style="border-radius:20px">
                        <div class="card-header"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 3</h2>
                            @if(!$confirmedPayment)
                                <i class="fas fa-lock" style="font-size: 5em"></i>
                                <h4 class="mt-3 fw-bold">LOCKED</h4>
                                <small style="font-size: 0.7em" class="text-danger" >*you have to finish previous step first</small>
                            @else
                                <h4>Total Participants Registered</h4>
                                <h1 class="display-3 fw-bold">{{$totalParticipants}}</h1>
                            @endif
                        </div>
                    </div>
                </a>
            </div>

        </div>
         
        <hr>
        {{-- accommodation step --}}
        <div class="step-by-step-accommodation row">
            <h3 class="text-uppercase fw-bold  my-4 text-gradient" style="letter-spacing: 0.1em">Accommodation Step By Step Registration</h3>
            <div class="col-md-4">
                @php($totalAccSlot = $allAccSlot->count())
                <a href="{{route('dashboard.accommodation-step',1)}}" class="d-block text-decoration-none btn ">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 {{$totalAccSlot - $confirmedAccSlot != 0 || $totalAccSlot == 0 ? 'focused':'shadow-sm'}}" style="border-radius:20px">
                        <div class="card-header"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 1</h2>
                            <h4>Confirmed Accommodation Slot </h4>
                            <h1 class="display-3 fw-bold {{$totalAccSlot - $confirmedAccSlot != 0 || $totalAccSlot == 0 ? 'text-danger':'text-success'}}">{{$confirmedAccSlot}}<span class="fs-4">/{{$totalAccSlot}}</span> </h1>
            
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{route('dashboard.accommodation-step',2)}}" class="d-block text-decoration-none btn ">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 {{$totalAccSlot - $confirmedAccPayment != 0 && $totalAccSlot != 0 ? 'focused':'shadow-sm'}}" style="border-radius:20px">
                        <div class="card-header"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 2</h2>
                            @if (!$confirmedAccSlot)
                                <i class="fas fa-lock" style="font-size: 5em"></i>
                                <h4 class="mt-3 fw-bold">LOCKED</h4>
                                <small style="font-size: 0.7em" class="text-danger" >*you have to finish previous step first</small>
                            @else
                                <h4>Total Paid Slot Accommodation </h4>
                                <h1 class="display-3 fw-bold {{$confirmedAccPayment - $totalAccSlot == 0 ? 'text-success' : 'text-danger'}}">{{$confirmedAccPayment}}<span class="fs-4">/{{$totalAccSlot}}</span> </h1>
                            @endif
            
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{route('dashboard.accommodation-step',3)}}" class="d-block text-decoration-none btn ">
                    <div class="card border-0 overflow-hidden rounded-20 mb-5 {{ $accGuests != 0 &&$confirmedAccPayment ? 'focused':'shadow-sm'}} " style="border-radius:20px">
                        <div class="card-header"></div>
                        <div class="card-body my-3 p-4">
                            <h2 class="fw-bold">STEP 3</h2>
                            @if(!$confirmedAccPayment)
                                <i class="fas fa-lock" style="font-size: 5em"></i>
                                <h4 class="mt-3 fw-bold">LOCKED</h4>
                                <small style="font-size: 0.7em" class="text-danger" >*you have to finish previous step first</small>
                            @else
                                <h4>Accommodation Guest Registered</h4>
                                <h1 class="display-3 fw-bold">{{$totalGuests}}</h1>
                            @endif
            
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- registration list --}}
        <x-card>
            <h3 class="text-uppercase fw-bold mb-3 text-gradient" style="letter-spacing: 0.1em">Your Slots Registration Summary</h3>
            @if ($allSlotRegistration->count())
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-center align-middle">
                        <tr>
                            <th scope="col">Competition Field</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Slot Status</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Participant</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($allSlotRegistration as $slot)
                            <tr class="text-center align-middle">
                                <th >{{$slot->competition->name}}</th>
                                <th > {{$slot->quantity}} Slot(s)</th>
                                <th>
                                    @if ($slot->is_confirmed == 0)
                                        <span class="text-warning fw-bold">Wait for Confirmation </span>
                                        @elseif ($slot->is_confirmed == 1)
                                        <span class="text-success fw-bold ">Confirmed {{\Carbon\Carbon::parse($slot->confirmed_at)->diffForHumans()}}</span>
                                        @else <span class="text-danger fw-bold">Rejected (check email for the reason)</span>
                                        @endif
                                    </th>
                                    
                                    <th>
                                        @if ($slot->payment == NULL)
                                            @if ($slot->is_confirmed == 1)
                                                <a href="{{route('dashboard.step',2)}}" class="btn btn-outline-success rounded-20">Make Payment</a>
                                            @endif
                                        @else 
                                            @if ($slot->payment->is_confirmed == 0)
                                                <span class="text-warning fw-bold">Wait for Confirmation</span>
                                            @elseif($slot->payment->is_confirmed == 1)
                                                {{-- kasi payment Receipt nya disini --}}
                                                <a href="{{route('payments.paid-invoice', $slot->payment->id)}}" class="btn btn-outline-info rounded-pill mt-2" target="_BLANK"> View Receipt</a>
                                            @else
                                                <span class="text-danger fw-bold">Rejected</span>
                                            @endif    
                                        @endif
                                    </th>
                                <th> 
                                    @if ($slot->competitionParticipants->count() > 0)
                                            <a href="{{route('competition-participants.show',[Auth::user()->id,$slot->competition->id])}}" class="btn btn-outline-info rounded-pill mt-2">View Participant</a>
                                    @else
                                        @if ($slot->payment != NULL)
                                           @if ($slot->payment->is_confirmed == 1)
                                           <a href="{{route('competition-participants.create',$slot->id)}}" class="btn btn-outline-success rounded-pill mt-2">Add Participant</a>    
                                           @endif
                                        @endif
                                    @endif
                                </th>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            <p class="text-danger fw-bold">*Note : You must finish the payments D+10 days after the slot confirmed </p>
            @else <hr> 
                <p class="text-center fs-4">No Slot Registered Yet</p>
                <a href="{{route('slot-registrations.create')}}" class="d-block mx-auto btn btn-outline-theme rounded-pill w-50">Add New Registration Slot</a> 
            @endif

        </x-card>

        {{-- participant list --}}
        <x-card>
            <h3 class="text-uppercase fw-bold mb-3 text-gradient" style="letter-spacing: 0.1em">Your Participants List</h3>
            @if ($totalParticipants)
                <div class="table-responsive">
                    <table class="table table-striped table-bordered dataTables " >
                        <thead class="text-center">
                            <tr>
                                <th scope="col align-middle ">Participant Name</th>
                                <th scope="col align-middle">Competition Field</th>
                                <th scope="col align-middle">Email</th>
                                
                                <th scope="col align-middle text-center">
                                    Food Coupon Code 
                                    <br><small style="font-size:0.7em;" class="m-0 p-0 text-info">Click the QR code to see the bigger view</small>
                                </th>

                                <th scope="col align-middle">Send Food Coupon</th>

                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($allParticipants as $participant)
                                <tr class="text-center align-middle">
                                    <th>{{$participant->name}}</th>
                                    <th>{{$participant->competition->name}}
                                        @if ($participant->competition->need_team)
                                            <span>({{$participant->competitionTeam->name}})</span>
                                        @endif
                                    </th>
                                    <th>{{$participant->email}}</th>
                                    <th>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#QR-code{{$participant->id}}">
                                            <div class="visible-print text-center" title="view bigger" style="cursor: pointer" >
                                                {!! QrCode::format('svg')->size(70)->generate(route('food-coupons.create',$participant->id)); !!}
                                            </div>
                                        </a>
                                    </th>
                                    <th>
                                        <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Send QR to the participant through their email">
                                            <a href="{{route('food-coupons.sendQR',$participant->id)}}" class="btn btn-outline-theme rounded-pill confirm">Send food coupon</a>
                                        </span>
                                        
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else 
            <hr><p class="text-center fs-4" >No Participant Registered Yet</p>
            @endif

        </x-card>
    </div>

    @foreach ($allParticipants as $participant)
      <div class="modal fade modal-lg" id="QR-code{{$participant->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered ">
              <div class="modal-content rounded-20 border-0 shadow p-5">
                  <div class="modal-headers mb-4">
                    <h3 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">{{$participant->name}}'s Food Qr Code </h3> 
                    <hr>
                  </div>
                  <div class="body mb-3 text-center">
                        {!! QrCode::format('svg')->size(300)->generate(route('food-coupons.create',$participant->id)); !!}
                  </div>
                  <div class="footers">
                     
                  </div>
              </div>
          </div>  
      </div>  
    @endforeach
 
</x-user>
