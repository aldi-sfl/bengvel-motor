@extends('pages.admin.layouts.app')

@section('settings')

<div class="flex flex-col justify-center items-center">
    <h6 class="text-lg font-bold m-4 dark:text-white">Ubah Gambar Halaman Utama</h6>

    <form action="{{ route('hero-insert') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label class="m-4 block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
        <input class="m-4 block w-100 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" name="heroImage">
        <button type="submit" class="m-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Simpan</button>
    </form>



    <h1 class="text-base font-bold m-4">Gambar halaman utama saat ini</h1>
    @forelse ($settings as $setting)
        <div>
            <img class="border w-24 h-24" src="{{ asset('storage/' . $setting->heroImage) }}" alt="Hero Image" style="max-width: 100%; height: auto;">
        </div>
    @empty
        <p>No hero images found.</p>
    @endforelse

</div>
{{-- to becontinued --}}
{{-- <div class="border-t-4 mt-6 flex flex-col justify-center items-center">
    <h6 class="text-lg font-bold pt-6 dark:text-white">pengaturan kontak</h6>
    <label class="block mb-2 text-sm font-light text-gray-900 dark:text-white">atur kontak apa saja yang dapat dihubungi pada halaman contact</label>

    <form class="max-w-lg mx-auto ">
        <div class="mb-5">
        <label for="app_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">nama apikasi</label>
        <input type="app_name" id="app_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="whatsapp,facebook,dll" required />
        </div>
        <div class="mb-5">
        <label for="contact_link" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">link</label>
        <input type="contact_link" id="contact_link" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
        </div>
        
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
    
    

    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        App name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        link
                    </th>
                
                    <th scope="col" class=" px-6 py-3">
                        Aksi
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        Apple MacBook Pro 17"
                    </th>
                    <td class="px-6 py-4">
                        Silver
                    </td>
                    <td class="px-6 py-4">
                        delete
                    </td>
                </tr>
            
            </tbody>
        </table>
    </div>

</div> --}}

@endsection