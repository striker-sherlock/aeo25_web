<x-layout>
    <x-navbar-admin></x-navbar-admin>
    <main id="page-toggled" class="page-wrapper">
    <div class="d-inline-flex w-100" style="min-height: 90vh">
        {{-- <x-sidebar-admin></x-sidebar-admin> --}}
        {{ $slot }}
    </div>
    </main>
    <x-footer></x-footer>
</x-layout>