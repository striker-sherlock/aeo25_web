<nav id="sidebar" class="sidebar-wrapper h-100 mh-100 fixed-top bg-dark-silver pe-0">
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
                <span class="mt-1 fw-bold text-white" style="font-size: 0.9rem">Test</span>
                <small class="text-secondary text-wrap text-light-silver">Test</small>
                <small class="text-secondary text-wrap text-light-silver">Test</small>
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
