<?php

namespace App\Http\Controllers;

use App\Models\Geolocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeolocationController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'alamat_lengkap' => 'required|string|min:10',
        ]);

        $alamat = $request->input('alamat_lengkap');

        $pattern = '/(?:Desa|Ds\.?)\s+([^,.\n]+).*?(?:Kec\.?|Kecamatan)\s+([^,.\n]+).*?(?:Kab\.?|Kabupaten)\s+([^,.\n\d]+)/i';

        $village = null;
        $subdistrict = null;
        $district = null;

        if (preg_match($pattern, $alamat, $matches)) {
            $village     = trim($matches[1]);
            $subdistrict = trim($matches[2]);
            $district    = trim($matches[3]);
        }

        if (!$village && !$subdistrict && !$district) {
            return response()->json([
                'success' => false,
                'message' => 'Format alamat tidak mengenali nama Desa, Kecamatan, atau Kabupaten.',
            ], 422);
        }

        $query = Geolocation::select('id', 'village', 'subdistrict', 'district', 'longitude', 'latitude');

        if ($village) {
            $query->where('village', 'LIKE', "%{$village}%");
        }
        if ($subdistrict) {
            $query->where('subdistrict', 'LIKE', "%{$subdistrict}%");
        }
        if ($district) {
            $query->where('district', 'LIKE', "%{$district}%");
        }

        $locations = $query->limit(5)->get();

        return response()->json([
            'success'   => true,
            'extracted' => [
                'village'     => $village,
                'subdistrict' => $subdistrict,
                'district'    => $district
            ],
            'data'      => $locations
        ], 200);
    }
}