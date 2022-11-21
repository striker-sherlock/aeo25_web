<x-layout>
    <x-navbar-admin></x-navbar-admin>
    <main id="page-toggled" class="page-wrapper">
        <x-sidebar-admin></x-sidebar-admin>
        <div class="page-content">
            {{ $slot }}
        </div>
    </main>
    <x-footer></x-footer>
</x-layout>