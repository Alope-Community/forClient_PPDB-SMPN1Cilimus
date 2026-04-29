<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB SMPN 1 CILIMUS TA 2025/2026</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5aa0;
            --primary-gradient: linear-gradient(135deg, #2c5aa0 0%, #4a90e2 50%, #7ab8f5 100%);
            --accent-color: #28a745;
        }
        * { font-family: 'Poppins', sans-serif; }
        
        .text-primary { color: var(--primary-color) !important; }
        .bg-primary { background-color: var(--primary-color) !important; }
        .btn-primary {
            --bs-btn-bg: var(--primary-color);
            --bs-btn-border-color: var(--primary-color);
            --bs-btn-hover-bg: #1e477a;
        }
        
        body { background: linear-gradient(135deg, #f8f9ff 0%, #e8f0fe 100%); min-height: 100vh; }
        .main-container {
            background: var(--primary-gradient);
            min-height: 100vh;
            padding: 2rem 0;
        }
        .step { transition: all 0.3s ease; display: none; }
        .step.active { display: block; }
        .file-upload:focus { box-shadow: 0 0 0 0.25rem rgba(44,90,160,.25); }
        .progress-bar { transition: width 0.3s ease; }
        .form-card { border-radius: 20px; box-shadow: 0 25px 50px rgba(0,0,0,0.15); overflow: hidden; }
        .required::after { content: " *"; color: #dc3545; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 768px) { .main-container { padding: 1rem 0; } }
    </style>

    <!-- Sebelum </head> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="main-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-10">
                    <!-- Header -->
                    <div class="text-center text-white mb-5 pt-3">
                        <div class="mb-4">
                            <i class="fas fa-school fa-4x mb-3 opacity-75"></i>
                        </div>
                        <h1 class="display-4 fw-bold mb-3">PPDB SMPN 1 CILIMUS</h1>
                        <p class="lead mb-4">Tahun Ajaran 2025/2026</p>
                        <div class="progress rounded-pill shadow" style="height: 12px; max-width: 500px; margin: 0 auto;">
                            <div class="progress-bar bg-warning rounded-pill" id="progressBar" style="width: 0%"></div>
                        </div>
                        <small class="text-white-50 mt-2 d-block">Pastikan semua data diisi lengkap dan benar sesuai dokumen resmi</small>
                    </div>

                    <form id="ppdbForm" method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- STEP 1: IDENTITAS CALON PESERTA DIDIK -->
                        <div class="card form-card step active" data-step="1">
                            <div class="card-header bg-primary text-white py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 p-3 rounded-circle me-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-user fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 fw-bold">1. Identitas Calon Peserta Didik</h4>
                                        <small>Data pribadi sesuai akta lahir/ijazah SD</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Asal SD/MI</label>
                                        <input type="text" class="form-control form-control-lg" name="asal_sd_mi" placeholder="SD Negeri 1 Bojong" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Jalur Pendaftaran</label>
                                        <select class="form-select form-select-lg" name="jalur_pendaftaran" id="jalurSelect" required>
                                            <option value="">Pilih Jalur</option>
                                            <option value="domisili">Jalur Domisili</option>
                                            <option value="afirmasi">Jalur Afirmasi (KETM & ABK)</option>
                                            <option value="prestasi_akademik">Jalur Prestasi Akademik</option>
                                            <option value="prestasi_non_akademik">Jalur Prestasi Non Akademik</option>
                                            <option value="mutasi">Jalur Mutasi (Perpindahan Orang Tua/Anak Guru)</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="form-label fw-semibold fs-6 required">Nama Lengkap</label>
                                        <input type="text" class="form-control form-control-lg" name="nama_lengkap" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold fs-6 required">Jenis Kelamin</label>
                                        <select class="form-select form-select-lg" name="jenis_kelamin" required>
                                            <option value="">Pilih</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold fs-6 required">No. NISN</label>
                                        <input type="text" class="form-control form-control-lg" name="nisn" maxlength="10" placeholder="0088996777" required>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="form-label fw-semibold fs-6 required">Tempat Lahir</label>
                                        <input type="text" class="form-control form-control-lg" name="tempat_lahir" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Tanggal Lahir</label>
                                        <input type="date" class="form-control form-control-lg" name="tanggal_lahir" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Apakah pernah TK/PAUD</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pernah_paud" id="pernah_paud" value="1">
                                            <label class="form-check-label" for="pernah_paud">Pernah PAUD</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="pernah_tk" id="pernah_tk" value="1">
                                            <label class="form-check-label" for="pernah_tk">Pernah TK</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tidak_pernah" id="tidak_pernah" value="1">
                                            <label class="form-check-label" for="tidak_pernah">Tidak Pernah PAUD/TK</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Hobby</label>
                                        <input type="text" class="form-control form-control-lg" name="hobby">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Cita-cita</label>
                                        <input type="text" class="form-control form-control-lg" name="cita_cita">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold fs-6 required">Tinggi Badan (cm)</label>
                                        <input type="number" class="form-control form-control-lg" name="tinggi_badan" step="0.1" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold fs-6 required">Berat Badan (kg)</label>
                                        <input type="number" class="form-control form-control-lg" name="berat_badan" step="0.1" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold fs-6 required">Lingkar Kepala (cm)</label>
                                        <input type="number" class="form-control form-control-lg" name="lingkar_kepala" step="0.1" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Anak Ke</label>
                                        <input type="number" class="form-control form-control-lg" name="anak_ke" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Jumlah Saudara Kandung</label>
                                        <input type="number" class="form-control form-control-lg" name="jumlah_saudara" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold fs-6 required">Apakah Memiliki KIP</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="memiliki_kip" id="kip_ya" value="Ya" required>
                                            <label class="form-check-label" for="kip_ya">Ya</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="memiliki_kip" id="kip_tidak" value="Tidak" required>
                                            <label class="form-check-label" for="kip_tidak">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light border-0 p-4">
                                <button type="button" class="btn btn-primary btn-lg px-5 next-step">
                                    <i class="fas fa-arrow-right me-2"></i>Selanjutnya: Alamat & Dokumen
                                </button>
                            </div>
                        </div>

                        <!-- STEP 2: ALAMAT & DOKUMEN -->
                        <div class="card form-card step" data-step="2">
                            <div class="card-header bg-success text-white py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 p-3 rounded-circle me-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-map-marker-alt fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 fw-bold">2. Alamat & Dokumen Pendukung</h4>
                                        <small>Koordinat GPS dan Kartu Keluarga wajib</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Agama</label>
                                        <select class="form-select form-select-lg" name="agama" required>
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">No. HP Calon Peserta Didik</label>
                                        <input type="tel" class="form-control form-control-lg" name="no_hp_siswa" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Email Calon Peserta Didik</label>
                                        <input type="email" class="form-control form-control-lg" name="email_siswa">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold fs-6 required">Alamat Lengkap</label>
                                        <textarea class="form-control form-control-lg" rows="3" name="alamat_lengkap" 
                                            placeholder="RT. 10 RW. 05 Desa Bojong Kec. Cilimus Kab. Kuningan 45556" required></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Titik Koordinat</label>
                                        <input type="text" class="form-control form-control-lg" name="titik_koordinat" 
                                            placeholder="-6.873307, 108.494803" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Jarak Rumah ke SMPN 1 Cilimus (meter)</label>
                                        <input type="number" step="0.01" class="form-control form-control-lg" name="jarak_rumah" 
                                            placeholder="244.18" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Kartu KIP (Jika Ya)</label>
                                        <input type="file" class="form-control file-upload" name="kartu_kip" accept=".pdf,.jpg,.jpeg,.png">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Screenshot Pengukuran Jarak Google Maps</label>
                                        <input type="file" class="form-control file-upload" name="screenshot_jarak" accept="image/*" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold fs-6 required">Kartu Keluarga (KK)</label>
                                        <input type="file" class="form-control file-upload" name="kartu_keluarga" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Akun Sosial Media</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="sosmed[]" value="Instagram" id="ig">
                                            <label class="form-check-label" for="ig">Instagram</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="sosmed[]" value="Tiktok" id="tiktok">
                                            <label class="form-check-label" for="tiktok">Tiktok</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="sosmed[]" value="Facebook" id="fb">
                                            <label class="form-check-label" for="fb">Facebook</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="sosmed[]" value="Twitter" id="twitter">
                                            <label class="form-check-label" for="twitter">Twitter</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="sosmed_lain" id="lain">
                                            <label class="form-check-label" for="lain">Lainnya: <input type="text" class="form-control form-control-sm d-inline-block w-auto ms-2" name="sosmed_lainnya"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light border-0 p-4">
                                <button type="button" class="btn btn-outline-secondary btn-lg me-3 prev-step">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </button>
                                <button type="button" class="btn btn-success btn-lg px-5 next-step">
                                    <i class="fas fa-arrow-right me-2"></i>Lanjut: Nilai Raport
                                </button>
                            </div>
                        </div>

                        <!-- STEP 3: NILAI RAPORT & PRESTASI -->
                        <div class="card form-card step" data-step="3">
                            <div class="card-header bg-info text-white py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 p-3 rounded-circle me-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-chart-line fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 fw-bold">3. Nilai Raport & Prestasi</h4>
                                        <small>Jumlah nilai 5 semester (Kelas 4-6)</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <div class="alert alert-warning">
                                    <i class="fas fa-calculator me-2"></i>
                                    Ganti tanda koma (,) dengan titik (.) | Contoh: 440.70
                                </div>
                                <div class="row g-4">
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold fs-6 required">Bahasa Indonesia</label>
                                        <input type="number" step="0.01" class="form-control form-control-lg" name="nilai_bindo" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold fs-6 required">Matematika</label>
                                        <input type="number" step="0.01" class="form-control form-control-lg" name="nilai_matematika" required>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold fs-6 required">IPA</label>
                                        <input type="number" step="0.01" class="form-control form-control-lg" name="nilai_ipa" required>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-label fw-semibold fs-6 required">Jumlah Nilai (B.Indonesia + Matematika + IPA)</label>
                                        <input type="number" step="0.01" class="form-control form-control-lg" name="jumlah_nilai" id="jumlah_nilai" required readonly>
                                    </div>
                                </div>

                                <!-- Prestasi Non Akademik -->
                                <div class="jalur-prestasi mt-5" style="display: none;">
                                    <hr>
                                    <h5 class="fw-bold mb-4">Prestasi Kejuaraan (Jalur Prestasi Non Akademik)</h5>
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <label class="form-label fw-semibold fs-6">Event Kejuaraan / Tahun</label>
                                            <input type="text" class="form-control form-control-lg" name="event_kejuaraan">
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label fw-semibold fs-6">Tingkat</label>
                                            <select class="form-select form-select-lg" name="tingkat_kejuaraan">
                                                <option value="">Pilih</option>
                                                <option value="Kecamatan">Kecamatan</option>
                                                <option value="Kabupaten">Kabupaten</option>
                                                <option value="Provinsi">Provinsi</option>
                                                <option value="Nasional">Nasional</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <label class="form-label fw-semibold fs-6">Juara/Peringkat</label>
                                            <select class="form-select form-select-lg" name="peringkat">
                                                <option value="">Pilih</option>
                                                <option value="Juara 1">Juara 1</option>
                                                <option value="Juara 2">Juara 2</option>
                                                <option value="Juara 3">Juara 3</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label fw-semibold fs-6">Penyelenggara</label>
                                            <input type="text" class="form-control form-control-lg" name="penyelenggara">
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="form-label fw-semibold fs-6">Sertifikat Kejuaraan</label>
                                            <input type="file" class="form-control file-upload" name="sertifikat_kejuaraan" accept=".pdf,.jpg,.jpeg,.png">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light border-0 p-4">
                                <button type="button" class="btn btn-outline-secondary btn-lg me-3 prev-step">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </button>
                                <button type="button" class="btn btn-primary btn-lg px-5 next-step" id="nextToParent">
                                    <i class="fas fa-arrow-right me-2"></i>Lanjut: Data Orang Tua
                                </button>
                            </div>
                        </div>

                        <!-- STEP 4: DATA ORANG TUA -->
                        <div class="card form-card step" data-step="4">
                            <div class="card-header bg-warning text-white py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 p-3 rounded-circle me-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-users fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 fw-bold">4. Data Orang Tua/Wali</h4>
                                        <small>Informasi lengkap orang tua/wali</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <div class="row g-4">
                                    <!-- Data Ayah -->
                                    <div class="col-12">
                                        <h5 class="fw-bold border-bottom pb-2 mb-4">Data Ayah</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Nama Ayah</label>
                                        <input type="text" class="form-control form-control-lg" name="nama_ayah" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Tempat Lahir Ayah</label>
                                        <input type="text" class="form-control form-control-lg" name="tempat_lahir_ayah" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Tanggal Lahir Ayah</label>
                                        <input type="date" class="form-control form-control-lg" name="tanggal_lahir_ayah" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Agama Ayah</label>
                                        <select class="form-select form-select-lg" name="agama_ayah" required>
                                            <option value="">Pilih Agama</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Kristen">Kristen</option>
                                            <option value="Katolik">Katolik</option>
                                            <option value="Hindu">Hindu</option>
                                            <option value="Budha">Budha</option>
                                            <option value="Konghucu">Konghucu</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Pekerjaan Ayah</label>
                                        <input type="text" class="form-control form-control-lg" name="pekerjaan_ayah" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Pendidikan Ayah</label>
                                        <select class="form-select form-select-lg" name="pendidikan_ayah" required>
                                            <option value="">Pilih</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="D1">D1</option>
                                            <option value="D2">D2</option>
                                            <option value="D3">D3</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                        </select>
                                    </div>

                                    <!-- Data Ibu -->
                                    <div class="col-12">
                                        <h5 class="fw-bold border-bottom pb-2 mt-5 mb-4">Data Ibu</h5>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Nama Ibu</label>
                                        <input type="text" class="form-control form-control-lg" name="nama_ibu" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Tempat Lahir Ibu</label>
                                        <input type="text" class="form-control form-control-lg" name="tempat_lahir_ibu" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Tanggal Lahir Ibu</label>
                                        <input type="date" class="form-control form-control-lg" name="tanggal_lahir_ibu" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Pekerjaan Ibu</label>
                                        <input type="text" class="form-control form-control-lg" name="pekerjaan_ibu" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">Pendidikan Ibu</label>
                                        <select class="form-select form-select-lg" name="pendidikan_ibu" required>
                                            <option value="">Pilih</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="D1">D1</option>
                                            <option value="D2">D2</option>
                                            <option value="D3">D3</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold fs-6 required">Alamat Orang Tua</label>
                                        <textarea class="form-control form-control-lg" rows="2" name="alamat_orang_tua" required></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6 required">No. HP Orang Tua/Wali</label>
                                        <input type="tel" class="form-control form-control-lg" name="no_hp_orang_tua" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light border-0 p-4">
                                <button type="button" class="btn btn-outline-secondary btn-lg me-3 prev-step">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('ppdbForm');
        const steps = document.querySelectorAll('.step');
        const progressBar = document.getElementById('progressBar');
        const jalurSelect = document.getElementById('jalurSelect');

        let currentStep = 1;

        // =========================
        // INIT STEP
        // =========================
        steps.forEach((step, index) => {
            step.style.display = index === 0 ? 'block' : 'none';
        });

        // =========================
        // HITUNG NILAI
        // =========================
        function calculateJumlahNilai() {
            const bindo = parseFloat(document.querySelector('[name="nilai_bindo"]')?.value) || 0;
            const mtk   = parseFloat(document.querySelector('[name="nilai_matematika"]')?.value) || 0;
            const ipa   = parseFloat(document.querySelector('[name="nilai_ipa"]')?.value) || 0;

            document.getElementById('jumlah_nilai').value = (bindo + mtk + ipa).toFixed(2);
        }

        document.querySelectorAll('[name="nilai_bindo"], [name="nilai_matematika"], [name="nilai_ipa"]')
            .forEach(i => i.addEventListener('input', calculateJumlahNilai));

        // =========================
        // JALUR PRESTASI
        // =========================
        jalurSelect.addEventListener('change', function() {
            const prestasi = document.querySelector('.jalur-prestasi');

            if (this.value === 'prestasi_non_akademik') {
                prestasi.style.display = 'block';

                // 🔥 aktifkan required
                prestasi.querySelectorAll('input, select').forEach(i => {
                    i.setAttribute('required', 'required');
                });

            } else {
                prestasi.style.display = 'none';

                // 🔥 hilangkan required + kosongkan
                prestasi.querySelectorAll('input, select').forEach(i => {
                    i.removeAttribute('required');
                    i.value = '';
                });
            }
        });

        // =========================
        // VALIDASI STEP
        // =========================
        function validateStep(stepIndex) {
            const currentForm = steps[stepIndex - 1];
            const inputs = currentForm.querySelectorAll('input, select, textarea');

            let valid = true;

            inputs.forEach(input => {
                if (input.offsetParent === null) return;

                if (input.hasAttribute('required') && !input.checkValidity()) {
                    input.reportValidity();
                    valid = false;
                }
            });

            return valid;
        }

        // =========================
        // NAVIGASI STEP
        // =========================
        document.querySelectorAll('.next-step').forEach(btn => {
            btn.addEventListener('click', () => {
                if (!validateStep(currentStep)) return;

                steps[currentStep - 1].style.display = 'none';
                currentStep++;
                steps[currentStep - 1].style.display = 'block';
                updateProgress();
            });
        });

        document.querySelectorAll('.prev-step').forEach(btn => {
            btn.addEventListener('click', () => {
                steps[currentStep - 1].style.display = 'none';
                currentStep--;
                steps[currentStep - 1].style.display = 'block';
                updateProgress();
            });
        });

        function updateProgress() {
            progressBar.style.width = (currentStep / steps.length) * 100 + '%';
        }

        // =========================
        // SUBMIT AJAX (🔥 INI KUNCI)
        // =========================
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            if (!validateStep(currentStep)) return;

            const btn = form.querySelector('button[type="submit"]');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
            btn.disabled = true;

            try {
                const res = await fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('[name=_token]').value
                    }
                });

                const data = await res.json();

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        html: data.message
                    }).then(() => {
                        form.reset();
                        location.reload();
                    });

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        html: data.message
                    });
                }

            } catch (err) {
                Swal.fire('Error', 'Server bermasalah', 'error');
            }

            btn.innerHTML = '<i class="fas fa-paper-plane"></i> Kirim Pendaftaran';
            btn.disabled = false;
        });

        // =========================
        // VALIDASI FILE
        // =========================
        document.querySelectorAll('.file-upload').forEach(input => {
            input.addEventListener('change', function() {
                if (this.files[0]?.size > 2 * 1024 * 1024) {
                    Swal.fire('Error', 'File max 2MB', 'error');
                    this.value = '';
                }
            });
        });

    });
    </script>
</body>
</html>