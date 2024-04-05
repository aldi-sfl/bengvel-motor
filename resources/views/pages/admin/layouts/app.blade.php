<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <script src="{{ asset('js/chart.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    
    @vite('resources/css/app.css')
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}
    @livewireStyles
</head>
<body>
    @include('pages.admin.partials.navbar')
    <div class="container mx-auto px-5 py-4" >
        {{-- @yield('content') --}}
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    @livewireScripts
</body>

</html>