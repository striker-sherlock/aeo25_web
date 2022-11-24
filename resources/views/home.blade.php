<x-layout>
    <body>
        <x-navbar></x-navbar>
        <!-- ======= Header Section ======= -->
        <section id="hero" class="hero d-flex align-items-center mx-auto">
            <div class="container mt-5">
                <div class="row d-flex justify-content-center text-center text-md-start">
                    <div class=" col-md-6 ">
                        <div class="d-flex justify-content-center justify-content-md-start ">
                            <hr class="w-25">
                        </div>
                            <h3 data-bs-aos="fade-up" class="aeo-title fs-2  mb-3">The 2023 Asian E nglish Olympics</h3>
                            <h1 data-bs-aos="fade-up" class='aeo-theme mb-4'>UNVEIL YOUR SPARK</h1>
                        </div>
                        <div class="col-md-6  border border-1 text-start rounded-20 " style="padding:2em;box-shadow: 0 0 10px 2px white;">
                            <h2 class="fs-3 m-0 mb-2 aeo-title ">Open Registration Until: </h2>
                            <h1 class="m-0 mb-3 fw-bold display-5">13 January 2023 </h1>
                            <div class="count-down mx-auto row text-center text-white fw-bold d-flex">
                                <div class="col bg-dark rounded me-2 p-2"><span id="cd-days" class="fs-1 "></span> <br> Days</div> 
                                <div class="col  bg-dark rounded me-2 p-2"><span id="cd-hours" class="fs-1 "></span> <br>Hours</div> 
                                <div class="col bg-dark rounded me-2 p-2"><span id="cd-minutes" class="fs-1 "></span><br> Minutes</div> 
                                <div class="col bg-dark rounded me-2 p-2"><span id="cd-seconds" class="fs-1 "></span> <br>Seconds</div> 
                                <div data-aos="fade-up" data-aos-delay="600" >
                                    <div class="text-start text-lg-center ">
                                        <a href="{{route('register')}}"
                                            class="btn action scrollto d-inline-flex align-items-center justify-content-center align-self-center text-center text-white text-decoration-none rounded-pill my-3 px-5 py-2 w-100">
                                            <span class="fs-4 aeo-title text-uppercase">Register now</span>
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                </div>
            </div>

        </section>
        <!-- End Header -->

        <main id="main">
            <!-- ======= About Section ======= -->
            <section id="about" class="about">

                <div class="container" data-aos="fade-up">

                    <div class=" d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <hr class="w-25 pink-line">
                            <h3 class="text-light">WHAT IS ASIAN ENGLISH OLYMPICS?</h3>
                            <h2 class="pink">The Asian English Olympics (AEO) is one of Asia's</h2>
                            <h2 class="light-green">most anticipated international English competitions.</h2>
                            <p class='w-100'>
                                This event is conducted by Bina Nusantara English Club (BNEC), an english student
                                organization of BINUS University in Jakarta, Indonesia. We began as a National English
                                Olympics. With the passage of time, we have evolved into an Asian-scaled competition
                                with the purpose of developing the skills of Asian youths. The 2022 AEO drew 608
                                students from 9 nations to compete in 7 competition areas, including Speech, Debate,
                                Newscasting, Storytelling, Spelling Bee, Radio Drama, and Short Story Writing.
                            </p>
                            <div class="text-end text-lg-right">
                                <a href="#" class="btn action d-inline-flex text-white px-4 py-2  rounded-pill">
                                    <span>Read More</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </section>

            <!-- End About Section -->

            <!-- ======= Why Join Section ====== -->
            <div id="why-join">
                <div class="container text-center wow fadeInUp">
                    <div class="title-line mx-auto"></div>
                    <div class="d-flex justify-content-center">
                        <hr class="w-25 pink-line">
                    </div>
                    <h5 class="mt-3 fw-bold text-light">ABOUT ASIAN ENGLISH OLYMPICS</h5>
                    <h1 class="fw-bold mt-3 c-text-1 c-text-about home_title">We are continuously spreading our impact
                        to all youths
                        across
                        Asia
                    </h1>
                    <div class="row justify-content-center mt-5">
                        <div class="col-lg-3">
                            <h1 class="counter c-text-landing fw-bold text-light-gradient">11</h1>
                            <p class="text-light">Years old</p>
                        </div>
                        <div class="col-lg-3">
                            <h1 class="counter c-text-landing fw-bold text-light-gradient">7</h1>
                            <p class="text-light">Competition fields</p>
                        </div>
                        <div class="col-lg-3">
                            <h1 class="counter c-text-landing fw-bold text-light-gradient">13</h1>
                            <p class="text-light">Participating Countries</p>
                        </div>
                        <div class="col-lg-3">
                            <div class="d-flex align-items-center justify-content-center">
                                <h1 class="counter c-text-landing fw-bold text-light-gradient">6000</h1>
                                <h1 class="c-text-landing fw-bold text-light-gradient">+</h1>
                            </div>
                            <p class="text-light">Total Participants</p>
                        </div>
                    </div>
                </div>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#32649E" fill-opacity="1"
                    d="M0,160L60,181.3C120,203,240,245,360,224C480,203,600,117,720,117.3C840,117,960,203,1080,208C1200,213,1320,139,1380,101.3L1440,64L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
                </path>
            </svg>
            <!-- End Why Join Section -->


            <!-- ======= Competition Fields Section ======= -->
            <section class='competition-fields' id='competition-fields'>
                <div class="container text-center my-3">
                    <div class="d-flex justify-content-center">
                        <hr class="w-25 pink-line">
                    </div>
                    <h1 class="mt-3 fw-bold ">COMPETITION FIELDS</h1>
                    <p class=" mt-3 c-text-1  home_title">Please click the logo to see competition fields detail </p>
                    
                    <div class="owl-carousel owl-theme d-flex">
                        @foreach ($competitions as $competition)
                            @if ($competition->name == 'Observer' || $competition->id == 'IA' )@continue @endif
                            <div class="item border border-1 rounded-20">
                                <a>
                                    <img src="storage/competition_logo/{{$competition->logo}}" class="img-fluid" alt="{{$competition->logo}}" loading="lazy">
                                    <h3 class="aeo-title fw-bold">{{$competition->name}}</h3>
                                </a>
                            </div>
                        @endforeach
                    </div>

                     
                </div>
            
            </section>

            <!-- End Competition Fields Section -->

            {{-- <section class="how-to-regist" id="howToRegister">

                <div class="d-flex justify-content-center">
                    <hr class="w-25 pink-line fw-bold">

                </div>
                <h1 class="text-center text-uppercase fw-bold">How To Register?</h1>
                <br>
                <div class="d-flex justify-content-center">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item">
                                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800"
                                    height="400" xmlns="http://www.w3.org/2000/svg" role="img"
                                    aria-label="Placeholder: First slide" preserveAspectRatio="xMidYMid slice"
                                    focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#777"></rect><text x="50%"
                                        y="50%" fill="#555" dy=".3em">First slide</text>
                                </svg>

                            </div>
                            <div class="carousel-item">
                                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800"
                                    height="400" xmlns="http://www.w3.org/2000/svg" role="img"
                                    aria-label="Placeholder: Second slide" preserveAspectRatio="xMidYMid slice"
                                    focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#666"></rect><text x="50%"
                                        y="50%" fill="#444" dy=".3em">Second slide</text>
                                </svg>

                            </div>
                            <div class="carousel-item active">
                                <svg class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" width="800"
                                    height="400" xmlns="http://www.w3.org/2000/svg" role="img"
                                    aria-label="Placeholder: Third slide" preserveAspectRatio="xMidYMid slice"
                                    focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#555"></rect><text x="50%"
                                        y="50%" fill="#333" dy=".3em">Third slide</text>
                                </svg>

                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                </div>

            </section> --}}

             <!-- End How To Register Section -->

             <!-- ======= Ambassador Section ======= -->
          
            <section id="ambassadors" class="bg-white mt-0">
            <div class="ambassadors wow fadeIn">
                <div class="container">
                    <div class="title-line mx-auto"></div>
                    <div class="d-flex justify-content-center">
                        <hr class="w-25 pink-line fw-bold">
    
                    </div>
                    <h5 class="mt-3 fw-bold text-center heading-primary">OUR AMBASSADORS</h5>
                    <h1 class="fw-bold mt-3 c-text-1 c-text-about text-center mb-4 home_title" style="color: #32649E">What they say about AEO</h1>    
                    <div class="slider">
                        {{-- @foreach ($ambassadors as $ambassador)
                        @if ($loop->iteration == 1)
                        <div class="slide active">
                            <div class="left">
                                <img src="/storage/images/ambassador/{{$ambassador->photo}}" class="c-greetings-img">
                            </div> 
                            <div class="right">
                                <p class="text-justify fs-6">"{{$ambassador->testimony}}"</p>
                                <div class="client-info">
                                    <small>
                                        <p class="mb-0 fw-bold">{{ $ambassador->name }},</p>
                                        <p class="text-muted mb-0">{{ $ambassador->institution }}</p>
                                    </small>
                                </div>
                            </div>
                        </div>      
                        @else
                        <div class="slide">
                            <div class="left">
                                <img src="/storage/images/ambassador/{{$ambassador->photo}}" class="c-greetings-img">
                            </div>
                            <div class="right">
                                <p class="text-justify fs-6">"{{$ambassador->testimony}}"</p>
                                <div class="client-info">
                                    <small>
                                        <p class="mb-0 fw-bold">{{ $ambassador->name }},</p>
                                        <p class="text-muted mb-0">{{ $ambassador->institution }}</p>
                                    </small>
                                </div>
                            </div>
                        </div> 
                        @endif
                        @endforeach --}}
                    </div>
                    <div class="bottom d-flex justify-content-center align-items-center">
                        <div class="slider-indicator">
                            {{-- @foreach ($ambassadors as $ambassador)
                            @if ($loop->iteration == 1)
                            <img src="/storage/images/ambassador/{{$ambassador->photo}}" class="active" alt="img" data-id="{{$ambassador->id}}">      
                            @else
                            <img src="/storage/images/ambassador/{{$ambassador->photo}}" alt="img" data-id="{{$ambassador->id}}">    
                            @endif
                            @endforeach
                            @php
                                $allAmbassadors = App\Models\Ambassador::all()->count();
                                $ambassadorCount = $allAmbassadors - count($ambassadors);
                            @endphp
                            @if ($ambassadorCount > 0)
                                <a href="/ambassadors" target="_blank">
                                    <button type="button" class="btn btn-lg opacity-25 rounded-circle">+{{ $ambassadorCount  }}</button>
                                </a>
                            @endif --}}
                        </div>
                    </div>
                </div>
            </div>
            </section>
    
            

             <!-- End Ambassador Section -->
            <!-- ======= F.A.Q Section ======= -->
            <section id="faq" class="faq">

                <div class="container" data-aos="fade-up">

                    <header class="section-header">
                    <div class="d-flex justify-content-center">
                        <hr class="w-25 pink-line">

                    </div>
                        <h2>F.A.Q</h2>
                        <p>Frequently Asked Questions</p>
                    </header>

                    <div class="row">
                        <div class="col-lg-6">
                            <!-- F.A.Q List 1-->
                            <div class="accordion accordion-flush" id="faqlist1">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                                            Non consectetur a erat nam at lectus urna duis?
                                        </button>
                                    </h2>
                                    <div id="faq-content-1" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist1">
                                        <div class="accordion-body">
                                            Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus
                                            laoreet non curabitur gravida. Venenatis lectus magna fringilla urna
                                            porttitor rhoncus dolor purus non.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                                            Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?
                                        </button>
                                    </h2>
                                    <div id="faq-content-2" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist1">
                                        <div class="accordion-body">
                                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id
                                            interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus
                                            scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper
                                            dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi?
                                        </button>
                                    </h2>
                                    <div id="faq-content-3" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist1">
                                        <div class="accordion-body">
                                            Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci.
                                            Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet
                                            nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis
                                            convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio
                                            morbi quis
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6">

                            <!-- F.A.Q List 2-->
                            <div class="accordion accordion-flush" id="faqlist2">

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq2-content-1">
                                            Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?
                                        </button>
                                    </h2>
                                    <div id="faq2-content-1" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist2">
                                        <div class="accordion-body">
                                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id
                                            interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus
                                            scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper
                                            dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq2-content-2">
                                            Tempus quam pellentesque nec nam aliquam sem et tortor consequat?
                                        </button>
                                    </h2>
                                    <div id="faq2-content-2" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist2">
                                        <div class="accordion-body">
                                            Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim
                                            suspendisse in est ante in. Nunc vel risus commodo viverra maecenas
                                            accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis
                                            blandit turpis cursus in
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq2-content-3">
                                            Varius vel pharetra vel turpis nunc eget lorem dolor?
                                        </button>
                                    </h2>
                                    <div id="faq2-content-3" class="accordion-collapse collapse"
                                        data-bs-parent="#faqlist2">
                                        <div class="accordion-body">
                                            Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae
                                            ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est
                                            sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus
                                            vulputate eu scelerisque. Pellentesque diam volutpat commodo sed egestas
                                            egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit
                                            massa enim nec.
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </section><!-- End F.A.Q Section -->
          <!-- ======= Sponsor ======= -->
          @if(count($sponsors) > 0)
          <section id="sponsors" class="bg-white">
              <div class="container text-center pt-5 wow fadeInUp">
                  <div class="title-line mx-auto"></div>
                  <h1 class="fw-bold mt-3 c-text-1 c-text-about home_title text-center heading-primary">Sponsors</h1>
                  <div class="card border-0 card-shadow rounded-20">
                      <div class="card-body my-3">
                          <div class="row justify-content-center align-items-center">
                              @foreach ($sponsors as $sponsor)
                              <div class="col-lg-2 col-md-3 col-4">
                                  <img src="/storage/sponsor/logo/{{ $sponsor->logo }}" class="w-100 py-1" alt="{{ $sponsor->name }}">
                              </div>
                              @endforeach
                          </div>
                      </div>
                  </div>
              </div>
          </section>
          @endif   
          



         <!-- End Sponsor Section -->
            <!-- ======= Medpar ======= -->
            @if (count($mediaPartners) > 0)
                <section id="media-partners" class="bg-white">
                    <div class="container text-center wow fadeInUp">
                        <div class="title-line mx-auto"></div>
                        <h1 class="fw-bold mt-3 c-text-about home_title text-center">Media Partners</h1>
                        <br>
                        <div class="card border-0 card-shadow rounded-20" <div class="card-body my-3">
                            <div class="row justify-content-center align-items-center">
                                @foreach ($mediaPartners as $mediaPartner)
                                    <div class="col-lg-1 col-md-2 col-3">
                                        <img src="/storage/logo/media-partner/{{ $mediaPartner->logo }}"
                                            class="w-100" alt="{{ $mediaPartner->name }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    </div>
                </section>
            @endif

            <!-- End Medpar Section -->
            <!-- ======= Question ======= -->

            <section id="contact-us" class="bg-white">
                <div class="container wow fadeInUp">
                    <div class="title-line mx-auto"></div>
                    <div class="d-flex justify-content-center">
                        <hr class="w-25 pink-line">
                    </div>
                    <h5 class="my-3 fw-bold text-center " style="color: #32649E;">SUBMIT QUESTION</h5>
                    <h1 class="fw-bold mt-3 c-text-1 c-text-about text-center mb-4 home_title heading-primary" >Drop Your Question Here
                    </h1>
                    <div class="card rounded-20 card-shadow border-0">
                        <div class="card-body m-3">
                            <p class="text-muted mb-4">Please fill the form below, then we will answer your question
                                via e-mail.
                            </p>
                            <form method="POST" action="" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row mb-0 mb-sm-3">
                                    <label for="name" class="col-sm-3 col-form-label text-sm-left">
                                        Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input class="form-control " id="name" name="name"
                                            value="{{ old('name') }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0 mb-sm-3">
                                    <label for="country_id" class="col-sm-3 col-form-label text-sm-left">
                                        Country
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <select class="form-select " name="country_id">
                                            <option selected class="d-none">Select your Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                             
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row mb-0 mb-sm-3">
                                    <label for="phone_number" class="col-sm-3 col-form-label text-sm-left">
                                        Phone Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="tel" class="form-control " id="phone_number"
                                            name="phone_number" value="{{ old('phone_number') }}"
                                            placeholder="812-345-678" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0 mb-sm-3">
                                    <label for="email" class="col-sm-3 col-form-label text-sm-left">
                                        {{ _('Email') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input class="form-control " id="email" name="email"
                                            value="{{ old('email') }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0 mb-sm-3">
                                    <label for="question" class="col-sm-3 col-form-label text-sm-left">
                                        {{ _('Question') }}
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control " id="question" name="question" value="{{ old('question') }}" style="height: 100px"
                                            required>{{ old('question') }}</textarea>
                                    </div>
                                </div>
                                <div class="d-grid mt-5">
                                    <button type="submit" class="btn btn-outline-1 rounded-20 btnSubmit"
                                        id="btn-submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </section>


        </main><!-- End #main -->


        <!-- ======= Footer ======= -->
        <x-footer></x-footer>
         


        <!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let owl = $('.owl-carousel');
        owl.owlCarousel({
            loop:true,
            nav:true,
            autoplay:true,
            dots: true,
            lazyLoad: true,
            margin:15,
            center: true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },            
                960:{
                    items:3
                },
           
            }
        });
        owl.on('mousewheel', '.owl-stage', function (e) {
            if (e.deltaY>0) {
                owl.trigger('next.owl');
            } else {
                owl.trigger('prev.owl');
            }
            e.preventDefault();
        });

        let timer = function (date) {
        let timer = Math.round(new Date(date).getTime()/1000) - Math.round(new Date().getTime()/1000);
		let minutes, seconds;
		setInterval(function () {
            if (--timer < 0) {
				timer = 0;
			}
			days = parseInt(timer / 60 / 60 / 24, 10);
			hours = parseInt((timer / 60 / 60) % 24, 10);
			minutes = parseInt((timer / 60) % 60, 10);
			seconds = parseInt(timer % 60, 10);

			days = days < 10 ? "0" + days : days;
			hours = hours < 10 ? "0" + hours : hours;
			minutes = minutes < 10 ? "0" + minutes : minutes;
			seconds = seconds < 10 ? "0" + seconds : seconds;

			document.getElementById('cd-days').innerHTML = days;
			document.getElementById('cd-hours').innerHTML = hours;
			document.getElementById('cd-minutes').innerHTML = minutes;
			document.getElementById('cd-seconds').innerHTML = seconds;
		}, 1000);
	}
 
    //using the function
        const tomorrow = new Date("January 13, 2023 18:00:00")
        timer(tomorrow);
    </script>

</x-layout>
