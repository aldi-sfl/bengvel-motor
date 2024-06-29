<div>
    {{-- In work, do what you enjoy. --}}

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
                <div class="flex">
                <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Pilih opsi pengiriman</h4>
                <div wire:loading wire:target="shippingMethod" class="ml-2 mt-2">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
                    <span class="sr-only">Loading...</span>
                </div>
                </div>
                <ul class="grid w-full gap-6 md:grid-cols-2">
                    <li>
                        <input type="radio" wire:model="shippingMethod" id="kirim-paket" name="pengiriman" value="kirim-paket" class="hidden peer" required />
                        <label for="kirim-paket" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                            <div class="block">
                                <div class="w-full text-lg font-semibold">kirim paket</div>
                                <div class="w-full">jasa yang tersedia: JNE, POS</div>
                            </div>
                            <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                            </svg>
                        </label>
                    </li>
                    <li>
                        <input type="radio" wire:model="shippingMethod" id="cod-toko" name="pengiriman" value="ambil-toko" class="hidden peer">
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
                
                @if ($shippingMethod == 'kirim-paket')                
                    <div class="w-1/2 mx-auto">
                        @if (session()->has('error'))
                            <div class="bg-red-500 text-white p-2 rounded">
                                {{ session('error') }}
                            </div>
                            <p>terjadi kesalahan silahkan cek koneksi internet anda lalu refresh halaman ini kembali</p>
                        @else
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">masukan alamat lengkap</label>
                        <textarea id="message" wire:model="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="alamat">
                        </textarea>
                        <div class="mt-4">
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No handphone</label>
                            <input wire:model.defer="phone" type="text" id="phone" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>
                        <div class="cekongkir">
                            <form class="max-w-sm mx-auto">
                            
                                <label for="fromProvince" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white sr-only">Provinsi asal</label>
                                <select wire:model="fromProvince" id="fromProvince" class="sr-only bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Pilih Provinsi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                                    @endforeach
                                </select>
                            
                                <label for="fromCity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white sr-only">Kota asal</label>
                                <select wire:model="fromCity" id="fromCity"  class="sr-only bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Pilih Kota Asal</option>
                                    @if ($fromCities)
                                        @foreach ($fromCities as $city)
                                            <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                        @endforeach
                                    @endif
                                </select>
                        
                                <label for="toProvince" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinsi tujuan</label>
                                <select wire:model="toProvince" id="toProvince" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Pilih Provinsi</option>
                                    @foreach ($provinces as $pronvicee)
                                        <option value="{{ $pronvicee['province_id'] }}">{{ $pronvicee['province'] }}</option>
                                    @endforeach
                                </select>
                                @error('toProvince') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            
                                <div class="mt-4">
                                    <label for="toCity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kota tujuan</label>
                                    <select wire:model="toCity" id="toCity" @if (!$toProvince) disabled @endif class="@if (!$toProvince) cursor-not-allowed @endif bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Pilih Kota tujuan</option>
                                        @if ($toCities)
                                        @foreach ($toCities as $city)
                                            <option value="{{ $city['city_id'] }}">{{ $city['city_name'] }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('toCity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mt-4">
                                    <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">total berat produk(gram)</label>
                                    <input disabled wire:model.defer="weight" type="text" id="weight" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @error('weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="mt-4">
                                    <label for="courier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Kurir</label>
                                    <select wire:model="courier" id="courier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected value="pilih-kurir">Pilih Kurir</option>
                                        <option value="jne">JNE</option>
                                        <option value="pos">POS</option>
                                        @error('courier') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </select>
                                </div>
                                    <button 
                                    wire:click.prevent="check"
                                    class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 
                                    @if (!$fromProvince || !$fromCity || !$toProvince || !$toCity || !$courier) 
                                        cursor-not-allowed 
                                    @endif"
                                    @if (!$fromProvince || !$fromCity || !$toProvince || !$toCity || !$courier)
                                        disabled
                                    @endif
                                >
                                    Submit
                                </button>
                                <p wire:loading>loading</p>
                            </form>
                            
                            {{-- @if ($costResult)
                                <div class="mt-4">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Pilih Layanan:</h2>
                                    <ul>
                                        @foreach ($costResult['rajaongkir']['results'] as $item)
                                            <ul>
                                                @foreach ($item['costs'] as $cost)
                                                    @foreach ($cost['cost'] as $detail)
                                                        <div class="flex items-start ps-4 py-2 border border-gray-200 rounded dark:border-gray-700 mb-2">
                                                            <input id="bordered-radio-{{ $cost['service'] }}" 
                                                                type="radio" 
                                                                value="{{ $cost['service'] }}" 
                                                                wire:model="selectedShippingService"
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mt-1">
                                                            <label for="bordered-radio-{{ $cost['service'] }}" class="w-full ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                                <div>{{ $cost['service'] }} - {{ $cost['description'] }}</div>
                                                                <div class="font-light">Harga: Rp.{{ number_format($detail['value']) }}</div>
                                                                <div class="font-light">Estimasi: {{ $detail['etd'] }} hari</div>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">konfimasi jasa kurir</button>
                                </div>
                            @endif --}}

                            @if ($costResult)
                                <div class="mt-4">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-white">Pilih Layanan:</h2>
                                    <ul>
                                        @foreach ($costResult['rajaongkir']['results'] as $item)
                                            <ul>
                                                @foreach ($item['costs'] as $cost)
                                                    @foreach ($cost['cost'] as $detail)
                                                        <div class="flex items-start ps-4 py-2 border border-gray-200 rounded dark:border-gray-700 mb-2">
                                                            <input id="bordered-radio-{{ $cost['service'] }}" 
                                                                type="radio" 
                                                                value="{{ $cost['service'] }}" 
                                                                wire:model="selectedShippingService"
                                                                wire:click="$set('selectedShippingPrice', {{ $detail['value'] }})"
                                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mt-1">
                                                            <label for="bordered-radio-{{ $cost['service'] }}" class="w-full ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                                <div>{{ $cost['service'] }} - {{ $cost['description'] }}</div>
                                                                <div class="font-light">Harga: Rp.{{ number_format($detail['value']) }}</div>
                                                                <div class="font-light">Estimasi: {{ $detail['etd'] }} hari</div>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </ul>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        
                    
                        </div>
                        @endif {{-- end of error statement --}}
                    </div>
                @endif
                
    
              </div>
    
              <div class="mt-6" >
                  <h4 class="text-xl font-semibold text-gray-900 dark:text-white">Pilih Metode Pembayaran</h4>
                  
                  <div id="accordion-open" data-accordion="open" data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
                      {{-- <!-- E-wallet Section -->
                      <h2 id="accordion-flush-heading-1">
                          <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                              <span class="flex items-center">
                                  E-wallet
                                  <svg class="w-5 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- SVG content --></svg>
                              </span>
                              <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                              </svg>
                          </button>
                      </h2>
                      <div id="accordion-flush-body-1" class="{{ $accordionState['e_wallet'] ? '' : 'hidden' }}" aria-labelledby="accordion-flush-heading-1">
                          <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                              <ul class="grid w-full gap-6 md:grid-cols-1">
                                  <li>
                                      <input type="radio" id="dana" name="payment_method" wire:model="payment_method" value="dana" class="hidden peer" required />
                                      <label for="dana" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                          <div class="block">
                                              <div class="w-full text-lg font-semibold">DANA</div>
                                          </div>
                                          <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                          </svg>
                                      </label>
                                  </li>
                                  <li>
                                      <input type="radio" id="gopay" name="payment_method" wire:model="payment_method" value="gopay" class="hidden peer">
                                      <label for="gopay" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
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
              
                      <!-- Transfer Bank Section -->
                      <h2 id="accordion-flush-heading-2">
                          <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-2" aria-expanded="false" aria-controls="accordion-flush-body-2">
                              <span class="flex items-center">
                                  Transfer Bank
                                  <svg class="w-5 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- SVG content --></svg>  
                              </span>
                              <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                              </svg>
                          </button>
                      </h2>
                      <div id="accordion-flush-body-2" class="{{ $accordionState['bank_transfer'] ? '' : 'hidden' }}" aria-labelledby="accordion-flush-heading-2">
                          <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                              <ul class="grid w-full gap-6 md:grid-cols-1">
                                  <li>
                                      <input type="radio" id="bca" name="payment_method" wire:model="payment_method" value="bca" class="hidden peer" required />
                                      <label for="bca" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                          <div class="block">
                                              <div class="w-full text-lg font-semibold">BCA</div>
                                          </div>
                                          <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                          </svg>
                                      </label>
                                  </li>
                                  <li>
                                      <input type="radio" id="bri" name="payment_method" wire:model="payment_method" value="bri" class="hidden peer">
                                      <label for="bri" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
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
                      </div> --}}

                      <h2 id="accordion-flush-heading-1 ">
                          <button type="button" class="flex items-center justify-between w-full py-5 font-medium rtl:text-right text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400 gap-3" data-accordion-target="#accordion-flush-body-1" aria-expanded="true" aria-controls="accordion-flush-body-1">
                              <span class="flex items-center">
                                  Transfer 
                                  <div wire:loading.delay wire:target="payment_method" class="ml-2 px-3 py-1 text-xs font-medium leading-none text-center text-blue-800 bg-blue-200 rounded-full animate-pulse dark:bg-blue-900 dark:text-blue-200">loading...</div>
                                  <svg class="w-5 h-5 mx-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!-- SVG content --></svg>
                              </span>

                              <svg data-accordion-icon class="w-3 h-3 {{ $accordionState['transfer'] ? 'rotate-180' : '' }} shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                              </svg>
                          </button>
                      </h2>
                      <div id="accordion-flush-body-1" class="{{ $accordionState['transfer'] ? '' : 'hidden' }}" aria-labelledby="accordion-flush-heading-1">
                          <div class="py-5 border-b border-gray-200 dark:border-gray-700">
                              <ul class="grid w-full gap-6 md:grid-cols-1">
                                @if($shippingMethod == 'ambil-toko')
                                    <li>
                                        <input type="radio" id="cash_on_site" name="payment_method" wire:model="payment_method" value="bayar-diToko" class="hidden peer" required />
                                        <label for="cash_on_site" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">Bayar di Toko</div>
                                            </div>
                                            <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                            </svg>
                                        </label>
                                    </li>
                                @endif
                                @foreach($list_payment as $payment)
                                    <li>
                                        <input type="radio" id="payment_{{ $payment->id }}" name="payment_method" wire:model="payment_method" value="{{ $payment->bank_name }}" class="hidden peer" required />
                                        <label for="payment_{{ $payment->id }}" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">{{ $payment->bank_name }}</div>
                                            </div>
                                            <svg class="w-5 h-5 ms-3 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                            </svg>
                                        </label>
                                    </li>
                                @endforeach
                                
                              </ul>
                          </div>
                      </div>
                      
                  </div>
              
                  <div class="space-y-4">
                      <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                          <dt class="text-md font-medium text-gray-900 dark:text-white">Total harga barang</dt>
                          <dd class="text-md font-medium text-gray-900 dark:text-white">{{ 'Rp' . number_format($total, 0, ',', '.') }}</dd>
                      </dl>
                      <dl class="flex items-center justify-between gap-4 ">
                          <dt class="text-md font-medium text-gray-900 dark:text-white">ongkos kirim</dt>
                          @if ($shippingMethod == 'kirim-paket')
                          <dd class="text-md font-medium text-gray-900 dark:text-white">{{ 'Rp' . number_format($selectedShippingPrice, 0, ',', '.') }}</dd>
                          @else
                          <dd class="text-md font-medium text-gray-900 dark:text-white">Rp0</dd>
                          @endif
                      </dl>
                      <dl class="flex items-center justify-between gap-4  border-t border-gray-200 pt-2 pb-4  dark:border-gray-700 ">
                          <dt class="text-lg font-bold text-gray-900 dark:text-white">Total</dt>
                          <dd class="text-lg font-bold text-gray-900 dark:text-white">
                            {{ 'Rp' . number_format($total + ($shippingMethod == 'kirim-paket' ? $selectedShippingPrice : 0), 0, ',', '.') }}
                          </dd>
                      </dl>
                  </div>
              
                  <div class="gap-4 sm:flex sm:items-center">
                      <button type="button"  wire:click="redirectToCart" class="w-full rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                          Return
                      </button>
              
                      <button wire:click.prevent="makeAnOrder" class="mt-4 flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:mt-0">
                          Buat pesanan
                      </button>
                  </div>
              
                  @if (session()->has('message'))
                      <div class="mt-4 p-4 text-green-600 bg-green-100 rounded-lg">
                          {{ session('message') }}
                      </div>
                  @endif
                 
                    @if ($errors->any())
                        <div class="mt-4 p-4 text-red-600 bg-red-100 rounded-lg">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
              </div>
            
            </div>
          </div>
        </form>
    
        
    </section>
        


</div>
