<x-admin>
   <div class="container mt-4">
        <x-card>
            <h3 class="text-uppercase fw-bold  text-gradient mb-4" style="letter-spacing: 0.1em">Lunch Food Coupon Summary </h3>
            <a href="{{route('competition-participants.export','ALL')}}" class="btn btn-outline-success mb-4"> <i class="fas fa-file-export" aria-hidden="true"></i> Download Participant</a>

            <div class="table-responsive py-2">
                <table class="table  table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Day</th>
                            <th>Day 1 </th>
                            <th>Day 2 </th>
                            <th>Day 3 </th>
                            <th>Day 4 </th>
                            <th>Day 5 </th>
                            <th>Day 6 </th>
                        </tr>

                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <th>Total Claimed</th>
                            @for ($i = 1; $i <=  6; $i++)
                                @php($foodClaimed = $foods->where('day',$i)->where('type','LUNCH')->count())
                                <th>{{$foodClaimed}}</th>        
                            @endfor
                        </tr>
                        <tr>
                            <th>Total Unclaimed Food</th>
                            @for ($i = 1; $i <=  6; $i++)
                                @php($foodClaimed = $foods->where('day',$i)->where('type','LUNCH')->count())
                                <th>{{$totalParticipants-$foodClaimed}}</th>        
                            @endfor
                        </tr>

                        <tr>
                            <th> Details</th>
                            @for ($i = 1; $i <=  6; $i++)
                                <th>
                                    <a href="{{route('food-coupons.show',[$i,'LUNCH'])}}" class="btn btn-outline-primary rounded-pill w-100">View Details</a>
                                
                                </th>
                            
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-card>
        <x-card>
            <h3 class="text-uppercase fw-bold  text-gradient mb-4" style="letter-spacing: 0.1em">BREAKFAST Food Coupon Summary </h3>
            <div class="table-responsive py-2">
                <table class="table  table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th>Day</th>
                            <th>Day 1 </th>
                            <th>Day 2 </th>
                            <th>Day 3 </th>
                            <th>Day 4 </th>
                            <th>Day 5 </th>
                            <th>Day 6 </th>
                        </tr>

                    </thead>
                    <tbody class="text-center">
                        <tr>
                            <th>Total Claimed</th>
                            @for ($i = 1; $i <=  6; $i++)
                                @php($foodClaimed = $foods->where('day',$i)->where('type','BREAKFAST')->count())
                                <th>{{$foodClaimed}}</th>        
                            @endfor
                        </tr>
                        <tr>
                            <th>Total Unclaimed Food</th>
                            @for ($i = 1; $i <=  6; $i++)
                                @php($foodClaimed = $foods->where('day',$i)->where('type','BREAKFAST')->count())
                                <th>{{$totalParticipants-$foodClaimed}}</th>        
                            @endfor
                        </tr>

                        <tr>
                            <th> Details</th>
                            @for ($i = 1; $i <=  6; $i++)
                                <th>
                                    <a href="{{route('food-coupons.show',[$i,'BREAKFAST'])}}" class="btn btn-outline-primary rounded-pill w-100">View Details</a>
                                
                                </th>
                            
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-card>
   </div>
</x-admin>