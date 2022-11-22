<x-layout title="{{ $title }}">
    <style>
         .page-content {
             min-height: 100vh;
         }
     </style>
     <x-navbar-user></x-navbar-user>
     <main id="page-toggled" class="page-wrapper">
         <x-sidebar></x-sidebar>
         <div class="page-content">
             {{ $slot }}
         </div>
     </main>
     <div id="footer-toggled" class=" footer-wrapper">
         <x-footer class="footer-content"></x-footer>
     </div>
 </x-layout>