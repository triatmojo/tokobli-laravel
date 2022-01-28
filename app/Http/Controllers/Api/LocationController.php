<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

use App\Models\City;
use App\Models\Province;
use App\Models\Regency;
use Kavist\RajaOngkir\Resources\OngkosKirim;

class LocationController extends Controller
{
    public function Provinces()
    {
        return Province::all();
    }

    public function Regencies(Request $request, $provinces_id)
    {
        return Regency::where('province_id', $provinces_id)->get();
    }

    public function City($province_id)
    {
        return City::where('province_id', $province_id)->get();
    }

    public function City_ID($city_id)
    {
        return City::find($city_id);
    }

    public function checkOngkir(Request $request)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin' => 67,
            'destination' => $request->city_destination,
            'weight' => 100,
            'courier' => $request->courier
        ])->get();

        return response()->json([
            'success' => true,
            'message' => 'List Data Cost All Courir: ' . $request->courier,
            'data' => $cost
        ]);
    }
}
