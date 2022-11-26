<x-layout title="{{ $title }}">
    <style>
        .page-content {
            min-height: 100vh;
        }
    </style>
    <x-navbar-user></x-navbar-user>
    <main id="page-toggled" class="page-wrapper">
        <x-sidebar-user></x-sidebar-user>
        <div class="page-content">
            {{ $slot }}
        </div>
    </main>
    {{-- <x-footer></x-footer> --}}
   
</x-layout>
