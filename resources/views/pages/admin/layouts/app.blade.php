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

    {{-- font and icon --}}
    <script src="https://kit.fontawesome.com/645c6ff9e5.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    
    

    {{-- owl carousel --}}
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    
    
    @vite('resources/css/app.css')
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}
    @livewireStyles
</head>
<body>
    @include('pages.admin.partials.navbar')
    <div class="container mx-auto px-5 py-4" >
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>

    {{-- owl carousel --}}
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}" ></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}" ></script>

    {{-- hammer js --}}
    {{-- unused for now --}}
    <script src="{{ asset('js/hammer.js') }}"></script>
    
    <script>
    //   $(document).ready(function(){
    //     $('.owl-carousel').owlCarousel({
    //         loop: true,
    //         autoWidth: true,
    //         margin: 10,
    //         responsiveClass: true,
    //         responsive: {
    //             0: {
    //                 items: 1,
    //                 nav: true,
    //                 navText: ["<svg class='w-6 h-6' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M15 19l-7-7 7-7'></path></svg>", 
    //                           "<svg class='w-6 h-6' xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='currentColor'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M9 5l7 7-7 7'></path></svg>"]
    //             }
    //         }
    //     });
    // });
    $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                }
               
            }
        })
        
    </script>
    
    @livewireScripts
</body>

</html>