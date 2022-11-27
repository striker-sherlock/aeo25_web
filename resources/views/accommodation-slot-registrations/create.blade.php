<x-user title="Create Accommodation Slot">
    <div class="container mt-5">
      <h1 class="aeo-title">Step 1</h1>
      <h3 class="text-uppercase fw-bold display-6 text-gradient mb-4" style="letter-spacing: 0.1em">Select Your Room Type</h3>
      <div class="row mb-4">
        @foreach ($accommodations as $accommodation)
          <div class="col">
            <a href="{{route('accommodation-slot-registrations.create',$accommodation->id)}}" class="btn btn-outline-theme w-100 rounded-pill {{$selectedType->id == $accommodation->id ? 'active':''}}">{{$accommodation->room_type}}</a>
          </div>
        @endforeach
      </div>
      @if ($selectedType)
        <div class="row  justify-content-center">
          <div class="col-md-12">
            <x-card>
              <h3 class="text-uppercase text-center fw-bold" style="letter-spacing: 0.1em">Accommodation Slot Registration</h3>
              <form action="{{route('accommodation-slot-registrations.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="accommodation_id" value="{{$selectedType->id}}" hidden>
                <div class="row align-items-center justify-content-center">
                  <div class="col-md mb-4">
                    <img src="/storage/images/accommodations/{{$selectedType->picture}}" alt="{{$selectedType->room_type}}" class="img-fluid mx-auto d-block w-100" >
                  </div>
                  <div class="col">
                    <div class="form-group mb-3">
                      <label for="check_in_date" class="col-form-label">Check In Date <span class="text-danger">*</span></label>
                      <input type="datetime-local" class="form-control" id="check_in_date" placeholder="Enter Check In Date" name="check_in_date" required value="{{old('check_in_date')}}">
                    </div>
          
                    <div class="form-group mb-3">
                      <label for="check_out_date" class="col-form-label">Check Out Date <span class="text-danger">*</span></label>
                      <input type="datetime-local" class="form-control" id="check_out_date" placeholder="Enter Check Out Date" name="check_out_date" required value="{{old('check_out_date')}}">
                    </div>
                    <div class="form-group mb-3">
                      <label class="col-form-label" for="special_req">Special Request</label>
                      <textarea class="form-control" name="special_req" id="special_req" rows="2">{{old('special_req')}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                      <label class="col-form-label" for="quantity">Number of Room <span class="text-danger">*</span></label>
                      <input type="number" class="form-control" name="quantity" id="max_guests" min="1"  value="{{old('quantity')!= NULL ? old("quantity"): '1'}}">
                      {{-- {{dd(old('quantity'))}} --}}
                    </div>

                    <div class="row">
                      <div class="col">
                        <button type="button" class="btn btn-outline-primary w-100 rounded mb-4 rounded-pill {{ ($selectedType->facilities->count() > 0) ? '' : 'disabled' }}" data-bs-target="#viewFacility-{{ $selectedType->id }}" data-bs-toggle="modal" title="View Facilities">View Facilities</button>
                      </div>
                      <div class="col">
                        <button id="confirm" type="button" data-bs-toggle ="modal" data-bs-target="#confirmation "class="btn btn-outline-primary w-100 rounded mb-4 rounded-pill">Submit</button>
                      </div>
                    </div>
                      {{-- confirmation modal --}}
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
                                  <h1 class="fs-3 text-center" > Are you sure want to book <span id="quantity" class="fw-bold"></span><span class="fw-bold text-uppercase"> {{$selectedType->room_type}}</span>  room(s) ?</h1>
                              </div>
                              <div class="footer">
                                  <div class="row">
                                      <div class="col">
                                          <button type="button" class="btn btn-outline-secondary w-100"  data-bs-dismiss="modal">Back</button>
                                      </div>
                                      <div class="col">
                                        <button type="submit" class="btn btn-outline-theme w-100">Book Now</button>
                                      </div>
                                  </div>  
                              </div>
                          </div>
                      </div>  
                  </div> 

                  {{-- View Facility Modal --}}
                  <div class="modal fade" id="viewFacility-{{$selectedType->id}}" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-20 border-0 shadow">
                            <div class="modal-header border-bottom-0">
                              <button type="button" class="btn-close" data-bs-dismiss="modal"
                                  aria-label="Close">
                              </button>
                            </div>
                            <div class="modal-body">
                              <h4 class="text-muted text-center">{{ $selectedType->room_type }} - Room Facility</h4>
                              <hr>
                              <div class="table-responsive">
                                <table class="table table-hover">
                                  <thead class="bg-light">
                                    <th class="align-middle text-center">#</th>
                                    <th class="align-middle text-center">Facility</th>
                                    <th class="align-middle text-center">Availability</th>
                                  </thead>
                                  <tbody>
                                    @foreach ($selectedType->facilities->sortByDesc('is_available') as $accommFacility)
                                      <tr class="align-middle text-center">
                                        <td>
                                          {{ $loop->iteration }}
                                        </td>
                                        <td>
                                          {{ $accommFacility->facility->name }}
                                        </td>
                                        <td>
                                          <span class="{{ ($accommFacility->is_available) ? 'text-success' : 'text-danger' }}">
                                            {{ ($accommFacility->is_available) ? 'Available' : 'Not Available' }}
                                          </span>
                                        </td>
                                      </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                              </div>
                            </div>
                            <div class="text-center">
                                <button type="button"
                                    class="btn btn-success rounded-pill rounded-20 mb-4 px-4"
                                    data-bs-dismiss="modal">
                                    OK, I got it
                                </button>
                            </div>
                        </div>
                    </div>  
                  </div>  
              </form>
            </x-card>
          </div>
        </div>
      @endif
      <x-card>
        <h3 class="text-uppercase text-center fw-bold mb-3  " style="letter-spacing: 0.1em">Public Facilities</h3>
        <div class="row">
          <div class="col-md">
            <ul class="list-group">
              <li class="list-group-item">Court Yard</li>
              <li class="list-group-item">Mini Market 24H</li>
              <li class="list-group-item">Copy Center</li>
              <li class="list-group-item">Coffee Shop</li>
            </ul>
          </div>
          <div class="col-md">
            <ul class="list-group shadow-sm">
              <li class="list-group-item">Swimming Pool</li>
              <li class="list-group-item">Gym Center</li>
              <li class="list-group-item">Jogging Track </li>
              <li class="list-group-item">Lounge</li>
            </ul>
          </div>
        </div>
      </x-card>
  </div>

  <script>
    const quantity = document.querySelector('input[type="number"]')
    const button = document.querySelector('#confirm')
    button.addEventListener('click',function(){
      document.querySelector('#quantity').innerHTML = `${quantity.value}`
    })
    // const link = document.querySelectorAll('a')
    // link.addEventListener('click',function(e){
    //   e.preventDefault()
    // })
    
  </script>
  
  
    
</x-user>