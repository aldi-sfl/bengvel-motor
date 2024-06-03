<div>
    {{-- Be like water. --}}
    @if (session()->has('error'))
        <div class="bg-red-500 text-white p-2 rounded">
            {{ session('error') }}
        </div>
    @endif
    <form class="max-w-sm mx-auto" wire:submit.prevent='check'>
    
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
            <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berat (gram)</label>
            <input wire:model.defer="weight" type="number" id="weight" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            @error('weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    <div class="mt-4">
        <label for="courier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Kurir</label>
        <select wire:model="courier" id="courier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Pilih Kurir</option>
            <option value="jne">JNE</option>
            <option value="pos">POS</option>
            @error('courier') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </select>
    </div>
    
        {{-- <button wire.click="chekOngkir" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button> --}}
        <button 
        type="submit" 
        class="text-white mt-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 
        @if (!$fromProvince || !$fromCity || !$toProvince || !$toCity ) 
            cursor-not-allowed 
        @endif"
        @if (!$fromProvince || !$fromCity || !$toProvince || !$toCity )
            disabled
        @endif
        >
            Submit
        </button>
        <p wire:loading >loading</p>
      </form>
    
        @if ($costResult)
            <div class="mt-4">
                <h2 class="text-lg font-medium text-gray-900 dark:text-white">Pilih Layanan:</h2>
                <ul>
                    @foreach ($costResult['rajaongkir']['results'] as $item)
                        {{-- <li>Kode: {{ $item['code'] }}</li>
                        <li>Nama Perusahaan: {{ $item['name'] }}</li> --}}
                        <ul>
                            @foreach ($item['costs'] as $cost)
                                @foreach ($cost['cost'] as $detail)
                                    <div class="flex items-start ps-4 py-2 border border-gray-200 rounded dark:border-gray-700 mb-2">
                                        <input id="bordered-radio-{{ $cost['service'] }}" type="radio" value="{{ $cost['service'] }}" name="bordered-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mt-1"
                                            wire:click="$set('selectedShippingService', '{{ $cost['service'] }}'); $set('selectedShippingPrice', '{{ $detail['value'] }}');">
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
