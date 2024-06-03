@extends('layouts.cart-layout.app')

@section('content')
<section class="bg-white py-8 mt-14 antialiased dark:bg-gray-900 md:py-16">
    <form action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="mx-auto max-w-3xl">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Order summary</h2>
  
  
        <div class="mt-6 sm:mt-8">
          <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800">
            <table class="w-full text-left font-medium text-gray-900 dark:text-white md:table-fixed">
              <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                @foreach($transaction->transactionDetails as $detail)
                <tr>
                  <td class="whitespace-nowrap py-4 md:w-[384px]">
                    <div class="flex items-center gap-4">
                      <span class="flex items-center aspect-square w-10 h-10 shrink-0">
                        @if($detail->product->images->first())
                            <img  class="h-10 w-20 dark:hidden object-cover" src="{{ asset('storage/' . $detail->product->images->first()->image_url) }}" alt="image not found" title="{{ $detail->name }}">
                        @endif
                      </span>
                      <p>{{ $detail->product->name }}</p>
                    </div>
                  </td>
  
                  <td class="p-4 text-base font-normal text-gray-900 dark:text-white">x{{ $detail->quantity }}</td>
  
                  <td class="p-4 text-right text-base font-bold text-gray-900 dark:text-white">{{ 'Rp' . number_format($detail->price, 0, ',', '.') }}</td>
                </tr>
                
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="mt-4 space-y-6">
            <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Pilih opsi pengiriman</h4>
            
            <ul class="grid w-full gap-6 md:grid-cols-2">
                <li>
                    <input type="radio" id="kirim-paket" name="pengiriman" value="kirim-paket" class="hidden peer" required />
                    <label for="kirim-paket" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                        <div class="block">
                            <div class="w-full text-lg font-semibold">kirim paket</div>
                            <div class="w-full">jasa yang tersedia: JNE, POS, TIKI</div>
                        </div>
                        <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </label>
                </li>
                <li>
                    <input type="radio" id="cod-toko" name="pengiriman" value="cod-toko" class="hidden peer">
                    <label for="cod-toko" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <div class="block">
                            <div class="w-full text-lg font-semibold">ambil ditoko</div>
                            <div class="w-full">datang langsung ke toko</div>
                        </div>
                        <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                        </svg>
                    </label>
                </li>
            </ul>

            <div class="w-1/2 {{-- mx-auto --}}">
            
            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukan alamat lengkap</label>
            <textarea id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="alamat"></textarea>

            
            @livewire('user-page.transaction.check-ongkir')

            </div>


          </div>

          <div class="mt-6 {{-- space-y-6 --}}">
            <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Pilih Metode Pembayaran</h4>
            

            <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
              <h2 id="accordion-flush-heading-1">
                <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                  <span class="flex items-center">
                    E-wallet
                    <svg class="w-5 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V192c0-35.3-28.7-64-64-64H80c-8.8 0-16-7.2-16-16s7.2-16 16-16H448c17.7 0 32-14.3 32-32s-14.3-32-32-32H64zM416 272a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>
                  </span>
                  <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                  </svg>
                </button>
              </h2>
              <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                  
                  <ul class="grid w-full gap-6 md:grid-cols-1">
                      <li>
                          <input type="radio" id="hosting-small" name="hosting" value="hosting-small" class="hidden peer" required />
                          <label for="hosting-small" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                              <div class="block">
                                  <div class="w-full text-lg font-semibold">DANA</div>
                                  
                              </div>
                              <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                              </svg>
                          </label>
                      </li>
                      <li>
                          <input type="radio" id="hosting-big" name="hosting" value="hosting-big" class="hidden peer">
                          <label for="hosting-big" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                              <div class="block">
                                  <div class="w-full text-lg font-semibold">Gopay</div>
                                
                              </div>
                              <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                              </svg>
                          </label>
                      </li>
                  </ul>

                </div>
              </div>
              <h2 id="accordion-flush-heading-2">
                <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
                  <span class="flex items-center">
                    Transfer Bank
                    <svg class="w-5 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M243.4 2.6l-224 96c-14 6-21.8 21-18.7 35.8S16.8 160 32 160v8c0 13.3 10.7 24 24 24H456c13.3 0 24-10.7 24-24v-8c15.2 0 28.3-10.7 31.3-25.6s-4.8-29.9-18.7-35.8l-224-96c-8-3.4-17.2-3.4-25.2 0zM128 224H64V420.3c-.6 .3-1.2 .7-1.8 1.1l-48 32c-11.7 7.8-17 22.4-12.9 35.9S17.9 512 32 512H480c14.1 0 26.5-9.2 30.6-22.7s-1.1-28.1-12.9-35.9l-48-32c-.6-.4-1.2-.7-1.8-1.1V224H384V416H344V224H280V416H232V224H168V416H128V224zM256 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/></svg>  
                  </span>
                  <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                  </svg>
                </button>
              </h2>
              <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                  <ul class="grid w-full gap-6 md:grid-cols-1">
                    <li>
                        <input type="radio" id="hosting-small1" name="hosting" value="hosting-small" class="hidden peer" required />
                        <label for="hosting-small1" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                            <div class="block">
                                <div class="w-full text-lg font-semibold">BCA</div>
                               
                            </div>
                            <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="hosting-big1" name="hosting" value="hosting-big" class="hidden peer">
                        <label for="hosting-big1" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">BRI</div>
                                
                            </div>
                            <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </label>
                    </li>
                </ul>
                </div>
              </div>
             
            </div>
            
  
  
            <div class="space-y-4">
              <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                <dd class="text-lg font-bold text-gray-900 dark:text-white">{{ 'Rp' . number_format($total, 0, ',', '.') }}</dd>
              </dl>
            </div>
  
            <div class="gap-4 sm:flex sm:items-center">
              
              <button type="button" class="w-full rounded-lg  border border-gray-200 bg-white px-5  py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                Return to Shopping</button>
  
              <button type="submit" class="mt-4 flex w-full items-center justify-center rounded-lg bg-primary-700  px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300  dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:mt-0">
                Send the order</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    
  </section>
    
@endsection