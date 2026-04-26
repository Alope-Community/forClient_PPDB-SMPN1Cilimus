<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // 🔥 VALIDASI
        $validated = $request->validate([
            // DATA UTAMA
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|digits:10',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'umur' => 'required|integer|min:12|max:18',
            'asal_sekolah' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'email' => 'nullable|email',
            'no_hp' => 'nullable|string',
            'jalur_pendaftaran' => 'required',

            // DOKUMEN WAJIB
            'ijazah_skl' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'akta_kelahiran' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'ktp_orang_tua' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sptjm' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'ijazah_madrasah' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // 🔥 TAMBAHAN VALIDASI BERDASARKAN JALUR
        switch ($request->jalur_pendaftaran) {
            case 'zonasi':
                $request->validate([
                    'latitude' => 'required',
                    'longitude' => 'required',
                    'screenshot_jarak' => 'required|image|max:2048'
                ]);
                break;

            case 'afirmasi':
                $request->validate([
                    'kartu_bansos_sktm' => 'required|file|max:2048',
                    'surat_tanggung_jawab' => 'required|file|max:2048',
                ]);
                break;

            case 'prestasi':
                $request->validate([
                    'rapor_5_semester' => 'required|file|max:2048',
                    'surat_peringkat' => 'required|file|max:2048',
                    'sertifikat_piagam.*' => 'required|file|max:2048',
                ]);
                break;

            case 'perpindahan':
                $request->validate([
                    'surat_pindah_tugas' => 'required|file|max:2048',
                ]);
                break;
        }

        // 🔥 GENERATE NO PENDAFTARAN
        $no_pendaftaran = 'PPDB-' . strtoupper(Str::random(6));

        // 🔥 FUNGSI SIMPAN FILE
        function uploadFile($file, $folder)
        {
            if (!$file) return null;

            $name = time() . '_' . $file->getClientOriginalName();
            return $file->storeAs($folder, $name, 'public');
        }

        // 🔥 UPLOAD FILE WAJIB
        $files = [
            'ijazah_skl' => uploadFile($request->file('ijazah_skl'), 'ppdb/ijazah'),
            'akta_kelahiran' => uploadFile($request->file('akta_kelahiran'), 'ppdb/akta'),
            'kartu_keluarga' => uploadFile($request->file('kartu_keluarga'), 'ppdb/kk'),
            'ktp_orang_tua' => uploadFile($request->file('ktp_orang_tua'), 'ppdb/ktp'),
            'sptjm' => uploadFile($request->file('sptjm'), 'ppdb/sptjm'),
            'ijazah_madrasah' => uploadFile($request->file('ijazah_madrasah'), 'ppdb/madrasah'),
        ];

        // 🔥 FILE JALUR
        $jalurFiles = [];

        if ($request->jalur_pendaftaran == 'zonasi') {
            $jalurFiles['screenshot_jarak'] = uploadFile($request->file('screenshot_jarak'), 'ppdb/zonasi');
        }

        if ($request->jalur_pendaftaran == 'afirmasi') {
            $jalurFiles['kartu_bansos_sktm'] = uploadFile($request->file('kartu_bansos_sktm'), 'ppdb/afirmasi');
            $jalurFiles['surat_tanggung_jawab'] = uploadFile($request->file('surat_tanggung_jawab'), 'ppdb/afirmasi');
        }

        if ($request->jalur_pendaftaran == 'prestasi') {
            $jalurFiles['rapor'] = uploadFile($request->file('rapor_5_semester'), 'ppdb/prestasi');
            $jalurFiles['peringkat'] = uploadFile($request->file('surat_peringkat'), 'ppdb/prestasi');

            if ($request->hasFile('sertifikat_piagam')) {
                foreach ($request->file('sertifikat_piagam') as $file) {
                    $jalurFiles['sertifikat'][] = uploadFile($file, 'ppdb/prestasi');
                }
            }
        }

        if ($request->jalur_pendaftaran == 'perpindahan') {
            $jalurFiles['surat_pindah'] = uploadFile($request->file('surat_pindah_tugas'), 'ppdb/perpindahan');
        }

        // 🔥 SIMPAN KE DATABASE
        $data = [
            'no_pendaftaran' => $no_pendaftaran,
            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'asal_sekolah' => $request->asal_sekolah,
            'alamat_lengkap' => $request->alamat_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'jalur_pendaftaran' => $request->jalur_pendaftaran,

            // lokasi zonasi
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,

            // file
            'files' => json_encode($files),
            'jalur_files' => json_encode($jalurFiles),
        ];

        // contoh pakai model
        Pendaftaran::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil',
            'no_pendaftaran' => $no_pendaftaran
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
