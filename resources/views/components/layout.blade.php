<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="/storage/assets/AEO 2023Colored No Text.png" sizes="16x16 32x32"  />
    <title>The 2023 Asian Engllish Olympics</title>
    @vite(['resources/js/app.js'])
    @yield('scripts')
</head>
    <body>
        <x-alert></x-alert>
        <main>
            {{ $slot }}
        </main>
    </body>
</html>