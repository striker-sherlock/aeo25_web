<style>
    ::-webkit-scrollbar-thumb {
        border-radius: 5px;
        background-color: #767D7F !important;
    }
</style>
<nav id="sidebar" class="sidebar-wrapper h-100 mh-100 fixed-top bg-dark-silver pr-0">
    <div class="sidebar-content">
        <div class="sidebar-brand d-flex align-items-center px-4"  style="padding: 0.15rem;">
            <a class="navbar-brand" href="/">
                <img src="/storage/assets/aeo_logo_white.png" width="60">
            </a>
            <span class="c-text-1 ms-auto" id="close-sidebar" style="cursor: pointer;">
                <i class="fas fa-arrow-alt-circle-left fa-lg text-white"></i>
            </span>
        </div>
        <div class="sidebar-header border-top" style="height: auto; padding: 0.5rem 1rem;">
            <div class="d-flex flex-column align-items-center justify-content-center text-center">
                <img src="/storage/assets/aeo_logo_sm.png" class="rounded rounded card-shadow bg-white" style="padding: 0.5rem" alt="" width="70">
                <span class="mt-1 fw-bold text-white" style="font-size: 0.9rem">{{ Auth::guard('admin')->user()->name }}</span>
                <small class="text-secondary text-wrap text-light-silver">{{ Auth::guard('admin')->user()->position }}</small>
                <small class="text-secondary text-wrap text-light-silver">{{ Auth::guard('admin')->user()->division }}</small>
            </div>
        </div>
        <div class="sidebar-menu border-top overflow-auto" style="height: calc(100% - 196px);">
            <ul class="list-unstyled m-0 py-1 text-light-silver">
                <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="/admin/dashboard">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-info fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Main Dashboard</span>
                    </a>
                </li>
                @if (Auth::guard('admin')->user()->dept_init == "SC" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3 || Auth::guard('admin')->user()->div_init == "MITR"))
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Treasury</span>
                    </li>
                    <li class=" pb-1 side-item pb-1 sidebar-dropdown">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset">
                            <span class="fa-stack fa-sm ml-n1">
                                <i class="fas fa-circle fa-stack-2x text-dark-green"></i>
                                <i class="fas fa-dollar-sign fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Payment</span>
                            <i class="fas fa-angle-right ms-auto"></i>
                        </a>
                        <div class="sidebar-submenu">
                            <ul class="fa-ul">
                                <li class="mb-1">
                                    <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                        href="{{route('competition-payments.index', "international")}}">
                                        <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                        International
                                    </a>
                                </li>
                                <li class="mb-1">
                                    <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                        href="{{route('competition-payments.index', "national")}}" style="display: block">
                                        <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                        National
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->dept_init == "MITR")
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">MIT - Registration</span>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{route('competition-registrations.index')}}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-list-ol fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Slot Registration</span>
                        </a>
                    </li>
                    <li class=" pb-1 side-item pb-1 sidebar-dropdown">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset">
                            <span class="fa-stack fa-sm ml-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-scroll fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Follow Up List</span>
                            <i class="fas fa-angle-right ms-auto"></i>
                        </a>
                        <div class="sidebar-submenu">
                            <ul class="fa-ul">
                                @if (Auth::guard('admin')->user()->div_init == "MIT" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "NR")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('follow-ups.index', "National") }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            National
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->div_init == "MIT" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "IR")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('follow-ups.index',"International") }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            International
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->div_init == "MIT" || Auth::guard('admin')->user()->div_init == "MITR")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('follow-ups.create') }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Create Follow Up
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{route('questions.index')}}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-headset fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Question List</span>
                        </a>
                    </li>
                    {{-- <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="#">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-address-book fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Institution Contact</span>
                        </a>
                    </li> --}}
                @endif
                @if (Auth::guard('admin')->user()->dept_init == "SC" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "MITR"|| Auth::guard('admin')->user()->dept_init == "CMP")
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Competition</span>
                    </li>
                    @if (Auth::guard('admin')->user()->dept_init == "SC" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "MITR"|| (Auth::guard('admin')->user()->div_init == "CMP"))
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="{{ route('competitions.index') }}">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-tools fa-stack-1x text-dark-silver"></i>
                                </span>
                                <span class="ms-2">Competitions Config</span>
                            </a>
                        </li>
                    @endif
                    <li class=" pb-1 side-item pb-1 sidebar-dropdown">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset">
                            <span class="fa-stack fa-sm ml-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-users fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Participants</span>
                            <i class="fas fa-angle-right ms-auto"></i>
                        </a>
                        <div class="sidebar-submenu">
                            <ul class="fa-ul">
                                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "DB")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-participants.index', 1) }}">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Debate
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-participants.index', 2) }}">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Ind.Adjudicator
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "NC")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-participants.index', 3) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Newscasting
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "SP")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-participants.index', 4) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Speech
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "ST")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-participants.index', 5) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Storytelling
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "SB")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-participants.index', 6) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Spelling bee
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "ONC")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-participants.index', 7) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Radio Drama
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-participants.index', 8) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Short Story Writing
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    <li class=" pb-1 side-item pb-1 sidebar-dropdown">
                        @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init != "DB" || Auth::guard('admin')->user()->div_init != "SB")
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset">
                                <span class="fa-stack fa-sm ml-n1">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-scroll fa-stack-1x text-dark-silver"></i>
                                </span>
                                <span class="ms-2">Submissions</span>
                                <i class="fas fa-angle-right ms-auto"></i>
                            </a>
                        @endif
                        <div class="sidebar-submenu">
                            <ul class="fa-ul">
                                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "NC")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-submissions.index', 3) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Newscasting
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "SP")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-submissions.index', 4) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Speech
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "ST")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-submissions.index', 5) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Storytelling
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "CMP" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "ONC")
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-submissions.index', 7) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Radio Drama
                                        </a>
                                    </li>
                                    <li class="mb-1">
                                        <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                            href="{{ route('competition-submissions.index', 8) }}" style="display: block">
                                            <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                            Short Story Writing
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                    @if (Auth::guard('admin')->user()->dept_init == "SC" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "MITR"|| (Auth::guard('admin')->user()->div_init == "CMP"))
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="{{route('ranking-list.admin', ["DB","preliminary"])}}">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-trophy fa-stack-1x text-dark-silver"></i>
                                </span>
                                <span class="ms-2">Score & Ranking</span>
                            </a>
                        </li>
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="{{route('side-achievements.index')}}">
                                <span class="fa-stack fa-sm ml-n1">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-medal fa-stack-1x text-dark-silver"></i>
                                </span>
                                <span class="ms-2">Side Achievements</span>
                            </a>
                        </li>
                    @endif
                    @php
                        if (Auth::guard('admin')->user()->dept_init == "SC" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "MITR"|| (Auth::guard('admin')->user()->div_init == "CMP")) {
                            $competitions = App\Models\Competition::all();
                        }else if (Auth::guard('admin')->user()->div_init == "ONC") {
                            $competitions = App\Models\Competition::where('competition_init', 'RD')->orWhere('competition_init', 'SSW')->get();
                        }else {
                            $competitions = App\Models\Competition::where('competition_init', Auth::guard('admin')->user()->div_init)->get();
                        }
                    @endphp
                    @if ($competitions)
                        <li class=" pb-1 side-item pb-1 sidebar-dropdown">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset">
                                <span class="fa-stack fa-sm ml-n1">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-calendar-plus fa-stack-1x text-dark-silver"></i>
                                </span>
                                <span class="ms-2">Competition Schedule</span>
                                <i class="fas fa-angle-right ms-auto"></i>
                            </a>
                            <div class="sidebar-submenu">
                                <ul class="fa-ul">
                                    @foreach ($competitions as $compete)
                                        <li class="mb-1">
                                            <a class="btn btn-light btn-block border text-decoration-none text-reset text-left text-dark-silver"
                                                href="{{ route('schedules.manage', $compete->competition_init) }}">
                                                <span class="fa-li"><i class="fas fa-arrow-right"></i></span>
                                                {{ $compete->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif
                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->dept_init == "ORD")
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Ambassador</span>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('ambassadors.manage') }}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-user fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Manage Ambassador</span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->dept_init == "EV")
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Event</span>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('schedules.manage', "EV") }}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-calendar-alt fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Main Event Schedule</span>
                        </a>
                    </li>
                @endif
                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->dept_init == "FD")
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Funding</span>
                    </li>
                    @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "FD" || Auth::guard('admin')->user()->div_init == "SPS")
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="{{ route('sponsors.index') }}">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-handshake fa-stack-1x text-dark-silver"></i>
                                </span>
                                <span class="ms-2">Sponsor</span>
                            </a>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "FD" || Auth::guard('admin')->user()->div_init == "FDR")
                        @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "FD" || (Auth::guard('admin')->user()->div_init == "FDR" && Auth::guard('admin')->user()->level == 3))
                            <li class="side-item">
                                <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                    href="{{ route('event-controls.index') }}">
                                    <span class="fa-stack fa-sm ms-n1">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-users-cog fa-stack-1x text-dark-silver"></i>
                                    </span>
                                    <span class="ms-2">Event Control</span>
                                </a>
                            </li>
                        @endif
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="{{ route('event-contents.manage') }}">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-tools fa-stack-1x text-dark-silver"></i>
                                </span>
                                <span class="ms-2">Webinar Content</span>
                            </a>
                        </li>
                        <li class="side-item">
                            @if (count(Auth::guard('admin')->user()->events) == 0)
                                <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                    href="{{ route('event-participants.index', 0) }}">
                                    <span class="fa-stack fa-sm ms-n1">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-user-friends fa-stack-1x text-dark-silver"></i>
                                    </span>
                                    <span class="ms-2">Webinar Data</span>
                                </a>
                            @else
                                <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset" href="{{ route('event-participants.index', Auth::guard('admin')->user()->events->first()->event_content_id) }}">
                                    <span class="fa-stack fa-sm ms-n1">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-user-friends fa-stack-1x text-dark-silver"></i>
                                    </span>
                                    <span class="ms-2">Webinar Data</span>
                                </a>
                            @endif
                        </li>
                        <li class="side-item">
                            @if (count(Auth::guard('admin')->user()->events) == 0)
                                <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                    href="{{ route('event-payments.index', 0) }}">
                                    <span class="fa-stack fa-sm ms-n1">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-hand-holding-usd fa-stack-1x text-dark-silver"></i>
                                    </span>
                                    <span class="ms-2">Webinar Payment</span>
                                </a>
                            @else
                                <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset" href="{{ route('event-payments.index', Auth::guard('admin')->user()->events->first()->event_content_id) }}">
                                    <span class="fa-stack fa-sm ms-n1">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fas fa-hand-holding-usd fa-stack-1x text-dark-silver"></i>
                                    </span>
                                    <span class="ms-2">Webinar Payment</span>
                                </a>
                            @endif
                        </li>
                    @endif
                @endif
                @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->dept_init == "BRD")
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Branding</span>
                    </li>
                    @if (Auth::guard('admin')->user()->dept_init == "SC" || Auth::guard('admin')->user()->div_init == "MITR" || (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3) || Auth::guard('admin')->user()->div_init == "BRD" || Auth::guard('admin')->user()->div_init == "ESA")
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="{{route('media-partners.index')}}">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-newspaper fa-stack-1x text-dark-silver"></i>
                                </span>
                                <span class="ms-2">Media Partner</span>
                            </a>
                        </li>
                    @endif
                @endif
                {{-- <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="#">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-list-ul fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">Company Contact</span>
                    </a>
                </li> --}}
                {{-- <li class="side-item">
                    <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                        href="#">
                        <span class="fa-stack fa-sm ms-n1">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fas fa-list-ul fa-stack-1x text-dark-silver"></i>
                        </span>
                        <span class="ms-2">MedPar Contact</span>
                    </a>
                </li> --}}
                @if ((Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level < 5) || Auth::guard('admin')->user()->div_init == "MITR" || Auth::guard('admin')->user()->div_init == "SC")
                    <li class="pb-1 ps-3 header-menu">
                        <span class="fw-bold">Website Configuration</span>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('access-controls.index') }}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-users-cog fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Access Control</span>
                        </a>
                    </li>
                    @if (Auth::guard('admin')->user()->div_init == "MIT" && Auth::guard('admin')->user()->level == 3)
                        <li class="side-item">
                            <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                                href="{{ route('admin.login-as') }}">
                                <span class="fa-stack fa-sm ms-n1">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fas fa-user-lock fa-stack-1x text-dark-silver"></i>
                                </span>
                                <span class="ms-2">Login As</span>
                            </a>
                        </li>
                    @endif
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{ route('environments.index') }}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-sliders-h fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Environment</span>
                        </a>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{route('home-contents.index')}}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-house-user fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">Home Content</span>
                        </a>
                    </li>
                    <li class="side-item">
                        <a class="d-flex align-items-center text-decoration-none position-relative py-1 px-0 text-reset"
                            href="{{route('faqs.index')}}">
                            <span class="fa-stack fa-sm ms-n1">
                                <i class="fas fa-circle fa-stack-2x"></i>
                                <i class="fas fa-question fa-stack-1x text-dark-silver"></i>
                            </span>
                            <span class="ms-2">FAQ</span>
                        </a>
                    </li>
                @endif
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
