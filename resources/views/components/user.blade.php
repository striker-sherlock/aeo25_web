<x-layout title="{{ $title }}">
    <style>
         .page-content {
             min-height: 100vh;
         }
     </style>
     <x-alert></x-alert>
     <x-navbar-user></x-navbar-user>
     <main id="page-toggled" class="page-wrapper mb-5">
         <x-sidebar-user></x-sidebar-user>
         <div class="page-content">
             {{ $slot }}
         </div>
     </main>
     {{-- <div id="footer-toggled" class=" footer-wrapper"> --}}
    {{-- <x-footer class="footer-content"></x-footer> --}}
     {{-- </div> --}}
 </x-layout>