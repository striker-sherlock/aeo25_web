<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-info w-100">
    <div class="container-fluid" style="opacity: 100% !important;">
        <div class="d-inline-block">
            <a class="navbar-brand" href="/">
                <img src="/storage/assets/AEO 2023White No Text.png" alt="aeo logo" width="100">
            </a>
            <a class=" toggle-wrapper rounded p-2" >
                <span class="navbar-toggler-icon m-0 h5 " id="show-sidebar" style="cursor: pointer;"> </span>
            </a>
        </div>

        <div class="navbar-collapse collapse" id="navbar-menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item  m-1">
                    <a href="/" class="btn btn-block px-3 nav-text nav-btn text-white">Home</a>
                </li>
                {{-- <li class="nav-item  m-1">
                    <a href="#" class="btn btn-block px-3 nav-text nav-btn text-white">Merchandise</a>
                </li> --}}
                @php
                    $ambassadors = App\Models\Ambassador::all()->count();
                @endphp
                @if ($ambassadors > 0)
                    <li class="nav-item  m-1">
                        <a href="/#ambassadors" class="btn btn-block px-3 nav-text nav-btn text-white">Our
                            Ambassadors</a>
                    </li>
                @endif

                {{-- <li class="nav-item  m-1">
                    <a href="" class="btn btn-block px-3 nav-text nav-btn text-white">Ranking List</a>
                </li> --}}
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255, 255)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
    }
    
    .toggle-wrapper:hover {
        width: fit-content;
        border: 4.5px solid #7FBCD2 ;

    }

</style>
