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
                                <div class="section-icon me-3 bg-success text-white">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-0 text-success">Nilai Raport</h5>
                                    <small class="text-muted">Kelas 4-6 SD/MI</small>
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
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>