<style>
        ::-webkit-scrollbar-thumb {
            border-radius: 5px;
            background-color: #767D7F !important;
        }
</style>
<nav id="sidebar" class="sidebar-wrapper h-100 mh-100 fixed-top bg-gradient-blue pr-0">
    <div class="sidebar-content">
        <div class="sidebar-brand text-end row my-2 py-2"  style="padding: 0.15rem;">
            
            <span class="c-text-1 ms-auto me-4" id="close-sidebar" style="cursor: pointer;">
                <i class="fas fa-arrow-alt-circle-left fa-lg text-white"></i>
            </span> 
        
        </div>
        <div class="sidebar-header  mb-3" style="height: auto; ">
            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                <img src="/storage/assets/AEO 2023Black.png" class="rounded-circle card-shadow bg-white" style="padding: 0.5rem; border-radius: 50;" alt="" width="70">
                <span class="mt-1 fw-bold text-white" style="font-size: 0.9rem">{{Auth::guard('admin')->user()->name}} </span>
                <small class="text-secondary text-wrap text-light">{{Auth::guard('admin')->user()->position}} </small>
                <small class="text-secondary text-wrap text-light"> {{Auth::guard('admin')->user()->division}} </small>
            </div>
        </div>
        <div class="sidebar-menu border-top overflow-auto" style="height: calc(100% - 196px);">
            <ul class="list-unstyled m-0 py-1 text-light">
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="/admin/dashboard">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-info fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Main Dashboard</span>
                    </a>
                </li>
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Treasury</span>
                    </li>
                    <li class=" pb-1 side-item pb-1 sidebar-dropdown">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset">
                            <span class="fa-stack fa-sm ml-n1">
                                <i class="fas fa-square fa-stack-2x text-dark-green"></i>
                                <i class="fas fa-dollar-sign fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Payment</span>
                            <i class="fas fa-angle-right ms-auto"></i>
                        </a>
                        <div class="sidebar-submenu">
                            <ul class="fa-ul">
                                <li class="mb-1">
                                    <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark w-100"
                                        href="{{route('competition-payments.index', "international")}}">
                                        <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                        International
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                        href="{{route('competition-payments.index', "national")}}" style="display: block">
                                        <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                        National
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">MIT - Registration</span>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{route('slot-registrations.index')}}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-list-ol fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Slot Registration</span>
                        </a>
                    </li>
                    <li class=" pb-1 side-item pb-1 sidebar-dropdown">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset">
                            <span class="fa-stack fa-sm ml-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-scroll fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Follow Up List</span>
                            <i class="fas fa-angle-right ms-auto"></i>
                        </a>
                        <div class="sidebar-submenu">
                            <ul class="fa-ul">
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="{{ route('follow-ups.index', "National") }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            National
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="{{ route('follow-ups.index',"International") }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            International
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="{{ route('follow-ups.create', 'type') }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Create Follow Up
                                        </a>
                                    </li>
                            </ul>
                        </div>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="#">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-headset fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Question List</span>
                        </a>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="#">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-address-book fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Institution Contact</span>
                        </a>
                    </li>
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Competition</span>
                    </li>
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="#">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-square fa-stack-2x"></i>
                                    <i class="fas fa-tools fa-stack-1x text-dark"></i>
                                </span>
                                <span class="ms-2">Competitions Config</span>
                            </a>
                        </li>
                    <li class=" pb-1 side-item pb-1 sidebar-dropdown">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset">
                            <span class="fa-stack fa-sm ml-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-users fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Participants</span>
                            <i class="fas fa-angle-right ms-auto"></i>
                        </a>
                        <div class="sidebar-submenu">
                            <ul class="fa-ul">
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark w-100"
                                            href="{{ route('competition-participants.index', 'DB') }}">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Debate
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark w-100"
                                            href="{{ route('competition-participants.index', 'IA') }}">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Ind.Adjudicator
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="{{ route('competition-participants.index', 'NC') }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Newscasting
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="{{ route('competition-participants.index', 'SP') }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Speech
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="{{ route('competition-participants.index', 'ST') }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Storytelling
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="{{ route('competition-participants.index', 'SB') }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Spelling bee
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="{{ route('competition-participants.index', 'RD') }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Radio Drama
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="{{ route('competition-participants.index', 'SSW') }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Short Story Writing
                                        </a>
                                    </li>
                            </ul>
                        </div>
                    </li>
                    <li class=" pb-1 side-item pb-1 sidebar-dropdown">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset">
                                <span class="fa-stack fa-sm ml-n1">
                                    <i class="fas fa-square fa-stack-2x"></i>
                                    <i class="fas fa-scroll fa-stack-1x text-dark"></i>
                                </span>
                                <span class="ms-2">Submissions</span>
                                <i class="fas fa-angle-right ms-auto"></i>
                            </a>
                        <div class="sidebar-submenu">
                            <ul class="fa-ul">
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="#" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Newscasting
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="#" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Speech
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="#" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Storytelling
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="#" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Radio Drama
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                            href="#" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Short Story Writing
                                        </a>
                                    </li>
                            </ul>
                        </div>
                    </li>
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="#">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-square fa-stack-2x"></i>
                                    <i class="fas fa-trophy fa-stack-1x text-dark"></i>
                                </span>
                                <span class="ms-2">Score & Ranking</span>
                            </a>
                        </li>
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="#">
                                <span class="fa-stack fa-sm ml-n1">
                                    <i class="fas fa-square fa-stack-2x"></i>
                                    <i class="fas fa-medal fa-stack-1x text-dark"></i>
                                </span>
                                <span class="ms-2">Side Achievements</span>
                            </a>
                        </li>
                  
                        <li class=" pb-1 side-item pb-1 sidebar-dropdown">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset">
                                <span class="fa-stack fa-sm ml-n1">
                                    <i class="fas fa-square fa-stack-2x"></i>
                                    <i class="fas fa-calendar-plus fa-stack-1x text-dark"></i>
                                </span>
                                <span class="ms-2">Competition Schedule</span>
                                <i class="fas fa-angle-right ms-auto"></i>
                            </a>
                            <div class="sidebar-submenu">
                                <ul class="fa-ul">
                                        <li class="mb-1">
                                            <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark"
                                                href="#"
                                                <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                                Competition Name
                                            </a>
                                        </li>
                                </ul>
                            </div>
                        </li>
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Ambassador</span>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('ambassadors.manage') }}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-user fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Manage Ambassador</span>
                        </a>
                    </li>
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Event</span>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="#">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-calendar-alt fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Main Event Schedule</span>
                        </a>
                    </li>
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Funding</span>
                    </li>
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="{{ route('sponsors.index') }}">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-square fa-stack-2x"></i>
                                    <i class="fas fa-handshake fa-stack-1x text-dark"></i>
                                </span>
                                <span class="ms-2">Sponsor</span>
                            </a>
                        </li>

                         
           
                     
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Branding</span>
                    </li>
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="{{route('media-partners.index')}}">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-square fa-stack-2x"></i>
                                    <i class="fas fa-newspaper fa-stack-1x text-dark"></i>
                                </span>
                                <span class="ms-2">Media Partner</span>
                            </a>
                        </li>
               
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Website Configuration</span>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('access-controls.index') }}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-users-cog fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Access Control</span>
                        </a>
                    </li>
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="#">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-square fa-stack-2x"></i>
                                    <i class="fas fa-user-lock fa-stack-1x text-dark"></i>
                                </span>
                                <span class="ms-2">Login As PIC</span>
                            </a>
                        </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('environments.index') }}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-sliders-h fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Environment</span>
                        </a>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="#">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-house-user fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Home Content</span>
                        </a>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{route('faqs.index')}}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-question fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">FAQ</span>
                        </a>
                    </li>
            </ul>
        </div>
    </div>
    </div>
    <div class="sidebar-footer bg-danger">
        <a href="{{ route('logout') }}" class="text-decoration-none text-white"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span class="mr-1"><i class="fa fa-sign-out-alt text-white"></i></span> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</nav>
