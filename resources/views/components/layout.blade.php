<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="/storage/assets/AEO 2023Colored No Text.png" />
    <title>The 2023 Asian Engllish Olympics</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="jquery-3.6.0.min.js"></script>
   
    @yield('scripts')

 
   
 
</head>
    <body>
        <x-alert />
        <main>
            {{ $slot }}
        </main>
    </body>
</html>
