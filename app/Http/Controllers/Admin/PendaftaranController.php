<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $pendaftar = Pendaftaran::when($search, function ($query) use ($search) {
            $query->where('nama_lengkap', 'like', "%$search%")
                ->orWhere('nisn', 'like', "%$search%");
        })
        ->latest()
        ->paginate(10);

        return view('admin.pendaftar', compact('pendaftar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        return view('admin.pendaftar-detail', compact('pendaftaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:draft,pending,approved,rejected,waiting_list'
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);

        $pendaftaran->status = $request->status;

        // optional tracking
        if ($request->status == 'approved') {
            $pendaftaran->approved_at = now();
        }

        $pendaftaran->verified_at = now();
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
