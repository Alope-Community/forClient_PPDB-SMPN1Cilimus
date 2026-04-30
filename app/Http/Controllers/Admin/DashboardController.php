<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('admin.dashboard', [
            'total' => Pendaftaran::count(),
            'domisili' => Pendaftaran::where('jalur_pendaftaran', 'domisili')->count(),
            'prestasi' => Pendaftaran::whereIn('jalur_pendaftaran', ['prestasi_akademik','prestasi_non_akademik'])->count(),
            'afirmasi' => Pendaftaran::where('jalur_pendaftaran', 'afirmasi')->count(),
            'pendaftarTerbaru' => Pendaftaran::latest()->limit(5)->get(),
        ]);
    }
}
