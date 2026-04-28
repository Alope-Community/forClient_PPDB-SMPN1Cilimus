<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran PPDB - {{ config('app.name', 'SMK NEGERI 1') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #5b0e7f;
            --primary-gradient: linear-gradient(135deg, #5b0e7f 0%, #8b5fcf 50%, #a885d8 100%);
            --accent-color: #ff6b35;
        }
        * { font-family: 'Poppins', sans-serif; }
        
        /* Override Bootstrap Primary */
        .text-primary { color: var(--primary-color) !important; }
        .bg-primary { background-color: var(--primary-color) !important; }
        .btn-primary {
            --bs-btn-bg: var(--primary-color);
            --bs-btn-border-color: var(--primary-color);
            --bs-btn-hover-bg: #4a0b68;
        }
        
        body { background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); min-height: 100vh; }
        .main-container {
            background: var(--primary-gradient);
            min-height: 100vh;
            padding: 2rem 0;
        }
        .step { transition: all 0.3s ease; display: none; }
        .step.active { display: block; }
        .file-upload:focus { box-shadow: 0 0 0 0.25rem rgba(91,14,127,.25); }
        .progress-bar { transition: width 0.3s ease; }
        .jalur-section { display: none; animation: fadeIn 0.5s; }
        .jalur-section.active { display: block; }
        .form-card { border-radius: 20px; box-shadow: 0 25px 50px rgba(0,0,0,0.15); overflow: hidden; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 768px) { .main-container { padding: 1rem 0; } }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-11 col-xl-10">
                    <!-- Header -->
                    <div class="text-center text-white mb-5 pt-3">
                        <div class="mb-4">
                            <i class="fas fa-graduation-cap fa-4x mb-3 opacity-75"></i>
                        </div>
                        <h1 class="display-4 fw-bold mb-3">FORMULIR PENDAFTARAN PPDB</h1>
                        <p class="lead mb-4">Tahun Ajaran 2025/2026 - Isi data dengan lengkap dan benar</p>
                        <div class="progress rounded-pill shadow" style="height: 12px; max-width: 500px; margin: 0 auto;">
                            <div class="progress-bar bg-warning rounded-pill" id="progressBar" style="width: 0%"></div>
                        </div>
                        <small class="text-white-50 mt-2 d-block">Pastikan semua dokumen scan jelas dan ukuran < 2MB</small>
                    </div>

                    <form id="ppdbForm" method="POST" action="{{ route('pendaftaran.store') }}" enctype="multipart/form-data">
                        @csrf
                        <!-- STEP 1: DATA UTAMA -->
                        <div class="card form-card step active" data-step="1">
                            <div class="card-header bg-primary text-white py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 p-3 rounded-circle me-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-user fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 fw-bold">1. Data Utama Calon Siswa</h4>
                                        <small>Informasi pribadi calon siswa</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="nama_lengkap" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">NISN <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="nisn" maxlength="10" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
                                        <div class="row g-2">
                                            <div class="col-7">
                                                <input type="text" class="form-control" name="tempat_lahir" placeholder="Jakarta" required>
                                            </div>
                                            <div class="col-5">
                                                <input type="date" class="form-control" name="tanggal_lahir" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-lg" name="jenis_kelamin" required>
                                            <option value="">Pilih Jenis Kelamin</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label fw-semibold fs-6">Umur <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control form-control-lg" name="umur" min="12" max="18" required>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="form-label fw-semibold fs-6">Asal Sekolah <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-lg" name="asal_sekolah" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold fs-6">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea class="form-control" rows="3" name="alamat_lengkap" required 
                                            placeholder="Jl. Contoh No. 123, RT/RW 001/002, Kelurahan, Kecamatan, Kota"></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Email (Opsional)</label>
                                        <input type="email" class="form-control form-control-lg" name="email">
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">No. HP (Opsional)</label>
                                        <input type="tel" class="form-control form-control-lg" name="no_hp">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label fw-semibold fs-6">Pilihan Jalur Pendaftaran <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-lg" name="jalur_pendaftaran" id="jalurSelect" required>
                                            <option value="">Pilih Jalur Pendaftaran</option>
                                            <option value="zonasi">🗺️ Zonasi</option>
                                            <option value="afirmasi">❤️ Afirmasi</option>
                                            <option value="prestasi">🏆 Prestasi</option>
                                            <option value="perpindahan">🔄 Perpindahan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light border-0 p-4">
                                <button type="button" class="btn btn-primary btn-lg px-5 next-step">
                                    <i class="fas fa-arrow-right me-2"></i>Selanjutnya: Dokumen Wajib
                                </button>
                            </div>
                        </div>

                        <!-- STEP 2: DOKUMEN WAJIB -->
                        <div class="card form-card step" data-step="2" style="display: none;">
                            <div class="card-header bg-success text-white py-4">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 p-3 rounded-circle me-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-file-upload fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 fw-bold">2. Dokumen Wajib</h4>
                                        <small>Upload scan dokumen yang jelas (Max 2MB per file)</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-5">
                                <div class="alert alert-warning">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Format:</strong> PDF/JPG/PNG | <strong>Ukuran:</strong> Max 2MB | 
                                    <strong>Scan:</strong> Jelas & Lengkap
                                </div>
                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Ijazah/SKL SD <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control file-upload" name="ijazah_skl" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Akta Kelahiran <span class="text-danger">*</span></label>
                                                                               <input type="file" class="form-control file-upload" name="akta_kelahiran" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Kartu Keluarga (KK) <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control file-upload" name="kartu_keluarga" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">KTP Orang Tua <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control file-upload" name="ktp_orang_tua" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">SPTJM <span class="text-danger">*</span></label>
                                        <input type="file" class="form-control file-upload" name="sptjm" accept=".pdf,.jpg,.jpeg,.png" required>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-label fw-semibold fs-6">Ijazah Madrasah (Opsional)</label>
                                        <input type="file" class="form-control file-upload" name="ijazah_madrasah" accept=".pdf,.jpg,.jpeg,.png">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-light border-0 p-4">
                                <button type="button" class="btn btn-outline-secondary btn-lg me-3 prev-step">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </button>
                                <button type="button" class="btn btn-success btn-lg px-5 next-step">
                                    <i class="fas fa-arrow-right me-2"></i>Lanjut: Data Jalur
                                </button>
                            </div>
                        </div>

                        <!-- STEP 3: JALUR PENDAFTARAN -->
                        <div class="card form-card step" data-step="3" style="display: none;">
                            <div class="card-header bg-info text-white py-4" id="step3Header">
                                <div class="d-flex align-items-center">
                                    <div class="bg-white bg-opacity-20 p-3 rounded-circle me-3" style="width: 60px; height: 60px;">
                                        <i class="fas fa-route fa-2x text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 fw-bold" id="step3Title">3. Data Jalur Pendaftaran</h4>
                                        <small id="step3Desc">Lengkapi dokumen sesuai jalur yang dipilih</small>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-5" id="jalurContent">
                                <!-- Dynamic content akan dimuat disini -->
                                <div class="text-center py-5">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-3 text-muted">Pilih jalur pendaftaran di step sebelumnya</p>
                                </div>
                            </div>
                            <div class="card-footer bg-light border-0 p-4">
                                <button type="button" class="btn btn-outline-secondary btn-lg me-3 prev-step">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </button>
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-paper-plane me-2"></i>
                                    <span id="submitText">Kirim Pendaftaran</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const steps = document.querySelectorAll('.step');
        const progressBar = document.getElementById('progressBar');
        const jalurSelect = document.getElementById('jalurSelect');
        const jalurContent = document.getElementById('jalurContent');
        const step3Title = document.getElementById('step3Title');
        const step3Desc = document.getElementById('step3Desc');
        const submitBtn = document.querySelector('button[type="submit"]');
        const submitText = document.getElementById('submitText');

        steps.forEach((step, index) => {
            step.style.display = index === 0 ? 'block' : 'none';
        });
        
        let currentStep = 1;

        // Jalur Templates
        const jalurTemplates = {
            zonasi: {
                title: '🗺️ Data Jalur Zonasi',
                desc: 'Koordinat lokasi rumah dan bukti jarak ke sekolah',
                content: `
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Masukkan koordinat dari Google Maps (klik kanan → Apa ini?)
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <label class="form-label fw-semibold fs-6">Latitude <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control form-control-lg" name="latitude" 
                                   placeholder="-6.208771" required>
                            <small class="text-muted">Contoh: -6.208771</small>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label fw-semibold fs-6">Longitude <span class="text-danger">*</span></label>
                            <input type="number" step="any" class="form-control form-control-lg" name="longitude" 
                                   placeholder="106.845599" required>
                            <small class="text-muted">Contoh: 106.845599</small>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold fs-6">Screenshot Jarak Rumah ↔ Sekolah <span class="text-danger">*</span></label>
                            <input type="file" class="form-control file-upload" name="screenshot_jarak" accept="image/*" required>
                            <small class="text-muted">Screenshot Google Maps dengan marker rumah & sekolah</small>
                        </div>
                    </div>
                `
            },
            afirmasi: {
                title: '❤️ Data Jalur Afirmasi',
                desc: 'Dokumen untuk siswa dari keluarga tidak mampu',
                content: `
                    <div class="alert alert-warning">
                        <i class="fas fa-heart me-2"></i>
                        Prioritas untuk PIP/PKH/KKS/SKTM
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <label class="form-label fw-semibold fs-6">Kartu Bansos/SKTM <span class="text-danger">*</span></label>
                            <input type="file" class="form-control file-upload" name="kartu_bansos_sktm" accept=".pdf,image/*" required>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label fw-semibold fs-6">Surat Tanggung Jawab Pejabat <span class="text-danger">*</span></label>
                            <input type="file" class="form-control file-upload" name="surat_tanggung_jawab" accept=".pdf,image/*" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold fs-6">Surat Disabilitas (Opsional)</label>
                            <input type="file" class="form-control file-upload" name="surat_disabilitas" accept=".pdf,image/*">
                        </div>
                    </div>
                `
            },
            prestasi: {
                title: '🏆 Data Jalur Prestasi',
                desc: 'Akademik & Non-Akademik (Lomba/Olimpiade)',
                content: `
                    <div class="alert alert-success">
                        <i class="fas fa-trophy me-2"></i>
                        Ranking 40 besar + Prestasi tingkat Kota/Provinsi
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <label class="form-label fw-semibold fs-6">Rapor 5 Semester <span class="text-danger">*</span></label>
                            <input type="file" class="form-control file-upload" name="rapor_5_semester" accept=".pdf" required>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label fw-semibold fs-6">Surat Peringkat Sekolah <span class="text-danger">*</span></label>
                            <input type="file" class="form-control file-upload" name="surat_peringkat" accept=".pdf,image/*" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold fs-6">Sertifikat/Piagam Prestasi <span class="text-danger">*</span></label>
                            <input type="file" class="form-control file-upload" name="sertifikat_piagam" accept=".pdf,image/*" multiple required>
                            <small class="text-muted">Upload semua prestasi (akademik/non-akademik)</small>
                        </div>
                    </div>
                `
            },
            perpindahan: {
                title: '🔄 Data Jalur Perpindahan',
                desc: 'Anak guru/pindah tugas orang tua',
                content: `
                    <div class="alert alert-primary">
                        <i class="fas fa-exchange-alt me-2"></i>
                        Prioritas mutasi orang tua/guru
                    </div>
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold fs-6">Surat Pindah Tugas Orang Tua/Wali <span class="text-danger">*</span></label>
                            <input type="file" class="form-control file-upload" name="surat_pindah_tugas" accept=".pdf,image/*" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold fs-6">Surat Keterangan Orang Tua Guru (Opsional)</label>
                            <input type="file" class="form-control file-upload" name="surat_guru" accept=".pdf,image/*">
                        </div>
                    </div>
                `
            }
        };

        // Navigation
        document.querySelectorAll('.next-step').forEach(btn => {
            btn.addEventListener('click', () => {

                const currentForm = steps[currentStep - 1];
                const inputs = currentForm.querySelectorAll('input, select, textarea');

                for (let input of inputs) {
                    if (!input.checkValidity()) {
                        input.reportValidity();
                        return;
                    }
                }

                if (currentStep < 3) {
                    steps[currentStep - 1].classList.remove('active');
                    steps[currentStep - 1].style.display = 'none';

                    currentStep++;

                    steps[currentStep - 1].classList.add('active');
                    steps[currentStep - 1].style.display = 'block';

                    // 🔥 Load jalur saat masuk step 3
                    if (currentStep === 3) {
                        const jalur = jalurSelect.value;
                        if (jalur) {
                            loadJalurContent(jalur);
                        }
                    }

                    updateProgress();
                }
            });
        });

        document.querySelectorAll('.prev-step').forEach(btn => {
            btn.addEventListener('click', () => {
                if (currentStep > 1) {
                    steps[currentStep - 1].classList.remove('active');
                    currentStep--;
                    steps[currentStep - 1].classList.add('active');
                    updateProgress();
                }
            });
        });

        // Jalur Change
        jalurSelect.addEventListener('change', function() {
            const jalur = this.value;
            if (jalur && currentStep === 3) {
                loadJalurContent(jalur);
            }
        });

        function loadJalurContent(jalur) {
            const template = jalurTemplates[jalur];
            step3Title.textContent = template.title;
            step3Desc.textContent = template.desc;
            jalurContent.innerHTML = template.content;
        }

        // Progress
        function updateProgress() {
            const progress = (currentStep / 3) * 100;
            progressBar.style.width = progress + '%';
        }

        // Auto calculate umur
        document.querySelector('[name="tanggal_lahir"]').addEventListener('change', function() {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) age--;
            document.querySelector('[name="umur"]').value = age;
        });

        // Form Submit
        document.getElementById('ppdbForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const jalur = jalurSelect.value;
            if (currentStep === 3 && jalur) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                submitBtn.disabled = true;
                
                // Simulate API call
                setTimeout(() => {
                    const formData = new FormData(this);
                    console.log('📤 Form Data:', Object.fromEntries(formData));
                    
                    alert('🎉 Pendaftaran PPDB berhasil dikirim!\n\n' +
                          '✅ No. Pendaftaran: PPDB-' + Date.now().toString().slice(-6) + '\n' +
                          '📧 Cek email untuk konfirmasi & panduan selanjutnya\n' +
                          '⏰ Pantau status di dashboard pendaftaran');
                    
                    this.reset();
                    currentStep = 1;
                    steps[0].classList.add('active');
                    jalurContent.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"></div><p class="mt-3 text-muted">Pilih jalur pendaftaran...</p></div>';
                    updateProgress();
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Kirim Pendaftaran';
                    submitBtn.disabled = false;
                }, 2500);
            } else {
                alert('⚠️ Lengkapi step 1-3 dan pilih jalur pendaftaran!');
            }
        });

        // File size validation
        document.querySelectorAll('.file-upload').forEach(input => {
            input.addEventListener('change', function() {
                if (this.files[0]?.size > 2 * 1024 * 1024) {
                    alert('❌ File terlalu besar! Maksimal 2MB.');
                    this.value = '';
                }
            });
        });
    });
    </script>
</body>
</html>