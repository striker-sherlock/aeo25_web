<x-layout>
    <style>
        body{
            background-color:#3F3B74;
        }
    </style>
    <div class="container m-auto mt-3 mb-3  rounded-20 overflow-hidden" style="background-color:#eee; ">
        
        <div class="header m-0 p-0">
            <h3 class="text-capitalize aeo-title display-4 fw-bold text-center">Claim your food</h3> <hr>
        </div>

        <div class=" text-center mx-auto  py-2">
            {!! QrCode::format('svg')->size(300)->generate(route('food-coupons.create',$id)); !!}
            <p class="fw-bold">Please show this qr code to our committee to claim your food !</p>
        </div>
    </div>
</x-layout>