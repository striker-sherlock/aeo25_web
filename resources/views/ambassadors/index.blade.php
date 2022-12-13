<x-layout title="Ambassadors - The 2023 Asian English Olympics">
    <x-navbar></x-navbar>
    <section id="mainBackground" class="py-5">
        <div class="container text-center wow fadeInUp mt-5">
            <div class="title-line mx-auto"></div>
            <h1 class="fw-bold mt-3 c-text-1 c-text-about home_title text-gradient" style="font-family: 'Roboto' !important;">MEET OUR AMBASSADORS</h1>
            <p class="text-muted mb-0 text-gradient-blue">See what people say about Asian English Olympics</p>
            <div class="wrapper mt-4">
                @foreach ($ambassadors as $ambassador)
                <div class="card card-shadow border-0 rounded-20">
                    <div class="card-body">
                        <p class="text-justify"><span class="fa fa-quote-left left mb-3"></span>
                            {{$ambassador->testimony}}</p>
                    </div>
					<hr>
					<div class="profile">
						<div class="left">
							<img src="/storage/images/ambassador/{{$ambassador->photo}}">
						</div>
						<div class="right">
							<div class="client-info">
								<p class="name mx-1 mb-0">{{$ambassador->name}}</p>
								<p class="institution mx-1 mb-0">{{$ambassador->institution}}</p>
							</div>
						</div>
					</div>
                </div>

                @endforeach
            </div>
        </div>
	</section>
    
    {{-- <div class="row d-flex justify-content-center">
        <div class="col-md-4 style-3">
            <div class="tour-item ">
                <div class="tour-desc bg-white">
                    <div class="tour-text color-grey-3 text-center">&ldquo;At this School, our mission is to balance a rigorous comprehensive college preparatory curriculum with healthy social and emotional development.&rdquo;</div>
                    <div class="d-flex justify-content-center pt-2 pb-2"><img class="tm-people" src="https://images.pexels.com/photos/6625914/pexels-photo-6625914.jpeg" alt=""></div>
                    <div class="link-name d-flex justify-content-center">Balbir Kaur</div>
                    <div class="link-position d-flex justify-content-center">Student</div>
                </div>
            </div>
        </div>
        <div class="col-md-4 style-3">
            <div class="tour-item ">
                <div class="tour-desc bg-white">
                    <div class="tour-text color-grey-3 text-center">&ldquo;At this School, our mission is to balance a rigorous comprehensive college preparatory curriculum with healthy social and emotional development.&rdquo;</div>
                    <div class="d-flex justify-content-center pt-2 pb-2"><img class="tm-people" src="https://images.pexels.com/photos/415829/pexels-photo-415829.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt=""></div>
                    <div class="link-name d-flex justify-content-center">Balbir Kaur</div>
                    <div class="link-position d-flex justify-content-center">Student</div>
                </div>
            </div>
        </div>
        <div class="col-md-4 style-3">
            <div class="tour-item ">
                <div class="tour-desc bg-white">
                    <div class="tour-text color-grey-3 text-center">&ldquo;At this School, our mission is to balance a rigorous comprehensive college preparatory curriculum with healthy social and emotional development.&rdquo;</div>
                    <div class="d-flex justify-content-center pt-2 pb-2"><img class="tm-people" src="https://images.pexels.com/photos/4946604/pexels-photo-4946604.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt=""></div>
                    <div class="link-name d-flex justify-content-center">Balbir Kaur</div>
                    <div class="link-position d-flex justify-content-center">Student</div>
                </div>
            </div>
        </div>
    </div> --}}
    <x-footer></x-footer>
</x-layout>