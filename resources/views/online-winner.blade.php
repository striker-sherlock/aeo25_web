<x-layout>
    <x-navbar></x-navbar>
    <div class="container mt-5">
        <h3 class="text-uppercase fw-bold  text-gradient mb-4" style="letter-spacing: 0.1em">Online Competition Winner Announcement</h3>
        <hr>
        <div class="alert alert-info border-0 shadow-sm mb-3" role="alert" style="letter-spacing: .05em">
            <i class="fas fa-bullhorn"></i>
            This is announcement for the online competition. For the rest of the competition field will be announce soon together with the score.
        </div>

        <ul class="nav nav-pills d-flex justify-content-around mb-5">
            <li class=""><a data-bs-toggle="pill" href="#ssw" class="btn btn-outline-primary rounded-pill me-3 d-block w-100 ssw  ">Short Story Writting</a></li>

            <li class=""><a data-bs-toggle="pill" href="#rd" class="btn btn-outline-primary rounded-pill me-3 d-block w-100 rd">   Radio Drama</a></li>
        </ul>

        <div class="tab-content ">
            {{-- SSW --}}
            <div id="ssw" class="tab-pane fade show     "  >
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-card>
                            <h1 class="text-uppercase fw-bold mb-4 aeo-title text-center" style="letter-spacing: 0.1em">
                                champion
                            </h1>
                            <img src="https://aeo.mybnec.org/storage/profile_picture/DB/Chung_Pak_Lun_1674636984.jpg" alt="" class="w-50  img-fluid rounded-circle d-block mx-auto mb-4" >
                            <div class="text-center">
                                <h2 class="aeo-theme letter-capitalize">Chung Pak Lun</h2> 
                                <h4 class="text-gradient">La Salle College</h4>
                            </div> 
                        </x-card>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-card>
                            <h1 class="text-uppercase fw-bold mb-4 aeo-title text-center" style="letter-spacing: 0.1em">
                                1<sup>st</sup> Runner Up
                            </h1>
                            <img src="https://aeo.mybnec.org/storage/profile_picture/SSW/Nathan_Kyle_Reyes_Cometa_1674980732.jpg" alt="" class="w-50  img-fluid rounded-circle d-block mx-auto mb-4 border" >
                            <div class="text-center">
                                <h2 class="aeo-theme letter-capitalize">Nathan Kyle Reyes Cometa
                                </h2> 
                                <h4 class="text-gradient">Philippine Science High School-Main Campus
                                </h4>
                            </div> 
                        </x-card>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-card>
                            <h1 class="text-uppercase fw-bold mb-4 aeo-title text-center" style="letter-spacing: 0.1em">
                               2<sup>nd</sup> Runner Up
                            </h1>
                            <img src="https://aeo.mybnec.org/storage/profile_picture/SSW/Pong_Pok_Him_1676738522.jpg" alt="pong pok him" class="w-50  img-fluid rounded-circle d-block mx-auto mb-4 border" >
                            <div class="text-center">
                                <h2 class="aeo-theme letter-capitalize">Pong Pok Him</h2> 
                                <h4 class="text-gradient">La Salle College</h4>
                            </div> 
                        </x-card>
                    </div>
                </div>
            </div>

            {{-- RD --}}
            <div id="rd" class="tab-pane fade">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <x-card>
                            <h1 class="text-uppercase fw-bold mb-4 aeo-title text-center" style="letter-spacing: 0.1em">
                                champion
                            </h1>
                            <img src="https://aeo.mybnec.org/storage/institution_logo/Tunku_Kurshiah_College_1673421558.png" alt="" class="w-50  img-fluid d-block mx-auto mb-4" >
                            <div class="text-center">
                                <h2 class="aeo-theme letter-capitalize">Tunku Karsiah College (TEAM C)
                                </h2> 
                                <h4 class="text-gradient">Anna Natasha Mohd Khairil
                                </h4>
                                <h4 class="text-gradient">Aryanna Ayesha Mohd Shazlan
                                </h4>
                                <h4 class="text-gradient">Adlina Maisarah Mohd Zaki
                                </h4>
                                <h4 class="text-gradient">Alyssa Zahra Fariz Nazman Fariz
                                </h4>
                                <h4 class="text-gradient">Nur Afrina Najwa Rezuan

                                </h4>
                                
                            </div> 
                        </x-card>
                    </div>

                    <div class="col-md-8">
                        <x-card>
                            <h1 class="text-uppercase fw-bold mb-4 aeo-title text-center" style="letter-spacing: 0.1em">
                                1<sup>st</sup> Runner Up
                            </h1>
                            <img src="https://aeo.mybnec.org/storage/institution_logo/Lyceum_of_the_Philippines_University_Batangas_1673338466.png" alt="" class="w-50  img-fluid d-block mx-auto mb-4" >
                            <div class="text-center">
                                <h2 class="aeo-theme letter-capitalize">Lyceum of the Philippines University-Batangas

                                </h2> 
                                <h4 class="text-gradient">Aliah Marie Macaraig Makalintal

                                </h4>
                                <h4 class="text-gradient">Arville Ramos

                                </h4>
                                <h4 class="text-gradient">Wendhyl Manalo

                                </h4>
                                <h4 class="text-gradient">Mai Tanaka

                                </h4>
                                
                                
                            </div> 
                        </x-card>
                    </div>
                    <div class="col-md-8">
                        <x-card>
                            <h1 class="text-uppercase fw-bold mb-4 aeo-title text-center" style="letter-spacing: 0.1em">
                                2<sup>nd</sup> Runner Up
                            </h1>
                            <img src="https://aeo.mybnec.org/storage/institution_logo/Tunku_Kurshiah_College_1673421558.png" alt="" class="w-50  img-fluid d-block mx-auto mb-4" >
                            <div class="text-center">
                                <h2 class="aeo-theme letter-capitalize">Tunku Karsiah College (TEAM B)
                                </h2> 
                                <h4 class="text-gradient">Ayra Aleesa Nor Razman

                                </h4>
                                <h4 class="text-gradient">Hani Zahirah Zul Zarihi


                                </h4>
                                <h4 class="text-gradient">Qaseh Mohd Fishah


                                </h4>
                                <h4 class="text-gradient">Aisyah Rosfairwan


                                </h4>
                                
                                <h4 class="text-gradient">Wan Hanna Husna

                                </h4>
                                
                                
                            </div> 
                        </x-card>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    <x-footer></x-footer>
</x-layout>