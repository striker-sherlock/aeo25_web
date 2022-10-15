<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script>
    @vite('resources/js/app.js')

    {{-- Data Tables --}}
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div id="app">
        {{-- <x-navbar></x-navbar>
        <x-userNavbar></x-userNavbar>

        @if (isset($navbar))
            <x-navbar></x-navbar>
        @else
            <x-userNavbar></x-userNavbar>
        @endif --}}

        <main>
            {{ $slot }}
        </main>

        {{-- <x-footer></x-footer> --}}
    </div>
</body>
</html>