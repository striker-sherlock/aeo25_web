{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

<x-admin>
    {{-- <section id="admin-dashboard"> --}}
        <div class="container">
            <div class="header">
                <h2 class="fw-bold ">Welcome back, Geren </h2>
                <h5 class="text-muted">Position and Division</h5>
                <hr>
            </div>
            <div class="info">
                <div class="row">
                    <div class="col">
                        <x-card>
                            <h4 class="">Total Participant</h4>
                            <h1 class="display-2 fw-bold">574</h1>
                            <div class="d-flex justify-content-end px-3 mb-1">
                                <span style="font-size: 0.6em" class="fw-bold">574/600</span>
                            </div>
                            <div class="progress ">
                                <div class="progress-bar" role="progressbar" style="width:90%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                              </div>
                        </x-card>
                    </div>  
                    <div class="col">
                        <x-card>
                            <h4 class="">Country Participate</h4>
                            <h1 class="display-2 fw-bold">8</h1>
                            <div class="d-flex justify-content-end px-3 mb-1">
                                <span style="font-size: 0.6em" class="fw-bold">8/11</span>
                            </div>
                            <div class="progress ">
                                <div class="progress-bar" role="progressbar" style="width:80%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                              </div>
                        </x-card>
                    </div>
                    <div class="col">
                        <x-card>
                            <h4 class="">Total Institution</h4>
                            <h1 class="display-2 fw-bold">121</h1>
                            <div class="d-flex justify-content-end px-3 mb-1">
                                <span style="font-size: 0.6em" class="fw-bold">121/200</span>
                            </div>
                            <div class="progress ">
                                <div class="progress-bar" role="progressbar" style="width:56%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                              </div>
                        </x-card>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
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
                    </div>  
                    <div class="col">
                        <x-card>
                            <h4 class="">National Participant</h4>
                            <h1 class="display-2 fw-bold">263</h1>
                            <div class="d-flex justify-content-end px-3 mb-1">
                                <span style="font-size: 0.6em" class="fw-bold">263/200</span>
                            </div>
                            <div class="progress ">
                                <div class="progress-bar" role="progressbar" style="width:100%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                              </div>
                        </x-card>
                    </div>
                    <div class="col">
                        <x-card>
                            <h4 class="">International Participant </h4>
                            <h1 class="display-2 fw-bold">211</h1>
                            <div class="d-flex justify-content-end px-3 mb-1">
                                <span style="font-size: 0.6em" class="fw-bold">211/300</span>
                            </div>
                            <div class="progress ">
                                <div class="progress-bar" role="progressbar" style="width:70%;"   aria-valuemin="0" aria-valuemax="100"> </div>
                              </div>
                        </x-card>
                    </div>
                </div>
            </div>
            
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
                            <th>Remaining Slot</th>
                            @foreach ($competitions as $competition)
                                <th> {{$competition->temp_quota}}</th>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Registered Slot</th>
                            @foreach ($competitions as $competition)
                                <th> {{$competition->fixed_quota -$competition->temp_quota }}</th>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </x-card>

        


        </div>
    {{-- </section> --}}
</x-admin>