<x-layout>
    <x-navbar-admin></x-navbar-admin>
    <main id="page-toggled" class="page-wrapper">
    <div class="d-inline-flex w-100">
        <x-sidebar></x-sidebar>
        {{ $slot }}
    </div>
    </main>
    {{-- <x-footer></x-footer> --}}
</x-layout>