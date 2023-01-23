<div class="container border border-3" style="margin:auto; ">
        
    <div class=" text-center mx-auto border border-3">
        {!! QrCode::format('svg')->size(300)->generate(route('food-coupons.create',$id)); !!}
        <p class="fw-bold">Please show this qr code to our committee to claim your food !</p>
    </div>
</div>