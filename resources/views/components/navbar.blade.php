<nav class="navbar navbar-expand-lg fixed-top shadow-sm c-navbar  text-white" style="font-family: 'Lexend', sans-serif;
">
    <div class="container" style="opacity: 100% !important;">
        <div class="d-inline-block">
            <a class="navbar-brand" href="/">
                <img src="/storage/assets/AEO 2023White.png" alt="" width="100">
            </a>
        </div>
        <button class="navbar-toggler border" type="button" data-bs-target="#navbar-menu" data-bs-toggle="collapse"
            aria-controls="contain" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon pt-1 c-text-1"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar-menu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item active m-1">
                    <a href="/" class="btn btn-block px-3 nav-text nav-btn text-white">Home</a>
                </li>
                <li class="nav-item active m-1">
                    <a href="/about-us" class="btn btn-block px-3 nav-text nav-btn text-white">About Us</a>
                </li>

                <li class="nav-item active m-1">
                    <a href="{{route('merchandise-orders.index')}}" class="btn btn-block px-3 nav-text nav-btn text-white">Merchandise</a>
                </li>
                @php
                    $ambassadors = App\Models\Ambassador::all()->count();
                @endphp
                @if ($ambassadors > 0)
                    <li class="nav-item active m-1">
                        <a href="/#ambassadors" class="btn btn-block px-3 nav-text nav-btn text-white">Our
                            Ambassadors</a>
                    </li>
                @endif
                <li class="nav-item active m-1">
                    <a href="#footer" class="btn btn-block px-3 nav-text nav-btn text-white">Contact</a>
                </li>
                {{-- <li class="nav-item active m-1">
                    <a href="https://drive.google.com/file/d/1A7NQnXNSTViTaXpwJEEHiNE83J6MIXbP/view" target="_blank"
                        class="btn btn-block px-3 nav-text nav-btn text-white">Terms and Conditions</a>
                </li> --}}
                <li class="nav-item active m-1">
                    <a href="{{route('ranking-lists.index',["DB","preliminary"])}}" target="_blank"
                        class="btn btn-block px-3 nav-text nav-btn text-white">Score & Ranking</a>
                </li>

            </ul>
            <div class="d-flex">
                @if (!Auth::guard('admin')->check() && !Auth::check())
                    @if (Route::has('register'))
                        <a class="btn c-button-1 rounded-20 mx-2 px-3 w-100"
                            href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @if (Route::has('login'))
                        <a class="btn c-button-2 rounded-20 mx-2 px-3 w-100 text-white"
                            href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
                @else
                    <a class="btn btn-outline-white rounded-20 mx-2 px-3 w-100"
                        href="{{ Auth::guard('admin')->check() ? route('admin.dashboard') : route('dashboard') }}">
                        {{ __('Dashboard') }} </a>
                    <a class="btn btn-block nav-text nav-btn text-white px-3 mx-2 mx-md-0 w-100"
                        href="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }} </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endif
        </div>
    </div>
</div>
</nav>
