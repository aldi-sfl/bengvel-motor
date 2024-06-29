@extends('layouts.payment.app')

@section('content')
<div class="container mx-auto px-5 mt-10 pt-10">
    <a href="{{ route('myOrder') }}">
    <button type="button" class="p-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-center inline-flex items-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0l3 4m-3-4l3-4"/>
        </svg>
        <span class="sr-only">back</span>
      </button>
    </a>
<div class="flex items-center justify-center">
    <div class="bg-slate-400 shadow-xl rounded-lg p-8 max-w-xl w-full">
      
        </script>
        <h1 class="text-xl font-semibold mb-4">Pembayaran</h1>
        {{-- <h1 class="text-xl font-semibold mb-4">{{ $transaction->user->name }}</h1> --}}
        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            <div class="flex justify-between">
                <span class="text-gray-600">Total Pembayaran</span>
                <span class="font-semibold text-red-500">{{ 'Rp' . number_format($transaction->total_amount, 0, ',', '.') }}</span>
            </div>
            {{-- <div class="flex justify-between mt-2">
                <span class="text-gray-600">Bayar dalam</span>
                <span class="font-semibold text-red-500">13 jam 58 menit 38 detik</span>
            </div>
                <span class="text-gray-500 text-sm">Jatuh tempo 06 Jun 2024, 08:47</span>  --}}
        </div>


        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Transfer ({{ $transaction->method_payment }}) an.{{ $paymentMethod ? $paymentMethod->atas_nama : 'N/A' }}</h2>
            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="flex justify-between items-center">
                    <span id="paymentCode" class="font-semibold text-gray-700 tracking-widest">{{ $paymentMethod ? $paymentMethod->bank_account : 'N/A' }}</span>
                    <button onclick="copyCode()" >
                    <span id="default-message" class="inline-flex items-center">
                        <svg class="w-3 h-3 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2Zm-3 14H5a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2Zm0-4H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Zm0-5H5a1 1 0 0 1 0-2h2V2h4v2h2a1 1 0 1 1 0 2Z"/>
                        </svg>
                        <span class="text-xs font-semibold">Copy</span>
                    </span>
                    </button>
                    <div id="notification" class="hidden">
                        <div {{-- id="notification" --}} class="z-50 flex {{-- hidden --}} fixed top-5 right-5 items-center w-full max-w-xs p-4 space-x-4 rtl:space-x-reverse text-gray-500 bg-yellow-200 divide-x rtl:divide-x-reverse divide-gray-200 rounded-lg shadow dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                            <div class="ps-4 text-md font-semibold">Berhasil menyalin teks</div>
                        </div>
                    </div>

                    <script>
                        function copyCode() {
                            var code = document.getElementById("paymentCode").innerText;
                            navigator.clipboard.writeText(code).then(function() {
                                var notification = document.getElementById("notification");
                                notification.classList.remove("hidden");
                                setTimeout(function() {
                                    notification.classList.add("hidden");
                                }, 3000);
                            }, function(err) {
                                console.error("Gagal menyalin teks: ", err);
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Silakan ikuti petunjuk berikut</h2>
            <ol class="list-decimal list-inside text-gray-700 space-y-2">
                <li>lakukan transaksi ke rekening yang telah disediakan </li>
                <li>lakukan pembayaran sebesar :</li>
                <li>Setelah transaksi berhasil, kamu akan mendapatkan bukti pembayaran. Mohon kirim bukti pembayaran tersebut ke <a href="#" class="font-semibold text-gray-900 underline dark:text-white decoration-indigo-500">whatsApp kami</a> untuk verifikasi lebih lanjut.</li>
            </ol>
        </div>
      
        <div class="text-center">
            <a href="{{ route('myOrder') }}">
                <button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">OK</button>
            </a>
        </div>
    </div>
</div>
</div>
@endsection