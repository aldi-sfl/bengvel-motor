<?php

namespace App\Http\Livewire\UserPage\Transaction;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Client\ConnectionException;

class CheckOngkir extends Component
{
    public $transaction;
    public $fromCities = [];
    public $toCities = [];
    public $provinces = [];
    public $fromCity;
    public $toCity;
    public $fromProvince;
    public $toProvince;
    public $weight;
    public $courier;
    public $costResult;
    public $selectedShippingService;
    public $selectedShippingPrice;

    // SUDAH TIDAK DIPAKAI===============================================================================================================================
    public function mount()
    {
        try {
            $responseProvince = Http::withHeaders([
                'key' => '71e98a0e50be17a8751721d1d0f95ba4'
            ])->timeout(10)->get('https://api.rajaongkir.com/starter/province');

            if ($responseProvince->successful()) {
                $this->provinces = $responseProvince['rajaongkir']['results'];

                // Set fromProvince to the value at index 9
                if (isset($this->provinces[9])) {
                    $this->fromProvince = $this->provinces[9]['province_id'];
                }

                // Fetch cities for the selected province
                $this->updatedFromProvince($this->fromProvince);

                // Set fromCity to the value at index 1 (after fetching cities)
                if (isset($this->fromCities[1])) {
                    $this->fromCity = $this->fromCities[1]['city_id'];
                }
            } else {
                $this->handleFailedRequest('Failed to fetch provinces. Please try again later.');
            }
        } catch (ConnectionException $e) {
            $this->handleFailedRequest('Connection error: ' . $e->getMessage());
        } catch (RequestException $e) {
            $this->handleFailedRequest('Request error: ' . $e->getMessage());
        } catch (\Exception $e) {
            $this->handleFailedRequest('An unexpected error occurred: ' . $e->getMessage());
        }
    }

    private function handleFailedRequest($errorMessage)
    {
        // Log the error or handle it according to your application's needs
        // For now, we just set a default value or show an error message
        $this->provinces = [];
        $this->fromProvince = null;
        $this->fromCities = [];
        $this->fromCity = null;

        // Optionally, set an error message to be displayed in the UI
        session()->flash('error', $errorMessage);
    }

    public function updatedFromProvince($value)
    {
        if ($value) {
            $responseCity = Http::withHeaders([
                'key' => '71e98a0e50be17a8751721d1d0f95ba4'
            ])->get('https://api.rajaongkir.com/starter/city', [
                'province' => $value
            ]);

            if ($responseCity->successful()) {
                $this->fromCities = $responseCity['rajaongkir']['results'];
                // Reset fromCity if the province changes
                $this->fromCity = $this->fromCities[1]['city_id'] ?? null;
            }
        } else {
            $this->fromCities = [];
            $this->fromCity = null;
        }
    }

    public function updatedtoProvince($value)
    {
        if ($value) {
            $responseCity = Http::withHeaders([
                'key' => '71e98a0e50be17a8751721d1d0f95ba4'
            ])->get('https://api.rajaongkir.com/starter/city', [
                'province' => $value
            ]);

            if ($responseCity->successful()) {
                $this->toCities = $responseCity['rajaongkir']['results'];
            }
        } else {
            $this->toCities = [];
        }
    }

    public function check()
    {
        $this->validate([
            'fromProvince' => 'required|not_in:Pilih Provinsi',
            'fromCity' => 'required|not_in:Pilih Kota Asal',
            'toProvince' => 'required|not_in:Pilih Provinsi',
            'toCity' => 'required|not_in:Pilih Kota Asal',
            'weight' => 'required|numeric|min:1',
            'courier' => 'required|not_in:Pilih Kurir',
        ]);
        
        $responseCost = Http::withHeaders([
            'key' => '71e98a0e50be17a8751721d1d0f95ba4'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $this->fromCity,
            'destination' => $this->toCity,
            'weight' => $this->weight,
            'courier' => $this->courier,
        ]);

        $this->costResult = $responseCost->json();
        // dd($this->costResult);
    }

    public function render()
    {
        return view('livewire.user-page.transaction.check-ongkir');
    }
}
