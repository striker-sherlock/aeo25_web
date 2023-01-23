<nav class="navbar navbar-expand-lg fixed-top shadow-sm c-navbar  text-white" style="font-family: 'Lexend', sans-serif;
" >
    <div class="container-fluid ms-3" style="opacity: 100% !important;">
        <div class="d-inline-block">
            <a class="navbar-brand" href="/">
                <img src="/storage/assets/AEO 2023White.png" alt="" width="100">
            </a>
            <a class=" toggle-wrapper rounded p-2 text-white" >
                {{-- <span class="navbar-toggler-icon m-0 h5 " id="show-sidebar" style="cursor: pointer;"> </span> --}}
                <span class="navbar-toggler-icon m-0 h5 text-white " id="show-sidebar" style="cursor: pointer;"> </span>
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
                    <a href="/#question" target="_blank" class="btn btn-block px-3 nav-text nav-btn text-white">Ask Question</a>
                </li>
       
                <li class="nav-item active m-1">
                    <a href="{{route('merchandise-orders.index')}}" class="btn btn-block px-3 nav-text nav-btn text-white">Merchandise</a>
                </li>
                <li class="nav-item active m-1">
                    <a href="#footer" class="btn btn-block px-3 nav-text nav-btn text-white">Contact</a>
                </li>
                <li class="nav-item active m-1">
                    <a href="https://drive.google.com/file/d/1A7NQnXNSTViTaXpwJEEHiNE83J6MIXbP/view" target="_BLANKgi" class="btn btn-block px-3 nav-text nav-btn text-white">Terms and Conditions</a>
                </li>
               
            </ul>
           
        </div>
    </div>
</nav>

<style>
    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255, 255)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
    }
    
   

</style>
