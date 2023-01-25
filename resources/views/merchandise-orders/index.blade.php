<x-layout>
    
    <x-navbar></x-navbar>
 
    <div class="container mt-5 mb-5 ">
        <h3 class="text-uppercase fw-bold  text-gradient mb-4" style="letter-spacing: 0.1em">Our Merchandise </h3>
        <div class="chat position-fixed px-4 py-2  " >
            <a href="https://api.whatsapp.com/send?phone=628113093815"
                            class="text-reset text-decoration-none" target="_blank"><i
                                class="fab fa-whatsapp me-2 fa-lg"></i>Chat Us</a>
        </div>
        

        <form action="{{route('merchandise-orders.temp-store')}}" enctype="multipart/form-data" method="POST">
            @csrf
            @foreach ($merchandises->where('type','bundle') as $merchandise)
                <div class="col-md-6 mb-3  ">
                    <div class="d-flex justify-content-between mb-5 custom-card">
                        <div class="owl-carousel owl-theme  w-50 me-2" data-image = "{{$merchandise->image}}" >
                            @foreach (explode('; ',$merchandise->image) as $image  )
                                <div class="item mx-auto rounded-20 " style="width:100%;">
                                    <a>
                                        <div class="d-flex justify-content-center p-2" style="box-sizing: border-box">
                                            <img src="storage/merchandise/merchandise_photo/{{ $image }}"
                                                class="img-fluid  w-100" alt="{{ $merchandise->name }}'s image" loading="lazy"
                                                width="50" >
                                        </div>
                                        
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4 w-50 ">
                            <h4 class="card-title aeo-title text-capitalize fw-bold mb-2">{{$merchandise->name}}</h4>
                            <p class="card-text">{{ $merchandise->product_description }}</p>
                            <h5 class="mb-2 fw-bold "> Set quantity and notes</h5>
                            {{-- set quantity  --}}
                        
                            <div class="form-input border w-50 d-flex justify-content-between rounded-20 px-2 ">
                                <button type="button"  class="border-0  btnDecrement">-</button>
                                <input type="text"   class="input-spinner counter" step="1"
                                    name="quantity[]-{{$merchandise->id}}" value="0" min="0"
                                    max="10" style="text-align: center; border: 0; background:
                                    transparent; padding: 0; max-width: 3rem" readonly/>
                                <button type="button" class="border-0  btnIncrement">+</button>
                            </div>
                            <div class="form-group mb-3 mt-2 d-none">
                                <label for="name " class="col-form-label ">Notes <small class="text-muted">(e.g color, size)</small></label>
                                <textarea type="text" class="form-control "  name="notes[]-{{$merchandise->id}}"  > </textarea>
                            </div>

                            <div class="fw-bold text-primary add_notes mt-3" style="cursor: pointer"><i class="fa fa-edit"></i> Add Notes</div>
                        </div>
                    </div>
                </div>
            @endforeach

            
            <div class="row merchandise-card">
                @foreach ($merchandises->where('type','piece') as $merchandise)
                    <input type="text" hidden name="merch_id[]" value="{{$merchandise->id}}">
                    <div class="col-md-6 mb-3  ">
                        <div class="d-flex justify-content-between mb-3 custom-card">
                            <div class=" owl-carousel owl-theme  w-50 me-2" data-image = "{{$merchandise->image}}" >
                                @foreach (explode('; ',$merchandise->image) as $image  )
                                    <div class="item mx-auto rounded-20 ">
                                        <a>
                                            <div class="d-flex justify-content-center p-2 " >
                                                <img src="storage/merchandise/merchandise_photo/{{ $image }}"
                                                    class="img-fluid mb-5 rounded-20" alt="{{ $merchandise->name }}'s image"   >
                                            </div>
                                            
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-4 w-50 ">
                                <h4 class="card-title aeo-title text-capitalize fw-bold mb-2">{{$merchandise->name}}</h4>
                                <p class="card-text">
                                    {!! nl2br(e($merchandise->product_description)) !!}
                                </p>
                                <h5 class="mb-2 fw-bold "> Set quantity and notes</h5>
                                {{-- set quantity  --}}
                            
                                <div class="form-input border w-50 d-flex justify-content-between rounded-20 px-2 ">
                                    <button type="button"  class="border-0  btnDecrement">-</button>
                                    <input type="text"   class="input-spinner counter" step="1"
                                        name="quantity[]-{{$merchandise->id}}" value="0" min="0"
                                        max="10" style="text-align: center; border: 0; background:
                                        transparent; padding: 0; max-width: 3rem"  data-name="{{$merchandise->name}}" data-price="{{$merchandise->price}}" readonly/>
                                    <button type="button" class="border-0  btnIncrement">+</button>
                                </div>
                                <div class="form-group mb-3 mt-2 d-none">
                                    <label for="name " class="col-form-label ">Notes <small class="text-muted">(e.g color, size)</small></label>
                                    <textarea type="text" class="form-control "  name="notes[]-{{$merchandise->id}}"  > </textarea>
                                </div>
                                <div class="fw-bold text-primary add_notes mt-3" style="cursor: pointer"><i class="fa fa-edit"></i> Add Notes</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" id="submit" class="btn btn-outline-theme w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#merch-summary">Check Out Now  </button>

            <div class="modal fade p-5" id="merch-summary" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                aria-labelledby="modal-title" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                <div class="modal-content rounded-20 border-0 shadow p-5">
                    <div class="modal-headers mb-4">
                        <span class="fa-stack fa-4x d-block mx-auto">
                            <i class="fas fa-circle fa-stack-2x text-danger"></i>
                            <i class="fas fa-exclamation fa-stack-1x fa-inverse"></i>
                        </span>
                        </div>
                        <div class="body mb-3">
                            <h1 class="fw-bold fs-4 text-center aeo-title">Merchandise Confirmation</h1>
                            <h6 class="fs-6">Merchandise Summary: </h6>
                            <ul class="unstyled-list">
                            </ul>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="close btn rounded-pill btn-outline-secondary w-100" data-bs-dismiss="modal">Back</button>
                                </div>
                                <div class="col">
                                    <button type="submit" class="rounded-pill btn btn-outline-theme w-100">Confirm Orders</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

      
    </div>
    {{-- <x-footer></x-footer> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script> 
        let owl = $('.owl-carousel');
        $(document).ready(function(){
            owl.owlCarousel({
                autoHeight:true,
                loop: true,
                nav: true,
                autoplay: true,
                dots: true,
                lazyLoad: true,
                margin: 15,
                center: true,
                items:1,
             
            });

            let merch= document.querySelectorAll('.owl-carousel');
            merch.forEach( (el,index) => {
                let button = el.children[2].children;
                // console.log(button)
                let images =  el.dataset.image.split("; "); 
                let len = button.length;
                for (let i = 0 ;  i < len; i++){
                    button[i].innerHTML =  
                    `<img src="storage/merchandise/merchandise_photo/${images[i]}"
                        class="img-fluid img-responsive"  alt="" loading= "lazy">`
                }
            });

            $('.add_notes').click(function(){
                $(this).siblings('.form-group').toggleClass('d-none');
                $(this).toggleClass('text-primary');
                $(this).toggleClass('text-danger');
                if($(this).siblings('.form-group').hasClass('d-none')){
                    $(this).empty();
                    $(this).append(`<i class="fa fa-edit"></i> Add Notes`);
                }
                else{
                    $(this).empty();
                    $(this).append(`  Cancel Notes`);
                }
            })

            let currentCount = 0;
            var maxSlot = 10

            $(".btnIncrement").click(function(){
                currentCount = parseInt($(this).siblings(".counter").val());
                
                if (currentCount >= maxSlot) {
                    $(this).prop("disabled", true);
                }else {
                    $(this).prop("disabled", false);
                    $(this).siblings('.counter').val(currentCount + 1)
                }
                if(currentCount == 0 ) $(this).siblings('.btnDecrement').prop("disabled", false);
            })
            
            $(".btnDecrement").click(function() {
                currentCount = parseInt($(this).siblings(".counter").val());
                
                if (currentCount <= 0) {
                    $(this).prop("disabled", true);
                }else {
                    $(this).prop("disabled", false);
                    $(this).siblings(".counter").val(currentCount - 1)
                }
                if(currentCount == maxSlot ) $(this).siblings('.btnIncrement').prop("disabled", false);
            })
            
            $('#submit').click(function(){
                const input = document.querySelectorAll('input.counter');
                input.forEach(el => {
                    if(el.value != 0){
                        let price =  new Intl.NumberFormat().format(el.value * el.dataset.price);
                        $('ul.unstyled-list').append(`<li class="fw-bold">${el.dataset.name} : ${el.value} unit  ( IDR ${price} ) </li>`)
                    }
                });
            })

            $('button.close').click(function(){
                $('ul li').remove()
            })

        })
    </script>

 
</x-layout>