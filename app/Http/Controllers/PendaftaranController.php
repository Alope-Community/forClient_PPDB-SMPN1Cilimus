<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\User;
use App\Services\LzwService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

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
            'nisn.unique' => ' NISN sudah terdaftar! Gunakan NISN lain.',
            'no_hp_siswa.regex' => ' No. HP harus format 08xxxxxxxxxx',
            'no_hp_orang_tua.regex' => ' No. HP Orang Tua harus format 08xxxxxxxxxx',
            'kartu_keluarga.required' => ' Upload Kartu Keluarga WAJIB!',
            'screenshot_jarak.required' => ' Screenshot jarak Google Maps WAJIB!',
            'kartu_keluarga.file' => ' File KK harus PDF/JPG/PNG (max 2MB)',
            'jumlah_nilai.max' => ' Jumlah nilai maksimal 3000!',
            'nisn.size' => ' NISN harus 10 digit angka!',
            'tanggal_lahir.date' => ' Format tanggal lahir salah!',
        ]);

        // ALERT VALIDASI
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $errorMessage = "❌ VALIDASI GAGAL: ";
            
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
            
            foreach ($errorGroups as $kategori => $errList) {
                if (!empty($errList)) {
                    $errorMessage .= "$kategori:\n" . implode("\n", $errList) . "\n\n";
                }
            }
            
            return response()->json([
                'success' => false,
                'message' => $errorMessage,
                'errors' => $errors,
                'alert_type' => 'error'
            ], 422);
        }

        // VALIDASI KOORDINAT GPS
        $koordinat = array_map('trim', explode(',', $request->titik_koordinat));
        if (count($koordinat) !== 2 || !is_numeric($koordinat[0]) || !is_numeric($koordinat[1])) {
            return response()->json([
                'success' => false,
                'message' => '❌ Koordinat GPS salah!',
                'alert_type' => 'error'
            ], 422);
        }

        // VALIDASI PENJUMLAHAN NILAI
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

        // VALIDASI JALUR PRESTASI
        if ($request->jalur_pendaftaran === 'prestasi_non_akademik') {
            $prestasiRequired = ['event_kejuaraan', 'tingkat_kejuaraan', 'peringkat'];
            foreach ($prestasiRequired as $field) {
                if (empty($request->$field)) {
                    return response()->json([
                        'success' => false,
                        'message' => '❌ Jalur Prestasi Non Akademik: Semua data prestasi (Event, Tingkat, Peringkat) WAJIB diisi!',
                        'alert_type' => 'error'
                    ], 422);
                }
            }
        }

        DB::beginTransaction();
        try {

            $tanggal = Carbon::parse($request->tanggal_lahir)->format('dmY');
            $password = $request->tempat_lahir . $tanggal;

            $user = User::create([
                "name" => $request->nama_lengkap,
                "username" => $request->nisn,
                "password" => Hash::make($password),
            ]);

            // Generate UUID unik
            $uuid = 'SMP1CIL-' . strtoupper(Str::random(6));

            // Upload dokumen
            $dokumen = $this->uploadDokumen($request);

            // Simpan data pendaftaran
            Pendaftaran::create([
                'uuid' => $uuid,
                'user_id' => $user->id,

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

                // PRESTASI
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
                'message' => "🎉 PENDAFTARAN BERHASIL!",
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
                'message' => '❌ Sistem Error! Mohon coba lagi atau hubungi admin.',
                'alert_type' => 'error'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);

        $request->validate([
            'email_siswa' => 'nullable|email',
            'nilai_bindo' => 'nullable|numeric',
            'nilai_matematika' => 'nullable|numeric',
            'nilai_ipa' => 'nullable|numeric',
        ]);

        $data = $request->except([
            'kartu_keluarga',
            'kartu_kip',
            'screenshot_jarak',
            'sertifikat_kejuaraan'
        ]);

        $data['pernah_paud'] = $request->has('pernah_paud') ? 1 : 0;
        $data['pernah_tk'] = $request->has('pernah_tk') ? 1 : 0;
        $data['tidak_pernah'] = $request->has('tidak_pernah') ? 1 : 0;

        $data['sosmed'] = json_encode($request->sosmed ?? []);

        $data['jumlah_nilai'] =
            ($request->nilai_bindo ?? 0) +
            ($request->nilai_matematika ?? 0) +
            ($request->nilai_ipa ?? 0);

        if (!in_array($request->jalur_pendaftaran, ['prestasi_akademik', 'prestasi_non_akademik'])) {
            $data['event_kejuaraan'] = null;
            $data['tingkat_kejuaraan'] = null;
            $data['peringkat'] = null;
            $data['penyelenggara'] = null;
            $data['sertifikat_kejuaraan'] = null;
        }

        $dokumenBaru = $this->uploadDokumen($request);

        foreach ($dokumenBaru as $key => $fileBaru) {

            if ($pendaftaran->$key && Storage::disk('public')->exists($pendaftaran->$key)) {
                Storage::disk('public')->delete($pendaftaran->$key);
            }

            $data[$key] = $fileBaru;
        }

        $pendaftaran->update($data);

        return back()->with('success', 'Data berhasil diperbarui');
    }


    // private function uploadDokumen(Request $request)
    // {
    //     $lzw = new \App\Services\LzwService(); // pakai service

    //     $dokumen = []; // pastikan selalu array
    //     $path = 'ppdb/smpn1-cilimus/' . date('Y/m/d');

    //     $handleLZW = function ($file, $path) use ($lzw) {

    //         $content = file_get_contents($file->getRealPath());

    //         // pakai service
    //         $compressed = $lzw->compress($content);

    //         $filename = uniqid() . '.lzw';

    //         $fullPath = storage_path('app/public/' . $path . '/' . $filename);

    //         if (!file_exists(dirname($fullPath))) {
    //             mkdir(dirname($fullPath), 0777, true);
    //         }

    //         file_put_contents($fullPath, $compressed);

    //         return $path . '/' . $filename;
    //     };

    //     if ($request->hasFile('kartu_keluarga')) {
    //         $dokumen['kartu_keluarga'] = $handleLZW($request->file('kartu_keluarga'), $path);
    //     }

    //     if ($request->hasFile('screenshot_jarak')) {
    //         $dokumen['screenshot_jarak'] = $handleLZW($request->file('screenshot_jarak'), $path);
    //     }

    //     if ($request->hasFile('kartu_kip')) {
    //         $dokumen['kartu_kip'] = $handleLZW($request->file('kartu_kip'), $path);
    //     }

    //     if ($request->hasFile('sertifikat_kejuaraan')) {
    //         $dokumen['sertifikat_kejuaraan'] = $handleLZW($request->file('sertifikat_kejuaraan'), $path);
    //     }

    //     return $dokumen; 
    // }

    // private function uploadDokumen(Request $request)
    // {
    //     $dokumen = [];
    //     $path = 'ppdb/smpn1-cilimus/' . date('Y/m/d');

    //     $saveFile = function ($file, $path) {

    //         $ext = strtolower($file->getClientOriginalExtension());
    //         $fullPath = storage_path('app/public/' . $path);

    //         if (!file_exists($fullPath)) {
    //             mkdir($fullPath, 0777, true);
    //         }

    //         $size = $file->getSize(); // ukuran byte
    //         $filename = uniqid();

    //         // =========================
    //         // FILE KECIL → SIMPAN ASLI
    //         // =========================
    //         if ($size < 300000) { // < 300KB
    //             $name = $filename . '.' . $ext;
    //             $file->move($fullPath, $name);
    //             return $path . '/' . $name;
    //         }

    //         // =========================
    //         // GAMBAR → SMART COMPRESS
    //         // =========================
    //         if (in_array($ext, ['jpg', 'jpeg', 'png'])) {

    //             $image = Image::make($file);

    //             // resize hanya jika lebih besar dari 1200px
    //             if ($image->width() > 1200) {
    //                 $image->resize(1200, null, function ($constraint) {
    //                     $constraint->aspectRatio();
    //                     $constraint->upsize();
    //                 });
    //             }

    //             // =========================
    //             // PNG → tetap PNG
    //             // =========================
    //             if ($ext === 'png') {
    //                 $name = $filename . '.png';
    //                 $image->encode('png', 80);
    //             } else {
    //                 // =========================
    //                 // JPG → compress JPG
    //                 // =========================
    //                 $name = $filename . '.jpg';
    //                 $image->encode('jpg', 75);
    //             }

    //             file_put_contents($fullPath . '/' . $name, $image);

    //             return $path . '/' . $name;
    //         }

    //         // =========================
    //         // FILE NON GAMBAR
    //         // =========================
    //         $name = $filename . '.' . $ext;
    //         $file->move($fullPath, $name);

    //         return $path . '/' . $name;
    //     };

    //     // =========================
    //     // HANDLE UPLOAD
    //     // =========================

    //     if ($request->hasFile('kartu_keluarga')) {
    //         $dokumen['kartu_keluarga'] = $saveFile($request->file('kartu_keluarga'), $path);
    //     }

    //     if ($request->hasFile('screenshot_jarak')) {
    //         $dokumen['screenshot_jarak'] = $saveFile($request->file('screenshot_jarak'), $path);
    //     }

    //     if ($request->hasFile('kartu_kip')) {
    //         $dokumen['kartu_kip'] = $saveFile($request->file('kartu_kip'), $path);
    //     }

    //     if ($request->hasFile('sertifikat_kejuaraan')) {
    //         $dokumen['sertifikat_kejuaraan'] = $saveFile($request->file('sertifikat_kejuaraan'), $path);
    //     }

    //     return $dokumen;
    // }

    private function uploadDokumen(Request $request)
    {
        $dokumen = [];
        $path = 'ppdb/smpn1-cilimus/' . date('Y/m/d');

        $lzw = new LzwService();

        $saveFile = function ($file, $path) use ($lzw) {

            $ext = strtolower($file->getClientOriginalExtension());
            $fullPath = storage_path('app/public/' . $path);

            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0777, true);
            }

            $size = $file->getSize();
            $filename = uniqid();

            if (in_array($ext, ['jpg', 'jpeg', 'png'])) {

                $image = Image::make($file);

                if ($image->width() > 1200) {
                    $image->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                // encode sesuai format
                if ($ext === 'png') {
                    $binary = (string) $image->encode('png', 80);
                    $realExt = 'png';
                } else {
                    $binary = (string) $image->encode('jpg', 75);
                    $realExt = 'jpg';
                }

                // =========================
                // LZW COMPRESS
                // =========================
                $compressed = $lzw->compress($binary);

                $name = $filename . '.' . $realExt . '.lzw';

                file_put_contents($fullPath . '/' . $name, $compressed);

                return $path . '/' . $name;
            }

            $content = file_get_contents($file->getRealPath());
            $compressed = $lzw->compress($content);

            $name = $filename . '.' . $ext . '.lzw';

            file_put_contents($fullPath . '/' . $name, $compressed);

            return $path . '/' . $name;
        };

        if ($request->hasFile('kartu_keluarga')) {
            $dokumen['kartu_keluarga'] = $saveFile($request->file('kartu_keluarga'), $path);
        }

        if ($request->hasFile('screenshot_jarak')) {
            $dokumen['screenshot_jarak'] = $saveFile($request->file('screenshot_jarak'), $path);
        }

        if ($request->hasFile('kartu_kip')) {
            $dokumen['kartu_kip'] = $saveFile($request->file('kartu_kip'), $path);
        }

        if ($request->hasFile('sertifikat_kejuaraan')) {
            $dokumen['sertifikat_kejuaraan'] = $saveFile($request->file('sertifikat_kejuaraan'), $path);
        }

        return $dokumen;
    }

    // public function showImage($path)
    // {
    //     $path = urldecode($path);

    //     $fullPath = storage_path('app/public/' . $path);

    //     // cek file ada atau tidak
    //     if (!file_exists($fullPath)) {
    //         abort(404, 'File tidak ditemukan');
    //     }

    //     // ambil file hasil kompresi LZW
    //     $compressed = file_get_contents($fullPath);

    //     // decompress
    //     $lzw = new LzwService();
    //     $binary = $lzw->decompress($compressed);

    //     // ambil ekstensi ASLI (dari nama sebelum .lzw)
    //     $filename = pathinfo($path, PATHINFO_FILENAME); 
    //     $ext = pathinfo($filename, PATHINFO_EXTENSION);

    //     if (!$ext) {
    //         $ext = 'jpg';
    //     }

    //     $mime = match (strtolower($ext)) {
    //         'png' => 'image/png',
    //         'jpg', 'jpeg' => 'image/jpeg',
    //         default => 'image/jpeg'
    //     };

    //     return response($binary)
    //         ->header('Content-Type', $mime)
    //         ->header('Content-Disposition', 'inline; filename="preview.' . $ext . '"');
    // }

//     public function showImage($path)
// {
//     $path = urldecode($path);
//     $fullPath = storage_path('app/public/' . $path);

//     if (!file_exists($fullPath)) {
//         abort(404, 'File tidak ditemukan');
//     }

//     $mime = mime_content_type($fullPath);

//     return response()->file($fullPath, [
//         'Content-Type' => $mime,
//         'Content-Disposition' => 'inline; filename="' . basename($fullPath) . '"'
//     ]);
// }

    // private function lzwDecompress($compressed)
    // {
    //     $compressed = json_decode($compressed, true);

    //     $dictionary = [];
    //     $dictSize = 256;

    //     for ($i = 0; $i < 256; $i++) {
    //         $dictionary[$i] = chr($i);
    //     }

    //     $w = chr($compressed[0]);
    //     $result = $w;

    //     for ($i = 1; $i < count($compressed); $i++) {
    //         $k = $compressed[$i];

    //         if (isset($dictionary[$k])) {
    //             $entry = $dictionary[$k];
    //         } elseif ($k == $dictSize) {
    //             $entry = $w . $w[0];
    //         } else {
    //             throw new \Exception("Bad compressed k: $k");
    //         }

    //         $result .= $entry;
    //         $dictionary[$dictSize++] = $w . $entry[0];
    //         $w = $entry;
    //     }

    //     return $result;
    // }

    public function showImage($path)
    {
        $path = urldecode($path);
        $fullPath = storage_path('app/public/' . $path);

        if (!file_exists($fullPath)) {
            abort(404, 'File tidak ditemukan');
        }

        $compressed = file_get_contents($fullPath);

        $lzw = new \App\Services\LzwService();
        $binary = $lzw->decompress($compressed);

        $filename = pathinfo($path, PATHINFO_FILENAME);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $mime = match (strtolower($ext)) {
            'png' => 'image/png',
            'jpg', 'jpeg' => 'image/jpeg',
            'pdf' => 'application/pdf',
            default => 'application/octet-stream'
        };

        return response($binary)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'inline; filename="preview.' . $ext . '"');
    }

    // private function uploadDokumen(Request $request)
    // {
    //     $dokumen = [];
    //     $path = 'ppdb/smpn1-cilimus/' . date('Y/m/d');

    //     $handleLZW = function ($file, $path) {

    //         // ambil binary file asli
    //         $content = file_get_contents($file->getRealPath());

    //         // compress LZW
    //         $compressed = $this->lzwCompress($content);

    //         // nama file .lzw
    //         $filename = uniqid() . '.lzw';

    //         $fullPath = storage_path('app/public/' . $path . '/' . $filename);

    //         if (!file_exists(dirname($fullPath))) {
    //             mkdir(dirname($fullPath), 0777, true);
    //         }

    //         file_put_contents($fullPath, $compressed);

    //         return $path . '/' . $filename;
    //     };

    //     if ($request->hasFile('kartu_keluarga')) {
    //         $dokumen['kartu_keluarga'] = $handleLZW($request->file('kartu_keluarga'), $path);
    //     }

    //     if ($request->hasFile('screenshot_jarak')) {
    //         $dokumen['screenshot_jarak'] = $handleLZW($request->file('screenshot_jarak'), $path);
    //     }

    //     if ($request->hasFile('kartu_kip')) {
    //         $dokumen['kartu_kip'] = $handleLZW($request->file('kartu_kip'), $path);
    //     }

    //     if ($request->hasFile('sertifikat_kejuaraan')) {
    //         $dokumen['sertifikat_kejuaraan'] = $handleLZW($request->file('sertifikat_kejuaraan'), $path);
    //     }

    //     return $dokumen;
    // }

    // private function lzwCompress($data)
    // {
    //     $dictionary = [];
    //     $dictSize = 256;

    //     for ($i = 0; $i < 256; $i++) {
    //         $dictionary[chr($i)] = $i;
    //     }

    //     $w = "";
    //     $result = [];

    //     foreach (str_split($data) as $c) {
    //         $wc = $w . $c;
    //         if (isset($dictionary[$wc])) {
    //             $w = $wc;
    //         } else {
    //             $result[] = $dictionary[$w];
    //             $dictionary[$wc] = $dictSize++;
    //             $w = $c;
    //         }
    //     }

    //     if ($w !== "") {
    //         $result[] = $dictionary[$w];
    //     }

    //     return json_encode($result); 
    // }
}