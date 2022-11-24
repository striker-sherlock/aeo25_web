<nav id="sidebar" class="sidebar-wrapper h-100 mh-100 fixed-top bg-dark-silver pr-0">
    <div class="sidebar-content">
        <div class="sidebar-brand d-flex align-items-center px-4" style="padding: 0.15rem;">
            <a class="navbar-brand" href="/">
                <img src="/storage/assets/aeo_logo_white.png" width="60">
            </a>
            <span class="c-text-1 ms-auto" id="close-sidebar" style="cursor: pointer;">
                <i class="fas fa-arrow-alt-circle-left fa-lg text-white"></i>
            </span>
        </div>
        <div class="sidebar-header border-top border-gray" style="height: auto; padding: 0.5rem 1rem;">
            <div class="d-flex flex-column align-items-center justify-content-center text-center my-3">
                <img src="/storage/images/institution-logos/{{ Auth::user()->institution_logo }}"
                    class="rounded border-teal w-25 rounded bg-white card-shadow-sm" alt="">
                <span class="mt-1 fw-bold text-wrap text-white">{{ Auth::user()->pic_name }}</span>
                <small class="text-light-silver text-wrap">{{ Auth::user()->institution_name }}</small>
            </div>
        </div>
        <div class="sidebar-menu border-top border-gray overflow-auto" style="height: calc(100% - 196px);">
            <ul class="list-unstyled m-0 py-1 text-light-silver">
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('dashboard') }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-info fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Main Dashboard</span>
                    </a>
                </li>
                {{-- <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('profiles.edit') }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-user-edit fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Edit Profile</span>
                    </a>
                </li> --}}
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('dashboard.step',1)}}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-user-plus fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Slot Registration</span>
                    </a>
                </li>
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('dashboard.step',2)}}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-credit-card fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Payment</span>
                    </a>
                </li>
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('dashboard.step', 3)}}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fa fa-users fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Participant Registration</span>
                    </a>
                </li>
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('dashboard.step', 4)}}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-copy fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Participant Submission</span>
                    </a>
                </li>
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('dashboard.accommodation-step', 1)}}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-copy fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Accommodation Slot Registration</span>
                    </a>
                </li>
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('dashboard.accommodation-step', 2)}}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-copy fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Accommodation Payment</span>
                    </a>
                </li>
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{route('dashboard.accommodation-step', 3)}}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-copy fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Accommodation Participant Registration</span>
                    </a>
                </li>
                {{-- <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('schedules.index') }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fa fa-calendar fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Schedule</span>
                    </a>
                </li> --}}
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="https://aeo.mybnec.org/storage/guidebook/The_2022_AEO_Guidebook.pdf" target="_blank" rel="noreferrer">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-book fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Guide Book</span>
                    </a>
                </li>
                {{-- <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('ranking-list.index', ['DB', 'preliminary']) }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-trophy fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Ranking List</span>
                    </a>
                </li> --}}
                {{-- <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="{{ route('certificates.index') }}">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fa fa-certificate fa-stack-1x text-dark-silver"></i>
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