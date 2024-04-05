<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    
    @vite('resources/css/app.css')
    @livewireStyles
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}
</head>
<body>
    @include('partials.navbar')
    {{-- <div class="container mx-auto px-5 py-4" >
    </div> --}}
    
    @yield('content')
    <!-- Scripts -->
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

    @include('partials.footer')
    @livewireScripts
</body>
</html>