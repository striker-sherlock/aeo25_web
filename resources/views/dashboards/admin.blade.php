 <x-admin>
    {{-- <section id="admin-dashboard"> --}}
    <div class="container">
        <div class="header">
            <h2 class="fw-bold ">Welcome back, {{Auth::guard('admin')->user()->name}} </h2>
            <h5 class="text-muted text-capitalize">{{Auth::guard('admin')->user()->position}} 
                @if (Auth::guard('admin')->user()->department_id != 'SC')  
                    <span class="text-lowercase">of</span> 
                    {{Auth::guard('admin')->user()->division}} 
                @endif </h5>
            <hr>
        </div>
        @if (Auth::guard('admin')->user()->position != 'Staff'
            && Auth::guard('admin')->user()->department_id != 'CP'
            || Auth::guard('admin')->user()->division_id == 'CP'
        )
            <div class="info">
                <div class="row justify-content-center">
                    <div class="col-md-4 col-sm-6">
                        <x-card>
                            <h4 class="fw-bold text-gradient">Total Participant</h4>
                            <h1 class="display-6 fw-bold">{{$totalParticipants}}</h1>
                            <div class="d-flex justify-content-end px-3 mb-1">
                                <span style="font-size: 0.6em" class="fw-bold">{{$totalParticipants}}/675</span>
                            </div>
                            <div class="progress ">
                                <div class="progress-bar" role="progressbar" style="width:{{$totalParticipants/675*100}}%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                                </div>
                        </x-card>
                    </div>  
                    <div class="col-md-4 col-sm-6">
                        @php($targetCountries = 16)
                        <x-card>
                            <h4 class="fw-bold text-gradient">Country Participate</h4>
                            <h1 class="display-6 fw-bold">{{$totalCountries}}</h1>
                            <div class="d-flex justify-content-end px-3 mb-1">
                                <span style="font-size: 0.6em" class="fw-bold">{{$totalCountries}}/{{$targetCountries}}</span>
                            </div>
                            <div class="progress ">
                                <div class="progress-bar" role="progressbar" style="width:{{$totalCountries/$targetCountries*100}}%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                                </div>
                        </x-card>
                    </div>
                    <div class="col-md-4 col-sm-6 ">
                        <x-card>
                            @php($targetInstitution = 100)
                            <h4 class="fw-bold text-gradient">Total Institution</h4>
                            <h1 class="display-6 fw-bold">{{$totalInstitutions}}</h1>
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
                     
                    <div class="col-md-4 col-sm-6">
                        <x-card>
                            @php($targetNational = 337)
                            <h4 class="fw-bold text-gradient">National Participant</h4>
                            <h1 class="display-6 fw-bold">{{$totalNationalParticipants}}</h1>
                            <div class="d-flex justify-content-end px-3 mb-1">
                                <span style="font-size: 0.6em" class="fw-bold">{{$totalNationalParticipants}}/{{$targetNational}}</span>
                            </div>
                            <div class="progress ">
                                <div class="progress-bar" role="progressbar" style="width:{{$totalNationalParticipants/$targetNational*100}}%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                                </div>
                        </x-card>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <x-card>
                            @php($targetInter = 338)
                            <h4 class="fw-bold text-gradient">International Participant </h4>
                            <h1 class="display-6 fw-bold">{{$totalInternationalParticipants}}</h1>
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
            <hr>
        @endif
        @if ( (Auth::guard('admin')->user()->position != 'Staff'
            && Auth::guard('admin')->user()->department_id != 'CP')
            ||  Auth::guard('admin')->user()->division_id == 'CP'
        )
        <h1 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">Revenue</h1>
            <div class="row revenue">
                <div class="col-md-4 col-sm-6">
                    <x-card>
                        <h4 class="fs-3 text-gradient fw-bold">Competition</h4>
                        <h2 class="fw-bold fs-3">IDR {{number_format($competitionRevenue)}}</h2>
                        
                     
                         
                    </x-card>
                </div>
                <div class="col-md-4 col-sm-6">
                    <x-card>
                        <h4 class="fs-3 text-gradient fw-bold">Accommodation</h4>
                        <h2 class="fw-bold fs-3">IDR {{number_format($accommodationRevenue)}}</h2>
                    </x-card>
                </div>
                <div class="col-md-4 col-sm-6">
                    <x-card>
                        <h4 class="fs-3 text-gradient fw-bold ">Merchandise</h4>
                        <h2 class="fw-bold fs-3">IDR {{number_format($merchandiseRevenue)}}</h2>
                   
                    </x-card>
                </div>
            </div>
        @endif
        
        
        {{-- registration summary --}}
        <x-card>
            <h3 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">Registration summary</h3>
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
                        <th>Initial Slot</th>
                        @foreach ($competitions as $competition)
                            <th> {{$competition->fixed_quota + $registeredSlot[$competition->name]}}</th>
                        @endforeach
                    </tr>
                    
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
