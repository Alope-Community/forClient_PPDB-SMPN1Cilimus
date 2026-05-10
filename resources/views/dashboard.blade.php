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
        body {
            background: #f5f7fb;
            padding-top: 70px;
        }

        .data-card bg-white {
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border: none;
        }

        .data-card bg-white:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }

        .section-icon {
            width: 50px;
            height: 50px;
            background: #0d6efd;
            color: white;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 600;
        }

        .status-pending { background: #ffc107; }
        .status-approved { background: #198754; color:white; }
        .status-rejected { background: #dc3545; color:white; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container">
            <span class="navbar-brand">
                <img src="https://smpn1cilimus.sch.id/wp-content/uploads/2021/07/Untitled-design.png" class="me-2" style="width: 40px" />
                SPMB SMPN 1 Cilimus
            </span>

            <div>
                <span class="text-white me-3">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-5">

        <!-- PROFILE -->
        <div class="card mb-4">
            <div class="card-body text-center">
                <h4>{{ $pendaftaran->nama_lengkap }}</h4>
                <p>{{ $pendaftaran->nisn }}</p>

                <span class="status-badge status-{{ $pendaftaran->status }}">
                    {{ ucfirst($pendaftaran->status) }}
                </span>
            </div>
        </div>

        <div class="row g-4">

            <!-- IDENTITAS -->
            <div class="col-md-6">
                <div class="data-card bg-white h-100">

                    <!-- HEADER -->
                    <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <div class="section-icon">
                                <i class="fas fa-id-card"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Identitas</h6>
                                <small class="text-muted">Data pribadi siswa</small>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalIdentitas">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>

                    <!-- BODY -->
                    <div class="p-3">

                        <div class="row g-3">

                            <!-- JENIS KELAMIN -->
                            <div class="col-6">
                                <small class="text-muted d-block">Jenis Kelamin</small>
                                <div class="fw-semibold">
                                    <i class="fas fa-venus-mars me-1 text-primary"></i>
                                    {{ $pendaftaran->jenis_kelamin ?? '-' }}
                                </div>
                            </div>

                            <!-- AGAMA -->
                            <div class="col-6">
                                <small class="text-muted d-block">Agama</small>
                                <div class="fw-semibold">
                                    <i class="fas fa-pray me-1 text-success"></i>
                                    {{ $pendaftaran->agama ?? '-' }}
                                </div>
                            </div>

                            <!-- TANGGAL LAHIR -->
                            <div class="col-6">
                                <small class="text-muted d-block">Tanggal Lahir</small>
                                <div class="fw-semibold">
                                    <i class="fas fa-calendar-alt me-1 text-warning"></i>
                                    {{ $pendaftaran->tanggal_lahir ?? '-' }}
                                </div>
                            </div>

                            <!-- TINGGI BADAN -->
                            <div class="col-6">
                                <small class="text-muted d-block">Tinggi Badan</small>
                                <div class="fw-semibold">
                                    <i class="fas fa-ruler-vertical me-1 text-info"></i>
                                    {{ $pendaftaran->tinggi_badan ?? '-' }} cm
                                </div>
                            </div>

                            <!-- ALAMAT -->
                            <div class="col-12">
                                <small class="text-muted d-block">Alamat</small>
                                <div class="fw-semibold">
                                    <i class="fas fa-map-marker-alt me-1 text-danger"></i>
                                    {{ $pendaftaran->alamat_lengkap ?? '-' }}
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- DOKUMEN -->
            <div class="col-md-6">
                <div class="data-card bg-white h-100">

                    <!-- HEADER -->
                    <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <div class="section-icon bg-warning text-dark">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Dokumen</h6>
                                <small class="text-muted">File yang diupload</small>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalDokumen">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>

                    <!-- BODY -->
                    <div class="p-3">

                        <!-- KARTU KELUARGA -->
                        <div class="d-flex justify-content-between align-items-center border rounded px-4 py-2 mb-2 hover-item">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-id-card text-primary"></i>
                                <div>
                                    <div class="fw-semibold">Kartu Keluarga</div>
                                    <small class="text-muted">Dokumen wajib</small>
                                </div>
                            </div>

                            @if($pendaftaran->kartu_keluarga)
                                <a 
                                    href="{{ route('dokumen.lihat', $pendaftaran->kartu_keluarga) }}" 
                                    target="_blank"
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                            @else
                                <span class="badge bg-secondary">Belum upload</span>
                            @endif
                        </div>

                        <!-- SCREENSHOT JARAK -->
                        <div class="d-flex justify-content-between align-items-center border rounded px-4 py-2 mb-2 hover-item">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-map-marker-alt text-success"></i>
                                <div>
                                    <div class="fw-semibold">Jarak Rumah</div>
                                    <small class="text-muted">Screenshot lokasi</small>
                                </div>
                            </div>

                            @if($pendaftaran->screenshot_jarak)
                                <a 
                                    href="{{ route('dokumen.lihat', $pendaftaran->screenshot_jarak) }}" 
                                    target="_blank"
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                            @else
                                <span class="badge bg-secondary">Belum upload</span>
                            @endif
                        </div>

                        <!-- KIP (OPSIONAL) -->
                        @if($pendaftaran->memiliki_kip == 'Ya')
                        <div class="d-flex justify-content-between align-items-center border rounded px-4 py-2 hover-item">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-credit-card text-info"></i>
                                <div>
                                    <div class="fw-semibold">Kartu KIP</div>
                                    <small class="text-muted">Opsional</small>
                                </div>
                            </div>

                            @if($pendaftaran->kartu_kip)
                                <a 
                                    href="{{ route('dokumen.lihat', $pendaftaran->kartu_kip) }}" 
                                    target="_blank"
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                            @else
                                <span class="badge bg-secondary">Belum upload</span>
                            @endif
                        </div>
                        @endif

                        <!-- CERT -->
                        @if($pendaftaran->jalur_pendaftaran == 'prestasi_non_akademik')
                        <div class="d-flex justify-content-between align-items-center border rounded px-4 py-2 hover-item">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fas fa-trophy text-warning"></i>
                                <div>
                                    <div class="fw-semibold">Sertifikat Kejuaraan</div>
                                    <small class="text-muted">Jalur Prestasi Akademis</small>
                                </div>
                            </div>

                            @if($pendaftaran->sertifikat_kejuaraan)
                                <a 
                                    href="{{ route('dokumen.lihat', $pendaftaran->sertifikat_kejuaraan) }}" 
                                    target="_blank"
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="fas fa-eye"></i>
                                </a>
                            @else
                                <span class="badge bg-secondary">Belum upload</span>
                            @endif
                        </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- NILAI -->
            <div class="col-md-6">
                <div class="data-card bg-white h-100">

                    <!-- HEADER -->
                    <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <div class="section-icon bg-success text-white">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-success">Nilai Raport</h6>
                                <small class="text-muted">Kelas 4 - 6</small>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalNilai">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>

                    <!-- BODY -->
                    <div class="p-3 text-center">

                        <div class="row mb-3">

                            <div class="col">
                                <div class="fw-bold fs-5 text-primary">
                                    {{ $pendaftaran->nilai_bindo ?? 0 }}
                                </div>
                                <small class="text-muted">B. Indo</small>
                            </div>

                            <div class="col">
                                <div class="fw-bold fs-5 text-primary">
                                    {{ $pendaftaran->nilai_matematika ?? 0 }}
                                </div>
                                <small class="text-muted">MTK</small>
                            </div>

                            <div class="col">
                                <div class="fw-bold fs-5 text-primary">
                                    {{ $pendaftaran->nilai_ipa ?? 0 }}
                                </div>
                                <small class="text-muted">IPA</small>
                            </div>

                        </div>

                        <hr>

                        <div class="fw-bold fs-4 text-success">
                            Total: {{ $pendaftaran->jumlah_nilai ?? 0 }}
                        </div>

                    </div>
                </div>
            </div>


            <!-- ORANG TUA -->
            <div class="col-md-6">
                <div class="data-card bg-white h-100">

                    <!-- HEADER -->
                    <div class="p-3 border-bottom bg-light d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <div class="section-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Orang Tua</h6>
                                <small class="text-muted">Data wali siswa</small>
                            </div>
                        </div>

                        <button class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#modalOrtu">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>

                    <!-- BODY -->
                    <div class="p-3">

                        <!-- AYAH -->
                        <div class="mb-3">
                            <small class="text-muted d-block">Ayah</small>
                            <div class="fw-semibold">
                                <i class="fas fa-male me-1 text-primary"></i>
                                {{ $pendaftaran->nama_ayah ?? '-' }}
                            </div>
                        </div>

                        <!-- IBU -->
                        <div class="mb-3">
                            <small class="text-muted d-block">Ibu</small>
                            <div class="fw-semibold">
                                <i class="fas fa-female me-1 text-danger"></i>
                                {{ $pendaftaran->nama_ibu ?? '-' }}
                            </div>
                        </div>

                        <hr>

                        <!-- KONTAK -->
                        <div class="mb-2">
                            <small class="text-muted d-block">No HP Orang Tua</small>
                            <div class="fw-semibold">
                                <i class="fas fa-phone me-1 text-success"></i>
                                {{ $pendaftaran->no_hp_orang_tua ?? '-' }}
                            </div>
                        </div>

                        <!-- KIP -->
                        <div class="mt-2">
                            <small class="text-muted d-block">Status KIP</small>
                            <span class="badge bg-{{ $pendaftaran->memiliki_kip == 'Ya' ? 'success' : 'secondary' }}">
                                {{ $pendaftaran->memiliki_kip ?? '-' }}
                            </span>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>



    @include("siswa.components.modalIdentitas")
    @include("siswa.components.modalDokumen")
    @include("siswa.components.modalOrtu")
    @include("siswa.components.modalNilai")


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

            hitungTotalEdit();

            document.getElementById('edit_bindo')?.addEventListener('input', hitungTotalEdit);
            document.getElementById('edit_mtk')?.addEventListener('input', hitungTotalEdit);
            document.getElementById('edit_ipa')?.addEventListener('input', hitungTotalEdit);

            document.getElementById('jalurSelect')?.addEventListener('change', togglePrestasiEdit);

            togglePrestasiEdit();
        });
    </script>
</body>
</html>