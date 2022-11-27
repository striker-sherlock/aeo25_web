 <x-admin>
    {{-- <section id="admin-dashboard"> --}}
    <div class="container">
        <div class="header">
            <h2 class="fw-bold ">Welcome back, {{Auth::guard('admin')->user()->name}} </h2>
            <h5 class="text-muted">{{Auth::guard('admin')->user()->position}} of {{Auth::guard('admin')->user()->department}} </h5>
            <hr>
        </div>
        <div class="info">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-6">
                    <x-card>
                        <h4 class="">Total Participant</h4>
                        <h1 class="display-2 fw-bold">{{$totalParticipants}}</h1>
                        <div class="d-flex justify-content-end px-3 mb-1">
                            <span style="font-size: 0.6em" class="fw-bold">{{$totalParticipants}}/675</span>
                        </div>
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar" style="width:{{$totalParticipants/675}}%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                            </div>
                    </x-card>
                </div>  
                <div class="col-md-4 col-sm-6">
                    @php($targetCountries = 11)
                    <x-card>
                        <h4 class="">Country Participate</h4>
                        <h1 class="display-2 fw-bold">{{$totalCountries}}</h1>
                        <div class="d-flex justify-content-end px-3 mb-1">
                            <span style="font-size: 0.6em" class="fw-bold">{{$totalCountries}}/{{$targetCountries}}</span>
                        </div>
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar" style="width:{{$totalCountries/$targetCountries}}%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                            </div>
                    </x-card>
                </div>
                <div class="col-md-4 col-sm-6 ">
                    <x-card>
                        @php($targetInstitution = 100)
                        <h4 class="">Total Institution</h4>
                        <h1 class="display-2 fw-bold">{{$totalInstitutions}}</h1>
                        <div class="d-flex justify-content-end px-3 mb-1">
                            <span style="font-size: 0.6em" class="fw-bold">{{$totalInstitutions}}/{{$targetInstitution}}</span>
                        </div>
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar" style="width:{{$totalInstitutions/$targetInstitution*100}}%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                            </div>
                    </x-card>
                </div>
            </div>
            <div class="row justify-content-center">
                {{-- <div class="col">
                    <x-card>
                        <h4 class="">Total Revenue</h4>
                        <h1 class="display-2 fw-bold">100.000</h1>
                        <div class="d-flex justify-content-end px-3 mb-1">
                            <span style="font-size: 0.6em" class="fw-bold">100.000/600.000</span>
                        </div>
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar" style="width:50%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                            </div>
                    </x-card>
                </div>   --}}
                <div class="col-md-4 col-sm-6">
                    <x-card>
                        @php($targetNational = 337)
                        <h4 class="fs-5">National Participant</h4>
                        <h1 class="display-2 fw-bold">{{$totalNationalParticipants}}</h1>
                        <div class="d-flex justify-content-end px-3 mb-1">
                            <span style="font-size: 0.6em" class="fw-bold">{{$totalNationalParticipants}}/{{$targetNational}}</span>
                        </div>
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar" style="width:{{$totalNationalParticipants/$targetNational}}%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                            </div>
                    </x-card>
                </div>
                <div class="col-md-4 col-sm-6">
                    <x-card>
                        @php($targetInter = 338)
                        <h4 class="fs-5">International Participant </h4>
                        <h1 class="display-2 fw-bold">{{$totalInternationalParticipants}}</h1>
                        <div class="d-flex justify-content-end px-3 mb-1">
                            <span style="font-size: 0.6em" class="fw-bold">{{$totalInternationalParticipants}}/{{$targetInter}}</span>
                        </div>
                        <div class="progress ">
                            <div class="progress-bar" role="progressbar" style="width:{{$totalInternationalParticipants/$targetInter*100}}%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                            </div>
                    </x-card>
                </div>
            </div>
        </div>
        
        {{-- registration summary --}}
        <x-card>
            <h1 class="mb-3">Registration Summary</h1>
            <table class="table table-striped table-bordered">
                <thead class="text-center">
                    <tr>
                    <th scope="col"> </th>
                    @foreach ($competitions as $competition)
                        <th scope="col">{{$competition->id}}</th>
                    @endforeach
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <th>Remaining Slot (fixed)</th>
                        @foreach ($competitions as $competition)
                            <th> {{$competition->fixed_quota}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>Registered Slot</th>
                        @foreach ($competitions as $competition)
                            <th> {{$registeredSlot[$competition->name]}}</th>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </x-card>
    </div>
    @section('scripts')
    @endsection
</x-admin>
