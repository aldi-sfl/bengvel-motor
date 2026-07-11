@extends('layouts.apps')

@section('content')

@forelse ($heroImage as $hero)
<section class="bg-center bg-no-repeat bg-gray-500 py-20 bg-blend-multiply" style="background-image: url('{{ asset('storage/' . $hero->heroImage) }}');">
@empty
<section class="bg-center bg-no-repeat bg-gray-500 py-20 bg-blend-multiply" {{-- style="background-image: url('../image/sniki.png')" --}}>
@endforelse
    <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">Orbit Motor</h1>
        <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">Kami tidak hanya menyediakan layanan bengkel berkualitas, tetapi juga menawarkan berbagai produk unggulan untuk motor Anda. Dari suku cadang asli hingga aksesori variasi, kami siap memenuhi kebutuhan motor Anda dengan produk pilihan terbaik.</p>
        <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
            <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Shop Now
                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
            </a>
            
        </div>
    </div>
</section>




<div class="px-4 mx-auto max-w-screen-xl text-center py-20 lg:py-50">
    <h1 class="mb-4 py-10 text-4xl font-extrabold tracking-tight leading-none  md:text-5xl lg:text-6xl">Mengapa Orbit motor</h1>
    
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="mx-4 my-4">
                <img class="rounded-t-lg " src="../image/mechanic (1).png" alt="" />
            </div>
            <div class="p-5">
                
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Mekanik Profesional</h5>
                
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Tim kami terdiri dari mekanik berpengalaman yang siap menangani berbagai jenis perbaikan.</p>
            </div>
        </div>
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            
                <img class="rounded-t-lg m-2" src="../image/customer-service.png" alt="" />
            
            <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Layanan Lengkap</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Mulai dari servis rutin, perbaikan mesin, hingga modifikasi, kami menyediakan semua layanan yang Anda butuhkan</p>
            
            </div>
        </div>
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                <img class="rounded-t-lg m-2" src="../image/checklist.png" alt="" />
            <div class="p-5">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Harga Terjangkau</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Nikmati layanan berkualitas dengan harga yang bersaing.</p>
            </div>
        </div>
    </div>

    <h1 class="mb-4 pt-20 text-4xl font-extrabold tracking-tight leading-none  md:text-5xl lg:text-6xl">Lokasi</h1>
    <div class="mt-10 flex justify-center items-center bg-slate-200 p-8 rounded-lg">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.059113409658!2d109.29614277590052!3d-7.458712892552689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655bd556bafffb%3A0xdf1949ad6fafd934!2sOrbit%20Motor!5e0!3m2!1sid!2sid!4v1720377665779!5m2!1sid!2sid" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    

</div>



@endsection