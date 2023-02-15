<x-admin>
    <div class="container mt-4">
    
        <a href="{{route('food-coupons.index')}}" class="btn btn-outline-theme rounded-pill mb-4" style="min-width: 200px"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
        <x-card>
            <h3 class="text-uppercase fw-bold  text-gradient mb-4" style="letter-spacing: 0.1em">Unclaimed {{$type}} Food Coupon Day {{$day}}  </h3>
            
            @if ($unclaimed->count())
                <div class="table-responsive py-2">
                    <table class="table table-striped table-bordered" id="dataTables">
                        <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Institution Name</th>
                            <th scope="col">Action</th>
                        </tr>

                        </thead>
                        <tbody class="text-center">
                        @foreach ($unclaimed as $participant)

                            <tr>
                                <th>{{$participant->id}}</th>
                                <td>{{$participant->name}}</td>
                                <td>{{$participant->user->institution_name}}</td>
                                <td>
                                    <a href="{{route('food-coupons.create',[$participant->id,$day])}}" class="w-100 btn btn-outline-theme rounded-pill">Claim </a>
                                </td>
                            </tr>
                            
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else <hr> <p class="text-center"> No Data</p>
            @endif      
        </x-card>

        <x-card>
            <h3 class="text-uppercase fw-bold  text-gradient mb-4" style="letter-spacing: 0.1em">Claimed {{$type}} Food Coupon Day {{$day}}</h3>
            
            @if ($claimed->count())
                <div class="table-responsive py-2">
                    <table class="table table-striped table-bordered dataTables"  >
                        <thead class="text-center">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Institution Name</th>
                            <th scope="col">type</th>
                        </tr>

                        </thead>
                        <tbody class="text-center">
                        @foreach ($claimed as $participant)
                            <tr>
                                <th>{{$participant->id}}</th>
                                <td>{{$participant->name}}</td>
                                <td>{{$participant->user->institution_name}}</td>
                                <td>{{$participant->type}}</td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
              @else <hr> <p class="text-center"> No Data</p>
            @endif      
        </x-card>
    </div>
</x-admin>