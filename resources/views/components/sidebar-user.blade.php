
<nav id="sidebar-user" class="sidebar-wrapper h-100 mh-100 fixed-top bg-gradient-blue pr-0">
    <div class="sidebar-content">
        <div class="sidebar-brand text-end row my-2 py-2 me-2  " style="padding: 0.15rem;">
            <span class=" ms-auto me-4  rounded burgerIcon" id="close-sidebar" style="cursor: pointer;">
                <i class=" fa-solid fa-x fa-lg text-white "></i>
            </span>
        </div>
        
        <div class="sidebar-header" style="height: auto; padding: 0.5rem 1rem;"  >
            <div class="d-flex flex-column align-items-center justify-content-center text-center ">
                <img src="/storage/institution_logo/{{ Auth::user()->institution_logo }}"
                    class="rounded border-teal rounded bg-white card-shadow-sm" alt="" style="max-height:50px;">
                <span class="mt-1 fw-bold text-wrap text-white">{{ Auth::user()->pic_name }}</span>
                <small class="text-secondary text-wrap text-light">{{ Auth::user()->institution_name }}</small>
            </div>
        </div>
        <div class="sidebar-menu border-top border-gray overflow-auto" style="height: calc(100% - 188px);">
            <ul class="list-unstyled m-0 py-1 text-light-silver">
                <li class="side-item text-white text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('dashboard') }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-info fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Main Dashboard</span>
                    </a>
                </li>
                
                <li class="side-item text-white text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('users.edit',Auth::user()->id) }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-user fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Edit Profile</span>
                    </a>
                </li>
                <li class="pb-1 ps-3 header-menu side-item text-white fs-5">
                    <span class="fw-bold aeo-title">Competition </span>
                </li>


                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('dashboard.step', 1) }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-user-plus fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Slot Registration</span>
                    </a>
                </li>
                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('slot-registrations.create-other')}}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-user-plus fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Spectator Slot Registration</span>
                    </a>
                </li>
                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('dashboard.step',2)}}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-credit-card fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Competition Payment</span>
                    </a>
                </li>
                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('dashboard.step', 3) }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fa fa-users fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Participant Registration</span>
                    </a>
                </li>
                    <li class="side-item text-white">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('dashboard.step', 4) }}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-square fa-stack-2x"></i>
                                <i class="fas fa-scroll fa-stack-1x text-dark"></i>
                            </span>
                            <span class="ms-2">Participant Submission</span>
                        </a>
                    </li>
                <li class="pb-1 ps-3 header-menu side-item text-white fs-5">
                    <span class="fw-bold aeo-title">Accommodation </span>
                </li>

                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('dashboard.accommodation-step', 1) }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-bed fa-stack-1x text-dark"></i> 
                        </span>
                        <span class="ms-2">Accommodation Slot</span>
                    </a>
                </li>
                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('dashboard.accommodation-step', 2) }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-coins fa-stack-1x text-dark"></i> 
                        </span>
                        <span class="ms-2">Accommodation Payment</span>
                    </a>
                </li>
             

                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('dashboard.accommodation-step', 3)}}">
                        <span class="fa-stack fa-sm ml-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-users fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Accommodation Guest  </span>
                    </a>
                </li>

                <li class="pb-1 ps-3 header-menu side-item text-white fs-5">
                    <span class="fw-bold aeo-title">Flights </span>
                </li>
                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('flight-registrations.create') }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fa-solid fa-plane fa-stack-1x text-dark"></i> 
                        </span>
                        <span class="ms-2">Flight Registrations</span>
                    </a>
                </li>
                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('flight-tickets.index') }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fa-solid fa-plane-departure fa-stack-1x text-dark"></i> 
                        </span>
                        <span class="ms-2">Flight Tickets</span>
                    </a>
                </li>
                <li class="pb-1 ps-3 header-menu side-item text-white fs-5">
                    <span class="fw-bold aeo-title">Schedules </span>
                </li>
                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('schedules.index') }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fa fa-calendar fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Main Schedule</span>
                    </a>
                </li>
               
                {{-- <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="https://aeo.mybnec.org/storage/guidebook/The_2022_AEO_Guidebook.pdf" target="_blank"
                        rel="noreferrer">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-book fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Guide Book</span>
                    </a>
                </li> --}}
                <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('ranking-lists.index',["DB","preliminary"])}}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fas fa-trophy fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Ranking List</span>
                    </a>
                </li>
                {{-- <li class="side-item text-white">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-square fa-stack-2x"></i>
                            <i class="fa fa-certificate fa-stack-1x text-dark"></i>
                        </span>
                        <span class="ms-2">Certificate</span>
                    </a>
                </li> --}}
            </ul>
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
