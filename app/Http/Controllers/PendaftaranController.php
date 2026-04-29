<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('siswa.pendaftaran');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'asal_sd_mi' => 'required|string|max:255',
            'jalur_pendaftaran' => 'required|in:domisili,afirmasi,prestasi_akademik,prestasi_non_akademik,mutasi',
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nisn' => 'required|string|size:10|unique:pendaftaran,nisn',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Budha,Konghucu',
            'alamat_lengkap' => 'required|string|max:500',
            'titik_koordinat' => 'required|string|max:50',
            'jarak_rumah' => 'required|numeric|min:0|max:50000',
            'no_hp_siswa' => 'required|string|regex:/^08[0-9]{8,12}$/',
            'tinggi_badan' => 'required|numeric|min:100|max:200',
            'berat_badan' => 'required|numeric|min:20|max:100',
            'lingkar_kepala' => 'required|numeric|min:40|max:60',
            'anak_ke' => 'required|integer|min:1|max:20',
            'jumlah_saudara' => 'required|integer|min:0|max:20',
            'memiliki_kip' => 'required|in:Ya,Tidak',
            'nilai_bindo' => 'required|numeric|min:0|max:1000',
            'nilai_matematika' => 'required|numeric|min:0|max:1000',
            'nilai_ipa' => 'required|numeric|min:0|max:1000',
            'jumlah_nilai' => 'required|numeric|min:0|max:3000',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'no_hp_orang_tua' => 'required|string|regex:/^08[0-9]{8,12}$/',
            
            // Dokumen (max 2MB)
            'kartu_keluarga' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'screenshot_jarak' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'kartu_kip' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'sertifikat_kejuaraan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            
            // Prestasi (khusus jalur tertentu)
            'event_kejuaraan' => 'nullable|required_if:jalur_pendaftaran,prestasi_non_akademik|string|max:255',
            'tingkat_kejuaraan' => 'nullable|required_if:jalur_pendaftaran,prestasi_non_akademik|string|max:50',
            'peringkat' => 'nullable|required_if:jalur_pendaftaran,prestasi_non_akademik|string|max:50',
        ], [
            'nisn.unique' => '❌ NISN sudah terdaftar! Gunakan NISN lain.',
            'no_hp_siswa.regex' => '❌ No. HP harus format 08xxxxxxxxxx',
            'no_hp_orang_tua.regex' => '❌ No. HP Orang Tua harus format 08xxxxxxxxxx',
            'kartu_keluarga.required' => '❌ Upload Kartu Keluarga WAJIB!',
            'screenshot_jarak.required' => '❌ Screenshot jarak Google Maps WAJIB!',
            'kartu_keluarga.file' => '❌ File KK harus PDF/JPG/PNG (max 2MB)',
            'jumlah_nilai.max' => '❌ Jumlah nilai maksimal 3000!',
            'nisn.size' => '❌ NISN harus 10 digit angka!',
            'tanggal_lahir.date' => '❌ Format tanggal lahir salah!',
        ]);

        // 🔥 ALERT VALIDASI - KUMPULKAN SEMUA ERROR
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = "❌ **VALIDASI GAGAL**:\n\n";
            
            // Grup error berdasarkan kategori
            $errorGroups = [
                'Dokumen' => [],
                'Data Pribadi' => [],
                'Nilai Raport' => [],
                'Orang Tua' => [],
                'Lainnya' => []
            ];
            
            foreach ($errors as $error) {
                if (stripos($error, 'kartu') !== false || stripos($error, 'screenshot') !== false || stripos($error, 'file') !== false) {
                    $errorGroups['Dokumen'][] = $error;
                } elseif (stripos($error, 'nisn') !== false || stripos($error, 'tanggal') !== false || stripos($error, 'nama') !== false) {
                    $errorGroups['Data Pribadi'][] = $error;
                } elseif (stripos($error, 'nilai') !== false || stripos($error, 'jumlah') !== false) {
                    $errorGroups['Nilai Raport'][] = $error;
                } elseif (stripos($error, 'ayah') !== false || stripos($error, 'ibu') !== false || stripos($error, 'orang tua') !== false) {
                    $errorGroups['Orang Tua'][] = $error;
                } else {
                    $errorGroups['Lainnya'][] = $error;
                }
            }
            
            // Buat pesan alert yang rapi
            foreach ($errorGroups as $kategori => $errList) {
                if (!empty($errList)) {
                    $errorMessage .= "📁 **$kategori**:\n" . implode("\n", $errList) . "\n\n";
                }
            }
            
            return response()->json([
                'success' => false,
                'message' => $errorMessage,
                'errors' => $errors,
                'alert_type' => 'error'
            ], 422);
        }

        // 🔥 VALIDASI KOORDINAT GPS
        $koordinat = array_map('trim', explode(',', $request->titik_koordinat));
        if (count($koordinat) !== 2 || !is_numeric($koordinat[0]) || !is_numeric($koordinat[1])) {
            return response()->json([
                'success' => false,
                'message' => '❌ **Koordinat GPS salah!**\n\nContoh benar:\n`-6.873307,108.494803`\n\n(Tanpa spasi setelah koma)',
                'alert_type' => 'error'
            ], 422);
        }

        // 🔥 VALIDASI PENJUMLAHAN NILAI
        $totalManual = (float) $request->jumlah_nilai;
        $totalAuto = (float) $request->nilai_bindo + (float) $request->nilai_matematika + (float) $request->nilai_ipa;
        
        if (abs($totalManual - $totalAuto) > 0.01) {
            return response()->json([
                'success' => false,
                'message' => "❌ **Penjumlahan nilai salah!**\n\n" .
                            "Manual: {$totalManual}\n" .
                            "Otomatis: {$totalAuto}\n\n" .
                            "Periksa kembali nilai B.Indonesia + Matematika + IPA",
                'alert_type' => 'error'
            ], 422);
        }

        // 🔥 VALIDASI JALUR PRESTASI
        if ($request->jalur_pendaftaran === 'prestasi_non_akademik') {
            $prestasiRequired = ['event_kejuaraan', 'tingkat_kejuaraan', 'peringkat'];
            foreach ($prestasiRequired as $field) {
                if (empty($request->$field)) {
                    return response()->json([
                        'success' => false,
                        'message' => '❌ **Jalur Prestasi Non Akademik**:\nSemua data prestasi (Event, Tingkat, Peringkat) WAJIB diisi!',
                        'alert_type' => 'error'
                    ], 422);
                }
            }
        }

        DB::beginTransaction();
        try {
            // Generate UUID unik
            $uuid = 'SMP1CIL-' . strtoupper(Str::random(6));

            // Upload dokumen
            $dokumen = $this->uploadDokumen($request);

            // Simpan data pendaftaran
            $pendaftaran = Pendaftaran::create([
                'uuid' => $uuid,

                // IDENTITAS
                'asal_sd_mi' => $request->asal_sd_mi,
                'jalur_pendaftaran' => $request->jalur_pendaftaran,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'nisn' => $request->nisn,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'pernah_paud' => $request->has('pernah_paud'),
                'pernah_tk' => $request->has('pernah_tk'),
                'tidak_pernah_paud_tk' => $request->has('tidak_pernah'),
                'hobby' => $request->hobby,
                'cita_cita' => $request->cita_cita,
                'tinggi_badan' => $request->tinggi_badan,
                'berat_badan' => $request->berat_badan,
                'lingkar_kepala' => $request->lingkar_kepala,
                'anak_ke' => $request->anak_ke,
                'jumlah_saudara' => $request->jumlah_saudara,
                'memiliki_kip' => $request->memiliki_kip,

                // ALAMAT
                'agama' => $request->agama,
                'alamat_lengkap' => $request->alamat_lengkap,
                'titik_koordinat' => $request->titik_koordinat,
                'jarak_rumah' => $request->jarak_rumah,
                'no_hp_siswa' => $request->no_hp_siswa,
                'email_siswa' => $request->email_siswa,
                'sosmed' => json_encode($request->sosmed),

                // DOKUMEN
                'kartu_kip' => $dokumen['kartu_kip'] ?? null,
                'screenshot_jarak' => $dokumen['screenshot_jarak'] ?? null,
                'kartu_keluarga' => $dokumen['kartu_keluarga'] ?? null,

                // NILAI
                'nilai_bindo' => $request->nilai_bindo,
                'nilai_matematika' => $request->nilai_matematika,
                'nilai_ipa' => $request->nilai_ipa,
                'jumlah_nilai' => $request->jumlah_nilai,

                // PRESTASI (🔥 pakai nama baru!)
                'event_kejuaraan' => $request->event_kejuaraan,
                'tingkat_kejuaraan' => $request->tingkat_kejuaraan,
                'peringkat_kejuaraan' => $request->peringkat_kejuaraan,
                'penyelenggara' => $request->penyelenggara,
                'sertifikat_kejuaraan' => $dokumen['sertifikat_kejuaraan'] ?? null,

                // ORANG TUA
                'nama_ayah' => $request->nama_ayah,
                'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
                'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
                'agama_ayah' => $request->agama_ayah,
                'pekerjaan_ayah' => $request->pekerjaan_ayah,
                'pendidikan_ayah' => $request->pendidikan_ayah,

                'nama_ibu' => $request->nama_ibu,
                'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
                'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
                'pekerjaan_ibu' => $request->pekerjaan_ibu,
                'pendidikan_ibu' => $request->pendidikan_ibu,

                'alamat_orang_tua' => $request->alamat_orang_tua,
                'no_hp_orang_tua' => $request->no_hp_orang_tua,
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "🎉 **PENDAFTARAN BERHASIL!**\n\n" .
                            "No. Pendaftaran: **{$uuid}**\n" .
                            "Nama: {$request->nama_lengkap}\n" .
                            "NISN: {$request->nisn}\n\n" .
                            "✅ Simpan nomor ini untuk tracking!\n" .
                            "📧 Cek email untuk konfirmasi.",
                'data' => [
                    'no_pendaftaran' => $uuid,
                    'nama' => $request->nama_lengkap,
                    'nisn' => $request->nisn,
                ],
                'alert_type' => 'success'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('PPDB Store Error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => '❌ **Sistem Error!**\n\nMohon coba lagi atau hubungi admin.',
                'alert_type' => 'error'
            ], 500);
        }
    }

    private function uploadDokumen(Request $request)
    {
        $dokumen = [];
        $path = 'ppdb/smpn1-cilimus/' . date('Y/m/d');

        if ($request->hasFile('kartu_keluarga')) {
            $dokumen['kartu_keluarga'] = $request->file('kartu_keluarga')
                ->store($path, 'public');
        }

        if ($request->hasFile('screenshot_jarak')) {
            $dokumen['screenshot_jarak'] = $request->file('screenshot_jarak')
                ->store($path, 'public');
        }

        if ($request->hasFile('kartu_kip')) {
            $dokumen['kartu_kip'] = $request->file('kartu_kip')
                ->store($path, 'public');
        }

        if ($request->hasFile('sertifikat_kejuaraan')) {
            $dokumen['sertifikat_kejuaraan'] = $request->file('sertifikat_kejuaraan')
                ->store($path, 'public');
        }

        return $dokumen;
    }

    private function kirimEmailKonfirmasi($pendaftaran, $uuid)
    {
        // Implementasi email menggunakan Mail facade
        // Mail::to($pendaftaran->email_siswa)->send(new PendaftaranKonfirmasi($pendaftaran, $uuid));
    }
}