<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - PPDB SMPN 1 CILIMUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c5aa0;
            --primary-gradient: linear-gradient(135deg, #2c5aa0 0%, #4a90e2 50%, #7ab8f5 100%);
            --success-color: #28a745;
            --warning-color: #ffc107;
        }
        * { font-family: 'Poppins', sans-serif; }
        
        body { background: linear-gradient(135deg, #f8f9ff 0%, #e8f0fe 100%); }
        
        .main-container {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            min-height: 100vh;
            padding: 2rem 0;
        }
        
        .profile-card {
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.3);
        }
        
        .status-badge {
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .status-pending { background: linear-gradient(45deg, #ffc107, #ffed4e); color: #856404; }
        .status-diterima { background: linear-gradient(45deg, #28a745, #20c997); color: white; }
        .status-ditolak { background: linear-gradient(45deg, #dc3545, #e74c3c); color: white; }
        
        .data-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .data-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .section-icon {
            width: 60px;
            height: 60px;
            background: var(--primary-gradient);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }
        
        .print-btn {
            background: var(--primary-gradient);
            border: none;
            border-radius: 12px;
            padding: 10px 25px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .print-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(44,90,160,0.4);
            color: white;
        }
        
        @media (max-width: 768px) {
            .main-container { padding: 1rem 0; margin: 0 1rem; }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="fas fa-school me-2"></i>{{ config('app.name') }}
        </a>

        <div class="ms-auto d-flex align-items-center">
            <span class="text-white me-3">
                <i class="fas fa-user me-1"></i>{{ auth()->user()->name }}
            </span>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>
    <div class="main-container">
        <div class="container">
            <!-- Header -->
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <div class="mb-4">
                        <i class="fas fa-user-graduate fa-4x text-primary"></i>
                    </div>
                    <h1 class="display-4 fw-bold text-primary mb-2">Dashboard Pendaftaran</h1>
                    <p class="lead text-muted mb-0">Status & Data Pendaftaran Anda</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Profile Card -->
                <div class="col-12">
                    <div class="profile-card">
                        <div class="row g-0">
                            <div class="col-md-4 bg-primary text-white p-4 text-center">
                                <div class="profile-avatar mb-3">
                                    <i class="fas fa-user-circle fa-5x opacity-90"></i>
                                </div>
                                <h3 class="fw-bold mb-1">{{ $pendaftaran->nama_lengkap ?? 'Nama Siswa' }}</h3>
                                <p class="mb-2">{{ $pendaftaran->nisn ?? '-' }}</p>
                                <span class="status-badge status-{{ $pendaftaran->status ?? 'pending' }}">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ ucfirst($pendaftaran->status ?? 'pending') }}
                                </span>
                                <div class="mt-3">
                                    <a  
                                       class="print-btn" target="_blank">
                                        <i class="fas fa-print me-2"></i>Cetak Bukti
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8 p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <small class="text-muted">No. Pendaftaran</small>
                                        <h5 class="fw-bold text-primary">{{ $pendaftaran->uuid ?? '-' }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Jalur</small>
                                        <h5 class="fw-bold">{{ ucwords(str_replace('_', ' ', $pendaftaran->jalur_pendaftaran ?? '-')) }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Asal Sekolah</small>
                                        <h5>{{ $pendaftaran->asal_sd_mi ?? '-' }}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted">Tanggal Daftar</small>
                                        <h5>{{ $pendaftaran->created_at?->format('d M Y') ?? '-' }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Data Cards -->
                <div class="col-lg-6">
                    <div class="data-card h-100">
                        <div class="p-4 border-bottom bg-light">
                            <div class="d-flex align-items-center">
                                <div class="section-icon me-3">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0">Identitas Diri</h5>
                                    <small class="text-muted">Data pribadi calon siswa</small>
                                    <button class="btn btn-sm btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalIdentitas">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <small class="text-muted">Jenis Kelamin</small>
                                    <strong>{{ $pendaftaran->jenis_kelamin ?? '-' }}</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Agama</small>
                                    <strong>{{ $pendaftaran->agama ?? '-' }}</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Tgl Lahir</small>
                                    <strong>{{ $pendaftaran->tanggal_lahir ?? '-' }}</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Tinggi (cm)</small>
                                    <strong>{{ $pendaftaran->tinggi_badan ?? '-' }}</strong>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted">Alamat</small>
                                    <p class="mb-0"><strong>{{ $pendaftaran->alamat_lengkap ?? '-' }}</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="data-card h-100">
                        <div class="p-4 border-bottom bg-light">
                            <div class="d-flex align-items-center">
                                <div class="section-icon me-3 bg-warning text-dark">
                                    <i class="fas fa-file-upload"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-warning">Dokumen</h5>
                                    <small class="text-muted">File yang diupload</small>

                                     <button class="btn btn-sm btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalDokumen">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="list-group list-group-flush">
                                <a href="{{ $pendaftaran->kartu_keluarga ? Storage::url($pendaftaran->kartu_keluarga) : '#' }}" 
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                                   target="_blank">
                                    <div>
                                        <i class="fas fa-id-card text-primary me-2"></i>
                                        Kartu Keluarga
                                    </div>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <a href="{{ $pendaftaran->screenshot_jarak ? Storage::url($pendaftaran->screenshot_jarak) : '#' }}" 
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                                   target="_blank">
                                    <div>
                                        <i class="fas fa-map-marker-alt text-success me-2"></i>
                                        Screenshot Jarak
                                    </div>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                @if($pendaftaran->kartu_kip)
                                <a href="{{ Storage::url($pendaftaran->kartu_kip) }}" 
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" 
                                   target="_blank">
                                    <div>
                                        <i class="fas fa-credit-card text-info me-2"></i>
                                        Kartu KIP
                                    </div>
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="data-card h-100">
                        <div class="p-4 border-bottom bg-light">
                            <div class="d-flex align-items-center">
                                <div class="section-icon me-3 bg-success text-white">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-success">Nilai Raport</h5>
                                    <small class="text-muted">Kelas 4-6 SD/MI</small>

                                     <button class="btn btn-sm btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalNilai">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="row g-3">
                                <div class="col-4 text-center">
                                    <div class="fw-bold fs-5 text-primary">{{ $pendaftaran->nilai_bindo ?? 0 }}</div>
                                    <small class="text-muted">B. Indonesia</small>
                                </div>
                                <div class="col-4 text-center">
                                    <div class="fw-bold fs-5 text-primary">{{ $pendaftaran->nilai_matematika ?? 0 }}</div>
                                    <small class="text-muted">Matematika</small>
                                </div>
                                <div class="col-4 text-center">
                                    <div class="fw-bold fs-5 text-primary">{{ $pendaftaran->nilai_ipa ?? 0 }}</div>
                                    <small class="text-muted">IPA</small>
                                </div>
                                <div class="col-12">
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-bold fs-5">Total:</span>
                                        <span class="fw-bold fs-5 text-success">{{ $pendaftaran->jumlah_nilai ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="data-card h-100">
                        <div class="p-4 border-bottom bg-light">
                            <div class="d-flex align-items-center">
                                <div class="section-icon me-3">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0">Data Orang Tua</h5>
                                    <small class="text-muted">Ayah & Ibu/Wali</small>

                                     <button class="btn btn-sm btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#modalOrtu">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <small class="text-muted">Ayah</small>
                                    <strong>{{ $pendaftaran->nama_ayah ?? '-' }}</strong>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted">Ibu</small>
                                    <strong>{{ $pendaftaran->nama_ibu ?? '-' }}</strong>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-8">
                                    <small class="text-muted">No. HP Orang Tua</small>
                                    <strong>{{ $pendaftaran->no_hp_orang_tua ?? '-' }}</strong>
                                </div>
                                <div class="col-4">
                                    <small class="text-muted">KIP</small>
                                    <span class="badge bg-{{ $pendaftaran->memiliki_kip == 'Ya' ? 'success' : 'secondary' }}">
                                        {{ $pendaftaran->memiliki_kip ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalIdentitas" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('auth.login', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Identitas Diri 2222</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">

                        <!-- Asal SD -->
                        <div class="col-md-6">
                            <label>Asal SD/MI</label>
                            <input type="text" name="asal_sd_mi" class="form-control"
                                value="{{ $pendaftaran->asal_sd_mi }}">
                        </div>

                        <!-- Jalur -->
                        <div class="col-md-6">
                            <label>Jalur Pendaftaran</label>
                            <select name="jalur_pendaftaran" class="form-control">
                                <option value="domisili" {{ $pendaftaran->jalur_pendaftaran == 'domisili' ? 'selected' : '' }}>Domisili</option>
                                <option value="afirmasi" {{ $pendaftaran->jalur_pendaftaran == 'afirmasi' ? 'selected' : '' }}>Afirmasi</option>
                                <option value="prestasi_akademik" {{ $pendaftaran->jalur_pendaftaran == 'prestasi_akademik' ? 'selected' : '' }}>Prestasi Akademik</option>
                                <option value="prestasi_non_akademik" {{ $pendaftaran->jalur_pendaftaran == 'prestasi_non_akademik' ? 'selected' : '' }}>Prestasi Non Akademik</option>
                                <option value="mutasi" {{ $pendaftaran->jalur_pendaftaran == 'mutasi' ? 'selected' : '' }}>Mutasi</option>
                            </select>
                        </div>

                        <!-- Nama -->
                        <div class="col-md-8">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control"
                                value="{{ $pendaftaran->nama_lengkap }}">
                        </div>

                        <!-- JK -->
                        <div class="col-md-4">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="Laki-laki" {{ $pendaftaran->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $pendaftaran->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- NISN -->
                        <div class="col-md-4">
                            <label>NISN</label>
                            <input type="text" name="nisn" class="form-control"
                                value="{{ $pendaftaran->nisn }}">
                        </div>

                        <!-- Tempat Lahir -->
                        <div class="col-md-8">
                            <label>Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control"
                                value="{{ $pendaftaran->tempat_lahir }}">
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="col-md-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control"
                                value="{{ $pendaftaran->tanggal_lahir }}">
                        </div>

                        <!-- PAUD/TK -->
                        <div class="col-md-6">
                            <label>Pernah PAUD/TK</label><br>

                            <input type="checkbox" name="pernah_paud" value="1"
                                {{ $pendaftaran->pernah_paud ? 'checked' : '' }}> PAUD

                            <input type="checkbox" name="pernah_tk" value="1"
                                {{ $pendaftaran->pernah_tk ? 'checked' : '' }}> TK

                            <input type="checkbox" name="tidak_pernah" value="1"
                                {{ $pendaftaran->tidak_pernah ? 'checked' : '' }}> Tidak Pernah
                        </div>

                        <!-- Hobby -->
                        <div class="col-md-6">
                            <label>Hobby</label>
                            <input type="text" name="hobby" class="form-control"
                                value="{{ $pendaftaran->hobby }}">
                        </div>

                        <!-- Cita-cita -->
                        <div class="col-md-6">
                            <label>Cita-cita</label>
                            <input type="text" name="cita_cita" class="form-control"
                                value="{{ $pendaftaran->cita_cita }}">
                        </div>

                        <!-- Fisik -->
                        <div class="col-md-4">
                            <label>Tinggi Badan</label>
                            <input type="number" name="tinggi_badan" class="form-control"
                                value="{{ $pendaftaran->tinggi_badan }}">
                        </div>

                        <div class="col-md-4">
                            <label>Berat Badan</label>
                            <input type="number" name="berat_badan" class="form-control"
                                value="{{ $pendaftaran->berat_badan }}">
                        </div>

                        <div class="col-md-4">
                            <label>Lingkar Kepala</label>
                            <input type="number" name="lingkar_kepala" class="form-control"
                                value="{{ $pendaftaran->lingkar_kepala }}">
                        </div>

                        <!-- Keluarga -->
                        <div class="col-md-6">
                            <label>Anak Ke</label>
                            <input type="number" name="anak_ke" class="form-control"
                                value="{{ $pendaftaran->anak_ke }}">
                        </div>

                        <div class="col-md-6">
                            <label>Jumlah Saudara</label>
                            <input type="number" name="jumlah_saudara" class="form-control"
                                value="{{ $pendaftaran->jumlah_saudara }}">
                        </div>

                        <!-- KIP -->
                        <div class="col-12">
                            <label>Memiliki KIP</label><br>

                            <input type="radio" name="memiliki_kip" value="Ya"
                                {{ $pendaftaran->memiliki_kip == 'Ya' ? 'checked' : '' }}> Ya

                            <input type="radio" name="memiliki_kip" value="Tidak"
                                {{ $pendaftaran->memiliki_kip == 'Tidak' ? 'checked' : '' }}> Tidak
                        </div>

                        <!-- Alamat -->
                        <div class="col-12">
                            <label>Alamat</label>
                            <textarea name="alamat_lengkap" class="form-control">{{ $pendaftaran->alamat_lengkap }}</textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDokumen" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" 
                    method="POST" 
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- HEADER -->
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Alamat & Dokumen</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body">
                        <div class="row g-3">

                            <!-- Agama -->
                            <div class="col-md-6">
                                <label class="form-label">Agama</label>
                                <select name="agama" class="form-control">
                                    @foreach(['Islam','Kristen','Katolik','Hindu','Budha','Konghucu'] as $agama)
                                        <option value="{{ $agama }}" 
                                            {{ $pendaftaran->agama == $agama ? 'selected' : '' }}>
                                            {{ $agama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- No HP -->
                            <div class="col-md-6">
                                <label class="form-label">No HP</label>
                                <input type="text" 
                                    name="no_hp_siswa" 
                                    class="form-control"
                                    value="{{ $pendaftaran->no_hp_siswa }}">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" 
                                    name="email_siswa" 
                                    class="form-control"
                                    value="{{ $pendaftaran->email_siswa }}">
                            </div>

                            <!-- Koordinat -->
                            <div class="col-md-6">
                                <label class="form-label">Titik Koordinat</label>
                                <input type="text" 
                                    name="titik_koordinat" 
                                    class="form-control"
                                    value="{{ $pendaftaran->titik_koordinat }}">
                            </div>

                            <!-- Alamat -->
                            <div class="col-12">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" 
                                        class="form-control"
                                        rows="3">{{ $pendaftaran->alamat_lengkap }}</textarea>
                            </div>

                            <!-- Jarak -->
                            <div class="col-md-6">
                                <label class="form-label">Jarak Rumah (meter)</label>
                                <input type="number" 
                                    step="0.01" 
                                    name="jarak_rumah" 
                                    class="form-control"
                                    value="{{ $pendaftaran->jarak_rumah }}">
                            </div>

                            <!-- KARTU KIP -->
                            <div class="col-md-6">
                                <label class="form-label">Kartu KIP</label>
                                <input type="file" 
                                    name="kartu_kip" 
                                    class="form-control">

                                @if($pendaftaran->kartu_kip)
                                    <a href="{{ asset('storage/' . $pendaftaran->kartu_kip) }}" 
                                    target="_blank"
                                    class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-eye me-1"></i> Lihat
                                    </a>
                                @endif
                            </div>

                            <!-- SCREENSHOT JARAK -->
                            <div class="col-md-6">
                                <label class="form-label">Screenshot Jarak</label>
                                <input type="file" 
                                    name="screenshot_jarak" 
                                    class="form-control">

                                @if($pendaftaran->screenshot_jarak)
                                    <a href="{{ asset('storage/' . $pendaftaran->screenshot_jarak) }}" 
                                    target="_blank"
                                    class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-eye me-1"></i> Lihat
                                    </a>
                                @endif
                            </div>

                            <!-- KARTU KELUARGA -->
                            <div class="col-md-6">
                                <label class="form-label">Kartu Keluarga</label>
                                <input type="file" 
                                    name="kartu_keluarga" 
                                    class="form-control">

                                @if($pendaftaran->kartu_keluarga)
                                    <a href="{{ asset('storage/' . $pendaftaran->kartu_keluarga) }}" 
                                    target="_blank"
                                    class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-eye me-1"></i> Lihat
                                    </a>
                                @endif
                            </div>

                            <!-- SOSMED -->
                            <div class="col-12">
                                <label class="form-label">Akun Sosial Media</label><br>

                                @php
                                    $sosmed = json_decode($pendaftaran->sosmed ?? '[]', true);
                                @endphp

                                @foreach(['Instagram','Tiktok','Facebook','Twitter'] as $item)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            name="sosmed[]"
                                            value="{{ $item }}"
                                            {{ in_array($item, $sosmed ?? []) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $item }}</label>
                                    </div>
                                @endforeach

                                <div class="mt-2">
                                    <label>Lainnya:</label>
                                    <input type="text"
                                        name="sosmed_lainnya"
                                        class="form-control"
                                        value="{{ $pendaftaran->sosmed_lainnya }}">
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalOrtu" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- HEADER -->
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data Orang Tua / Wali</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body">
                        <div class="row g-3">

                            <!-- ================= AYAH ================= -->
                            <div class="col-12">
                                <h5 class="fw-bold border-bottom pb-2">Data Ayah</h5>
                            </div>

                            <div class="col-md-6">
                                <label>Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control"
                                    value="{{ $pendaftaran->nama_ayah }}">
                            </div>

                            <div class="col-md-6">
                                <label>Tempat Lahir Ayah</label>
                                <input type="text" name="tempat_lahir_ayah" class="form-control"
                                    value="{{ $pendaftaran->tempat_lahir_ayah }}">
                            </div>

                            <div class="col-md-6">
                                <label>Tanggal Lahir Ayah</label>
                                <input type="date" name="tanggal_lahir_ayah" class="form-control"
                                    value="{{ $pendaftaran->tanggal_lahir_ayah }}">
                            </div>

                            <div class="col-md-6">
                                <label>Agama Ayah</label>
                                <select name="agama_ayah" class="form-control">
                                    @foreach(['Islam','Kristen','Katolik','Hindu','Budha','Konghucu'] as $agama)
                                        <option value="{{ $agama }}"
                                            {{ $pendaftaran->agama_ayah == $agama ? 'selected' : '' }}>
                                            {{ $agama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label>Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" class="form-control"
                                    value="{{ $pendaftaran->pekerjaan_ayah }}">
                            </div>

                            <div class="col-md-6">
                                <label>Pendidikan Ayah</label>
                                <select name="pendidikan_ayah" class="form-control">
                                    @foreach(['SD','SMP','SMA','D1','D2','D3','S1','S2'] as $p)
                                        <option value="{{ $p }}"
                                            {{ $pendaftaran->pendidikan_ayah == $p ? 'selected' : '' }}>
                                            {{ $p }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- ================= IBU ================= -->
                            <div class="col-12 mt-4">
                                <h5 class="fw-bold border-bottom pb-2">Data Ibu</h5>
                            </div>

                            <div class="col-md-6">
                                <label>Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control"
                                    value="{{ $pendaftaran->nama_ibu }}">
                            </div>

                            <div class="col-md-6">
                                <label>Tempat Lahir Ibu</label>
                                <input type="text" name="tempat_lahir_ibu" class="form-control"
                                    value="{{ $pendaftaran->tempat_lahir_ibu }}">
                            </div>

                            <div class="col-md-6">
                                <label>Tanggal Lahir Ibu</label>
                                <input type="date" name="tanggal_lahir_ibu" class="form-control"
                                    value="{{ $pendaftaran->tanggal_lahir_ibu }}">
                            </div>

                            <div class="col-md-6">
                                <label>Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" class="form-control"
                                    value="{{ $pendaftaran->pekerjaan_ibu }}">
                            </div>

                            <div class="col-md-6">
                                <label>Pendidikan Ibu</label>
                                <select name="pendidikan_ibu" class="form-control">
                                    @foreach(['SD','SMP','SMA','D1','D2','D3','S1','S2'] as $p)
                                        <option value="{{ $p }}"
                                            {{ $pendaftaran->pendidikan_ibu == $p ? 'selected' : '' }}>
                                            {{ $p }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- ================= KONTAK ================= -->
                            <div class="col-12 mt-4">
                                <h5 class="fw-bold border-bottom pb-2">Kontak & Alamat</h5>
                            </div>

                            <div class="col-12">
                                <label>Alamat Orang Tua</label>
                                <textarea name="alamat_orang_tua" class="form-control" rows="2">{{ $pendaftaran->alamat_orang_tua }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label>No HP Orang Tua</label>
                                <input type="text" name="no_hp_orang_tua" class="form-control"
                                    value="{{ $pendaftaran->no_hp_orang_tua }}">
                            </div>

                        </div>
                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalNilai" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('pendaftaran.update', $pendaftaran->id) }}" 
                    method="POST" 
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- HEADER -->
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Nilai Raport & Prestasi</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- BODY -->
                    <div class="modal-body">

                        <div class="alert alert-warning">
                            Gunakan titik (.) untuk desimal | Contoh: 440.70
                        </div>

                        <div class="row g-3">

                            <!-- NILAI -->
                            <div class="col-md-4">
                                <label>Bahasa Indonesia</label>
                                <input type="number" step="0.01"
                                    name="nilai_bindo"
                                    id="edit_bindo"
                                    class="form-control"
                                    value="{{ $pendaftaran->nilai_bindo }}">
                            </div>

                            <div class="col-md-4">
                                <label>Matematika</label>
                                <input type="number" step="0.01"
                                    name="nilai_matematika"
                                    id="edit_mtk"
                                    class="form-control"
                                    value="{{ $pendaftaran->nilai_matematika }}">
                            </div>

                            <div class="col-md-4">
                                <label>IPA</label>
                                <input type="number" step="0.01"
                                    name="nilai_ipa"
                                    id="edit_ipa"
                                    class="form-control"
                                    value="{{ $pendaftaran->nilai_ipa }}">
                            </div>

                            <!-- TOTAL -->
                            <div class="col-12">
                                <label>Jumlah Nilai</label>
                                <input type="number" step="0.01"
                                    name="jumlah_nilai"
                                    id="edit_total"
                                    class="form-control"
                                    value="{{ $pendaftaran->jumlah_nilai }}"
                                    readonly>
                            </div>

                        </div>

                        <!-- PRESTASI -->
                        <div class="mt-4" id="editPrestasiSection"
                            style="{{ in_array($pendaftaran->jalur_pendaftaran, ['prestasi_akademik','prestasi_non_akademik']) ? '' : 'display:none;' }}">
                            
                            <hr>
                            <h5>Prestasi Kejuaraan</h5>

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label>Event / Tahun</label>
                                    <input type="text"
                                        name="event_kejuaraan"
                                        class="form-control"
                                        value="{{ $pendaftaran->event_kejuaraan }}">
                                </div>

                                <div class="col-md-3">
                                    <label>Tingkat</label>
                                    <select name="tingkat_kejuaraan" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach(['Kecamatan','Kabupaten','Provinsi','Nasional'] as $t)
                                            <option value="{{ $t }}"
                                                {{ $pendaftaran->tingkat_kejuaraan == $t ? 'selected' : '' }}>
                                                {{ $t }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Peringkat</label>
                                    <select name="peringkat" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach(['Juara 1','Juara 2','Juara 3'] as $p)
                                            <option value="{{ $p }}"
                                                {{ $pendaftaran->peringkat == $p ? 'selected' : '' }}>
                                                {{ $p }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Penyelenggara</label>
                                    <input type="text"
                                        name="penyelenggara"
                                        class="form-control"
                                        value="{{ $pendaftaran->penyelenggara }}">
                                </div>

                                <!-- FILE -->
                                <div class="col-md-6">
                                    <label>Sertifikat Kejuaraan</label>
                                    <input type="file"
                                        name="sertifikat_kejuaraan"
                                        class="form-control">

                                    @if($pendaftaran->sertifikat_kejuaraan)
                                        <a href="{{ asset('storage/' . $pendaftaran->sertifikat_kejuaraan) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary mt-2">
                                            <i class="fas fa-eye me-1"></i> Lihat
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>

                    </div>

                    <!-- FOOTER -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
// ==========================
// AUTO HITUNG NILAI
// ==========================
function hitungTotalEdit() {
    let bindo = parseFloat(document.getElementById('edit_bindo')?.value) || 0;
    let mtk   = parseFloat(document.getElementById('edit_mtk')?.value) || 0;
    let ipa   = parseFloat(document.getElementById('edit_ipa')?.value) || 0;

    let total = bindo + mtk + ipa;

    let totalField = document.getElementById('edit_total');
    if (totalField) {
        totalField.value = total.toFixed(2);
    }
}

// ==========================
// TOGGLE PRESTASI
// ==========================
function togglePrestasiEdit() {
    let jalur = document.getElementById('jalurSelect')?.value;
    let section = document.getElementById('editPrestasiSection');

    if (!section) return;

    let inputs = section.querySelectorAll('input, select');

    if (jalur === 'prestasi_akademik' || jalur === 'prestasi_non_akademik') {
        section.style.display = 'block';
        inputs.forEach(i => i.disabled = false);
    } else {
        section.style.display = 'none';
        inputs.forEach(i => i.disabled = true);
    }
}

// ==========================
// EVENT LISTENER
// ==========================
document.addEventListener('DOMContentLoaded', function () {

    // hitung awal
    hitungTotalEdit();

    // event input nilai
    document.getElementById('edit_bindo')?.addEventListener('input', hitungTotalEdit);
    document.getElementById('edit_mtk')?.addEventListener('input', hitungTotalEdit);
    document.getElementById('edit_ipa')?.addEventListener('input', hitungTotalEdit);

    // jalur select (dari form utama)
    document.getElementById('jalurSelect')?.addEventListener('change', togglePrestasiEdit);

    // initial check
    togglePrestasiEdit();
});
</script>
</body>
</html>