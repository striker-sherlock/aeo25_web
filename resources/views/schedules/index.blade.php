

<x-user title="Schedules">
      <div class="container mt-5 py-4 px-5">
        <x-card>
            <h1 class="c-text-1 fw-bold text-gradient">Main Event Schedules</h1>
            <hr>
            <div class="d-inline-block justify-content-center mb-3 px-4">
              <a href="#" class="btn btn-outline-light-blue  p-3 px-3 mb-3 me-2 bg-light-blue">
                <img src="/storage/assets/AEO 2023Colored No Text.png" alt="" width="75" class="me-1"> Main Event
              </a>
              @foreach ($registeredSlots as $slot)
                <a href="{{ route('schedules.show', $slot->competition->id) }}" class="btn btn-outline-light-blue rounded-50 p-2 px-3 mb-3 me-2">
                  <img src="/storage/competition_logo/{{ $slot->competition->logo }}" alt="" width="50" class="me-1"> {{ $slot->competition->name }}
                </a>
              @endforeach
            </div>
            <div class="row justify-content-start align-items-center px-3">
              @foreach ($events as $event)
                <div class="col-md-6 shadow-sm mb-3 rounded-20 border pe-4">
                  <div class="card card-shadow-md border-0 rounded-10 ">
                    <div class="card-body mt-3">
                      <div class="d-flex align-items-center flex-row justify-content-between ">
                        <h5 class="fw-bold ps-2" style="border-left: 4px solid #275DA3">{{ $event->event_name }}</h5>
                      </div>
                      {{-- <div class="d-flex flex-row justify-content-between align-items-center mb-2">
                        <span class="me-2">
                          <i class="fas fa-map-marker-alt"></i>
                          <span>Zoom Meetings</span>
                        </span>
                        @php
                          $startTime = (new Carbon\Carbon($event->start_time))->subMinutes(30)->format('Y-m-d H:i:s');
                          $endTime = (new Carbon\Carbon($event->end_time))->format('Y-m-d H:i:s');
                        @endphp
                        @if ($startTime <= Carbon\Carbon::now() && Carbon\Carbon::now() <= $endTime)
                          <a href="{{ $event->link_zoom }}" class="text-reset text-decoration-none text-center" target="_blank">
                            <div class="px-2 py-1 link-zoom"><i class="fas fa-video me-2 text-danger"></i><span class="fw-bold">LIVE NOW</span></div>
                          </a>
                        @endif
                      </div> --}}
                      <div class="d-flex align-items-center mb-2">
                        <span class="me-2">
                          <i class="fas fa-calendar-day"></i>
                        </span>
                        <span>{{ date('M j, Y', strtotime($event->start_time)) }}</span>
                      </div>
                      <div class="row align-items-center">
                        <div class="col-lg-4 col-md-4 col-4">
                          <p class="text-muted mb-0 pb-0">Start Time</p>
                          <p class="fw-bold mb-1 pb-0">{{ date('H:i', strtotime($event->start_time)) }}</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-2">
                          <i class="fas fa-chevron-circle-right"></i>
                        </div>
                        <div class="col-lg-5 col-md-5 col-5">
                          <p class="text-muted mb-0 pb-0">End Time</p>
                          <p class="fw-bold mb-1 pb-0">{{ date('H:i', strtotime($event->end_time)) }} GMT+7</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </x-card>
    </div>
  </x-user>