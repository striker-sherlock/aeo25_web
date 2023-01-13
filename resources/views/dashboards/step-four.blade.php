<x-user title="step four">
    <div class="container mt-5">
        <h1 class="aeo-title">Step 4</h1>
        <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Competition
            Participant Submission</h3>
        <x-card>
            <h3 class="text-uppercase fw-bold   text-gradient mb-4" style="letter-spacing: 0.1em">Participant Submission
            </h3>
            <hr>
            <div class="title-line"></div>
            <div class="row  my-3">
                @foreach ($competitionSlots as $slot)
                    @if ($slot->competition_id == 'RD' || $slot->competition_id == 'SSW')
                        <div class="col-12 col-md-6 col-lg-4 col-xxl-4 my-3 justify-content-center ">
                            <div class="card border-2 ">
                                <div class="top-1 text-center">
                                    <img src="/storage/competition_logo/{{ $slot->competition->logo }}"
                                        class="img-fluid w-50" alt="{{ $slot->competition->name }} logo">
                                </div>
                                <div class="card-body text-center">
                                    <h4 class="card-title fw-bold">{{ $slot->competition->name }}</h4>
                                    <p class="text-center">Submission Opens at: <br> <span
                                            class="c-text-1 fw-bold">{{ date('M j, Y g:i A', strtotime($env->start_time)) }}
                                            GMT+7</span></p>
                                    <p class="text-center">Submission Closes at: <br> <span
                                            class="text-danger fw-bold">{{ date('M j, Y g:i A', strtotime($env->end_time)) }}
                                            GMT+7</span></p>
                                    @if ($slot->is_confirmed == 1)
                                        @if (time() <= strtotime($env->end_time) && time()  > strtotime($env->start_time))
                                            <a href="{{ route('competition-submissions.create', $slot->id) }}"
                                                class="btn btn-outline-1  my-3 px-3 dashboard_3_compete_button"><i
                                                    class="fas fa-copy me-2"></i>Add Submissions</a>
                                        @else
                                            <button type="button"
                                                class="btn btn-sm btn-primary my-3 px-3 text-uppercase dashboard_3_compete_button"
                                                style="cursor: not-allowed !important;"
                                                title="Submission time is not started yet"><i
                                                    class="fas fa-clock me-2"></i> Submission
                                                closed</button>
                                        @endif
                                    @else
                                        <button type="button"
                                            class="btn btn-sm btn-danger my-3 px-3 dashboard_3_compete_button"
                                            style="cursor: not-allowed !important;"><i class="fas fa-times me-2"></i>Not
                                            Eligible</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach


            </div>


        </x-card>

        <h5 class="text-center fs-4 fw-bold">Step Navigation</h5>
        <div class="navigasi  mb-4 d-flex justify-content-center align-items-center py-1">
            <ul class="list-unstyled d-flex align-items-center">
                <li> <a href="{{ route('dashboard') }}" class=" btn btn-outline-purple me-2">Main Dashboard </a></li>
                <li> <a href="{{ route('dashboard.step', 1) }}" class=" btn btn-outline-primary me-2">1</a></li>
                <li> <a href="{{ route('dashboard.step', 2) }}" class="btn btn-outline-primary me-2">2</a></li>
                <li> <a href="{{ route('dashboard.step', 3) }}" class="btn btn-outline-primary me-2">3</a></li>
                <li> <a href="#" class="btn btn-outline-primary me-2 active">4</a></li>
            </ul>
        </div>

    </div>
</x-user>
