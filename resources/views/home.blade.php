<x-layout>
    <style>
        span.position-absolute{
            top:-10px;
            right:-20px;
            width:20px;
            height:20px;
            cursor: pointer; 
            font-size: 15px ;
            transition: 0.5s;
            padding: 10px;
            color: #80679E;
            border:2px solid  #F175AD !important;
        }
        span.position-absolute:hover{
            background-color: #F175AD;
            color:white;
        }
    </style>
    <body>
        <x-navbar></x-navbar>

        <!-- ======= Header Section ======= -->
        <section id="hero" class="hero d-flex align-items-center mx-auto">
            <div class="container mt-5">
                <div class="row d-flex justify-content-center text-center text-md-start">
                    <div class=" col-md-6 px-3">
                        <div class="d-flex justify-content-center justify-content-md-start ">
                            <div class=" custom-border rounded  my-2"></div>
                        </div>
                        <h3 data-bs-aos="fade-up" class="aeo-title fs-2 mb-3">The 2023 Asian English Olympics</h3>
                        <h1 data-bs-aos="fade-up" class='aeo-theme  mb-4 display-5' style="letter-spacing:0.1em;">UNVEIL YOUR SPARK</h1>
                    </div>
                        <div class="col-11 col-md-6 text-start rounded-20 " style="padding:2em;box-shadow: 0 0 10px 2px #7fbcd2;">
                            <h2 class="fs-3 m-0 mb-2 aeo-theme ">Open Registration Until: </h2>
                            <h4 class="m-0 mb-3 fw-bold display-6 aeo-title">13 January 2023 </h4>
                            <div class="count-down mx-auto row text-center text-white fw-bold d-flex">
                                <div class="col bg-dark rounded me-2 p-2"><span id="cd-days" class="fs-1 "></span> <br> Days</div> 
                                <div class="col  bg-dark rounded me-2 p-2"><span id="cd-hours" class="fs-1 "></span> <br>Hours</div> 
                                <div class="col bg-dark rounded me-2 p-2"><span id="cd-minutes" class="fs-1 "></span><br> Minutes</div> 
                                <div class="col bg-dark rounded me-2 p-2"><span id="cd-seconds" class="fs-1 "></span> <br>Seconds</div> 
                                <div data-aos="fade-up" data-aos-delay="600" >
                                    <div class="text-start text-lg-center ">
                                        <a href="{{route('register')}}"
                                            class="btn action scrollto d-inline-flex align-items-center justify-content-center align-self-center text-center text-white text-decoration-none rounded-pill my-3 px-5 py-2 w-100">
                                            <span class="fs-4 text-uppercase">Register now</span>
                                            <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
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
            <section id="about" class="about d-flex align-items-center"  >

                <div class="container" data-aos="fade-up" >

                    <div class=" d-flex align-items-center flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <div class="d-flex justify-content-center justify-content-md-start ">
                                <div class=" custom-border rounded  my-2"></div>
                            </div>
                            <h2 class="text-light pink fs-4" >WHAT IS ASIAN ENGLISH OLYMPICS?</h2>
                            <h2 class="aeo-title ">The Asian English Olympics (AEO) is one of Asia's most anticipated international English competitions.</h2>
                             
                            <p class='w-100 fs-5' style="line-height:1.5em !important;">
                                This event is conducted by Bina Nusantara English Club (BNEC), an english student
                                organization of BINUS University in Jakarta, Indonesia. We began as a National English
                                Olympics. With the passage of time, we have evolved into an Asian-scaled competition
                                with the purpose of developing the skills of Asian youths. The 2022 AEO drew 608
                                students from 9 nations to compete in 7 competition areas, including Speech, Debate,
                                Newscasting, Storytelling, Spelling Bee, Radio Drama, and Short Story Writing.
                            </p>
                            <div class="text-end text-lg-right">
                                <a href="about-us" class="btn action d-inline-flex text-white px-4 py-2  rounded-pill">
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
                        <div class="custom-border rounded  my-2"></div>
                    </div>
                    <h5 class="mt-3 fw-bold text-light fs-4 ">ABOUT ASIAN ENGLISH OLYMPICS</h5>
                    <h2 class="fw-bold mt-3 display-5" style="color:#ff99c7; font-family:lexend;">We are continuously spreading our impact
                        to all youths
                        across
                        Asia
                    </h2>
                    <div class="counters row justify-content-center mt-5">
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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" >
                <path fill="#32649E" fill-opacity="1"
                    d="M0,160L60,181.3C120,203,240,245,360,224C480,203,600,117,720,117.3C840,117,960,203,1080,208C1200,213,1320,139,1380,101.3L1440,64L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z" >
                </path>
            </svg>
            <!-- End Why Join Section -->


            <!-- ======= Competition Fields Section ======= -->
            <section class='competition-fields' id='competition-fields'>
                <div class="container text-center my-3">
                    <div class="d-flex justify-content-center">
                        <div class="custom-border rounded my-2"></div>
                    </div>
                    <h1 class="mt-3 fw-bold position-relative d-inline-block  ">COMPETITION FIELDS 

                        <span class="d-flex justify-content-center align-items-center fs-6 position-absolute rounded-circle  fw-bold" title="see details" data-bs-toggle="modal" data-bs-target="#general-detail">!</span>
                    </h1>
                    <p class=" mt-3 c-text-1  home_title">Please click the logo to see competition fields detail </p>

                    <div class="owl-carousel owl-theme d-flex mx-auto   " >
                        @foreach ($competitions as $competition)
                            @if ($competition->id == 'OBS' || $competition->id == 'IA')
                                @continue
                            @endif
                            <div class="item border border-1 mx-auto rounded-20 shadow-sm" style="width:90%;">
                                <a>
                                    <div class="d-flex justify-content-center">
                                        <img src="storage/competition_logo/{{ $competition->logo }}"
                                            class="img-fluid w-50" alt="{{ $competition->logo }}" loading="lazy"
                                            width="50" data-bs-toggle="modal"
                                            data-bs-target="#competition{{ $competition->id }}">
                                    </div>
                                    <h3 class="aeo-title fw-bold text-center">{{ $competition->name }}</h3>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            @foreach ($competitions as $competition)
                <div class="modal fade" id="competition{{ $competition->id }}" tabindex="-1"
                    aria-labelledby="competition" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content rounded-20 border-0">
                            <div class="modal-header border-bottom-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-11  ">
                                        <div class="custom-divider mx-auto"></div>
                                        <h5 class="fw-bold aeo-title" style="letter-spacing: 0.1em">Competition Field
                                        </h5>
                                        <h3 class="text-uppercase fw-bold text-gradient display-6"
                                            style="letter-spacing: 0.1em">{{ $competition->name }}'s Field</h3>
                                        <h4 class="fw-bold">Price : IDR {{ $competition->price }} /
                                            {{ $competition->need_team ? 'team(s)' : 'person(s)' }}</h4>
                                        {{-- {!! $competition->content !!} --}}
                                        <hr>
                                        <h5 class="">{!!$competition->content!!}</h5>
                                        <div class="modal-footers text-center">
                                            <button type="button"
                                                class="btn btn-outline-theme rounded-pill rounded-20 mb-4 px-4"
                                                data-bs-dismiss="modal">
                                                OK, I got it
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- End Competition Fields Section -->

            <section class="how-to-regist" id="howToRegister">
                <div class="container">
                    <div class="d-flex justify-content-center">
                        <div class="custom-border rounded  my-2"></div>
                     </div>
                     <h1 class="mt-3 fw-bold text-center mb-4"> STEP BY STEP REGISTRATION</h1>
                    <img src="/storage/assets/step-regist.webp" loading="lazy" class="img-fluid rounded-20 shadow-sm" alt="step-by-step">

                </div>
            </section>

            <!-- End How To Register Section -->

            <!-- ======= Ambassador Section ======= -->

            {{-- @if ($ambassadors->count() != 0)
                <section id="ambassadors" class="bg-white mt-0">
                    <div class="ambassadors wow fadeIn">
                        <div class="container">
                            <div class="title-line mx-auto"></div>
                            <div class="d-flex justify-content-center">
                                <hr class="w-25 pink-line fw-bold">

                            </div>
                            <h5 class="mt-3 fw-bold text-center heading-primary">OUR AMBASSADORS</h5>
                            <h1 class="fw-bold mt-3 c-text-1 c-text-about text-center mb-4 home_title"
                                style="color: #32649E">What they say about AEO</h1>
                            <div class="slider">
                                @foreach ($ambassadors as $ambassador)
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
                            @endforeach
                            </div>
                            <div class="bottom d-flex justify-content-center align-items-center">
                                <div class="slider-indicator">
                                    @foreach ($ambassadors as $ambassador)
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
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
            @endif --}}

            <!-- End Ambassador Section -->

             
            
            <!-- ======= F.A.Q Section ======= -->
            @if ($faqs->count() > 0)
            <section id="faq" class="">
                <div class="container text-center mt-5 wow fadeInUp">
                    <div class="container text-center mt-5 wow fadeInUp" data-aos="fade-up">
                        <header class="section-header">
                            <div class="d-flex justify-content-center">
                                <div class="custom-border rounded  my-2"></div>
                            </div>
                            <h1 class="mt-3 fw-bold text-center mb-3 text-gradient text-uppercase">Frequently Asked Questions</h1>
                        </header>

                    <div class="accordion" id="faq-accordion">
                        <div class="row align-items-top">
                            @foreach ($faqs as $faq)
                            <div class="col-lg-6 col-md-6">
                                <div class="card border-0 card-shadow card-faq my-3 text-light">
                                    <a id="accordionItem" class="btn collapsed accordion-button card-accordion text-center text-primary text-light "
                                        data-bs-toggle="collapse" data-bs-target="#faqAccordion{{ $faq->id }}"
                                        aria-expanded="false" aria-controls="faqAccordion{{ $faq->id }}">
                                        <h5 class="section-title m-0 ps-5 pe-5">{{$faq->question}}
                                        </h5>
                                    </a>
                                    <div id="faqAccordion{{ $faq->id }}" class="accordion-collapse collapse"
                                        data-bs-parent="#faq-accordion">
                                        <div class="card-body shadow-sm rounded-20">
                                            <p class="text-primary ">
                                                {{ $faq->answer }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
                
            @endif
            
            <!-- End F.A.Q Section -->
            <!-- ======= Sponsor ======= -->
            @if (count($sponsors) > 0)
                <section id="sponsors" class="bg-white">
                    <div class="container text-center pt-5 wow fadeInUp">
                        <div class="title-line mx-auto"></div>
                        <h1 class="fw-bold mt-3 c-text-1 c-text-about home_title text-center heading-primary">Sponsors
                        </h1>
                        <div class="card border-0 card-shadow rounded-20">
                            <div class="card-body my-3">
                                <div class="row justify-content-center align-items-center">
                                    @foreach ($sponsors as $sponsor)
                                        <div class="col-lg-2 col-md-3 col-4">
                                            <img src="/storage/sponsor/logo/{{ $sponsor->logo }}" class="w-100 py-1"
                                                alt="{{ $sponsor->name }}">
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
                        <div class="card border-0 card-shadow rounded-20">
                            <div class="card-body my-3">
                                <div class="row justify-content-center align-items-center">
                                    @foreach ($mediaPartners as $mediaPartner)
                                        <div class="col-lg-1 col-md-2 col-3 ">
                                            <img src="/storage/logo/media-partner/{{ $mediaPartner->logo }}"
                                                class="w-100 me-3 pe-3 rounded" alt="{{ $mediaPartner->name }}">
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
            <!-- ======= Question ======= -->
            {{-- <section id="contact-us" class="bg-white">
                <div class="container wow fadeInUp p-4">
                    <div class="title-line mx-auto"></div>
                    <div class="d-flex justify-content-center">
                       <div class="custom-border rounded  mt-2"></div>
                    </div>
                    <h5 class="my-3 fw-bold text-center " style="color: #32649E;">SUBMIT QUESTION</h5>
                    <h1 class="fw-bold mt-3 c-text-1 c-text-about text-center mb-4 home_title heading-primary">Drop
                        Your Question Here
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
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-sm-9">
                                        <input class="form-control " id="email" name="email"
                                            value="{{ old('email') }}" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0 mb-sm-3">
                                    <label for="question" class="col-sm-3 col-form-label text-sm-left">
                                        Question
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
                    </form>
                </div>
            </div> --}}
            </section>




        </main><!-- End #main -->


        <!-- ======= Footer ======= -->
        <x-footer></x-footer>



        <!-- End Footer -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>
    
        <div class="modal modal-lg fade" id="general-detail" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-20 border-0 shadow p-4">
                    <div class="modal-headers border-bottom-0 p-3 ">
                        <h1 class="text-uppercase fw-bold  text-center text-gradient " style="letter-spacing: 0.1em">General Rules </h1>
                        <div class="d-flex justify-content-center">
                            <div class="custom-border rounded mt-2 mb-4"></div>
                        </div>
                        <h2 class="text-gradient fw-bold">Competitions</h2>
                        <p>
                            There will be 7 different fields of competition, which are Speech, Newscasting, Storytelling, Debate, Spelling Bee, and Online Competition. All the fields of competition in the 2023 AEO will have general rules that will be implemented in many kinds of the competition fields. Hereby are the important general rules that have to be noticed by the participants of the competition fields.

                        </p>
                    </div>
                    <div class="modal-body" style="margin-top:-20px;">
                        <h2 class="text-gradient fw-bold">General Competition Rules</h2>
                        <ul class="list-group" style="">
                            <li class="list-group-item">Past champions of the Asian English Olympics are not allowed to join the same competition field that they have won before. But they are allowed to join other competition fields.   
                            </li>
                            <li class="list-group-item">Participants must re-register themselves before the technical meeting or opening ceremony to get their name tags and confirm their attendance.

                            </li>
                            <li class="list-group-item">Participants must come at least an hour before the Opening Ceremony, Breaking Announcement, Closing Ceremony and the competition rounds.

                            </li>
                            <li class="list-group-item">Participants are highly recommended to attend the coaching clinic to learn some tips and tricks from our judges regarding the rounds.

                            </li>
                            <li class="list-group-item"> Participants who don’t attend the technical meeting and coaching clinic won’t be guaranteed to get further information from the committee outside of those sessions.

                            </li>

                            <li class="list-group-item"> All participants must arrive at the waiting room at least 15 minutes before the competition starts.
                            </li>

                            <li class="list-group-item"> There will be a roll call before every round. All participants will be called 3 times when it’s their turn, before considered as a walk-out.

                            </li>
                            <li class="list-group-item">Participants should remain outside the performing room that is designated by the committee until they are called to perform.

                            </li>
                            <li class="list-group-item"> Judges may (in their discretion) deduct 3 points from the total score in one round for violation of rules (deduction for exceeding timing will be described in timing rules).

                            </li>
                            <li class="list-group-item"> 3 points will be deducted for each of violations, such as discriminating/insulting explicitly or implicitly any ethnicity, nation, and religion. 

                            </li>
                            <li class="list-group-item"> 3 points will be deducted for explicit content as well like pornography (for example mentioning about two people having an intercourse or describing some sensitive body part exaggeratedly) 

                            </li>
                            <li class="list-group-item"> Judges may also disqualify participants for gross misconduct or ineligibility.

                            </li>
                            <li class="list-group-item"> Properties categorized as sharp tools or dangerous weapons, liquids, or powders that can litter the performing room are strictly prohibited.

                            </li>

                            <li class="list-group-item">Participants are encouraged to bring their own stationery.
                            </li>
                            <li class="list-group-item">All judges’ decisions and results inside the result slips and ballots are considered final.
                            </li>
                            <li class="list-group-item">Participants are prohibited from bringing any script/notes during their performance on stage (except debate, speech in preliminary II, newscasting).
                            </li>
                            <li class="list-group-item">Participants are prohibited from being assisted by anyone else (friends, teachers, coaches, PICs, etc), except fellow teammates in Debate Competition.</li>
                            <li class="list-group-item">Participants that perform any form of cheating will be disqualified.
                            </li>
                            <li class="list-group-item">Every payment done by the participant can’t be undone (no refund).
                            </li>
                            <li class="list-group-item">No electronic devices allowed during competition(Preparation room, performing room, after performing room).
                            </li>
                            <li class="list-group-item">The rules of the competition might change, if the changes did happen, the committee will provide notifications of the rules change in the AEO Website.
                            </li>
                        </ul>
                        
                    </div>
                    <div class="modal-footers text-center">
                        <button type="button"
                            class="btn btn-outline-theme rounded-pill rounded-20 mb-4 px-4"
                            data-bs-dismiss="modal">
                            OK, I got it
                        </button>
                    </div>
                </div>
            </div>  
            </div>  
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let owl = $('.owl-carousel');
        owl.owlCarousel({
            loop: true,
            nav: true,
            autoplay: true,
            dots: true,
            lazyLoad: true,
            margin: 15,
            center: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                items: 2
                },
                1200: {
                    items: 3
                },

            }
        });
 
        let timer = function(date) {
            let timer = Math.round(new Date(date).getTime() / 1000) - Math.round(new Date().getTime() / 1000);
            let minutes, seconds;
            setInterval(function() {
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

        $('.owl-next span').text('');
        $('.owl-next span').addClass('fa-solid fa-arrow-right');
        $('.owl-prev span').text('');
        $('.owl-prev span').addClass('fa-solid fa-arrow-left');

        //using the function
        const tomorrow = new Date("January 13, 2023 18:00:00")
        timer(tomorrow);

        $('figure.table table').addClass('table-bordered mx-auto text-center w-100' )
    </script>
</x-layout>
