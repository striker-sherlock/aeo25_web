<x-user title="Certificate">
     {{-- {{dd($certificate->logo)}} --}}
    <div class="container mt-5">
        <h1 class="text-capitalize fw-bold  text-gradient mb-4" style="letter-spacing: 0.1em">{{$certificate->participant_name}}'s certificate list</h1>
        <hr>
        <x-card>
            <div class="row ">
                <div class="col-md-3 d-flex justify-content-center align-items-center">
                    <img src="/storage/competition_logo/{{$certificate->logo}}" class="img-fluid w-50" alt="{{$certificate->competition_name}} logo" >
                </div>
                <div class="col-md-6">
                    <h3 class="text-uppercase fw-bold aeo-title" style="letter-spacing: 0.1em">Participation Certificate</h3>
                    <h2 class="text-gradient mb-4">{{$certificate->rank->rank_name == 0 ? "Participation" : $certificate->rank->rank_name}}</h2>
                    <a href="{{route('certificates.generate',['participant',Crypt::encrypt($certificate->id)])}}" class="btn btn-outline-theme btn-lg rounded-pill">Download Certificate</a>
                </div>
            </div>
        </x-card>   

        @if ($sideAchievements->count())
            @foreach ($sideAchievements as $item)
                <x-card>
                    <div class="row ">
                        <div class="col-md-3 d-flex justify-content-center align-items-center">
                            <img src="/storage/competition_logo/{{$certificate->logo}}" class="img-fluid w-50" alt="{{$certificate->competition_name}} logo" >
                        </div>
                        <div class="col-md-6">
                            <h3 class="text-uppercase fw-bold aeo-title" style="letter-spacing: 0.1em">Side Achievement Certificate</h3>
                            <h2 class="text-gradient mb-4">{{$item->name}}</h2>
                            <a href="{{route('certificates.generate',['achievement',Crypt::encrypt($certificate->id),Crypt::encrypt($item->id)])}}" class="btn btn-outline-theme rounded-pill">Download Certificate</a>
                        </div>
                    </div>
                </x-card>
            @endforeach
        @else
            
        @endif
    </div>
</x-user>