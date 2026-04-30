<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $pendaftaran = Pendaftaran::where('user_id', Auth::id())->first();

        return view('siswa.dashboard', compact('pendaftaran'));
    }
}
