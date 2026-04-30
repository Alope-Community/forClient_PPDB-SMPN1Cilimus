@extends('siswa.layouts.app')


@section('title', 'PPDB - Beranda')

@push('styles')
<style>
    :root {
        --primary-color: #5b0e7f;
        --primary-gradient: linear-gradient(135deg, #5b0e7f 0%, #8b5fcf 50%, #a885d8 100%);
        --secondary-color: #f8f9fa;
        --accent-color: #ff6b35;
    }
    * {
        font-family: 'Poppins', sans-serif;
    }
    .navbar-brand {
        font-weight: 700;
        font-size: 1.5rem;
        color: var(--primary-color) !important;
    }
    .hero-section {
        background: var(--primary-gradient);
        color: white;
        padding-top: 120px;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff15"><polygon points="0,100 1000,0 1000,100"/></svg>');
        background-size: cover;
    }
    .hero-content {
        position: relative;
        z-index: 2;
    }
    .btn-register {
        background: var(--accent-color);
        border: none;
        padding: 15px 40px;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
    }
    .btn-register:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255,107,53,0.4);
    }
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        border-top: 4px solid var(--primary-color);
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(91,14,127,0.15);
    }
    .feature-icon {
        width: 80px;
        height: 80px;
        background: var(--primary-gradient);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
        color: white;
    }
    .counter-section {
        background: var(--secondary-color);
        padding: 80px 0;
    }
    .counter-number {
        font-size: 3.5rem;
        font-weight: 700;
        /* background: var(--primary-gradient); */
        /* -webkit-background-clip: text; */
        /* -webkit-text-fill-color: transparent; */
        /* background-clip: text; */
    }
    .testimonial-card {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        border-left: 5px solid var(--accent-color);
    }
    .form-section, .counter-section {
        background: var(--primary-gradient);
        color: white;
        padding: 100px 0;
    }
    .form-control {
        border-radius: 15px;
        border: none;
        padding: 15px 20px;
        background: rgba(255,255,255,0.9);
        box-shadow: 0 4px 15px rgba(91,14,127,0.1);
    }
    .form-control:focus {
        background: white;
        box-shadow: 0 0 0 0.2rem rgba(91,14,127,0.25);
    }
    .navbar-scrolled {
        background: rgba(255,255,255,0.95) !important;
        backdrop-filter: blur(20px);
        box-shadow: 0 2px 20px rgba(91,14,127,0.1);
    }
    .table-primary {
        --bs-table-bg: rgba(91,14,127,0.1);
        color: var(--primary-color);
    }
    .btn-warning {
        --bs-btn-bg: var(--accent-color);
        --bs-btn-border-color: var(--accent-color);
        --bs-btn-hover-bg: #e55a2b;
    }
    @media (max-width: 768px) {
        .hero-section {
            padding: 80px 0;
        }
        .counter-number {
            font-size: 2.5rem;
        }
    }


    .text-primary {
        color: #5b0e7f !important;
    }
</style>
@endpush

@section('content')
{{-- Hero Section --}}
<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-content">
                <h1 class="display-5 fw-bold mb-4 animate__animated animate__fadeInUp">
                    Penerimaan Siswa Baru <br>
                    <span class="text-warning display-6 fw-bold">Tahun Ajaran 2026/2026</span>
                </h1>
                <p class="lead mb-5 animate__animated animate__fadeInUp animate__delay-1s">
                    Wujudkan Masa Depan Cerahmu Bersama {{ config('app.name') }}. 
                    Daftar sekarang dan raih cita-citamu!
                </p>
                <div class="animate__animated animate__fadeInUp animate__delay-2s">
                    <a href="{{ route('pendaftaran.index') }}" class="btn btn-lg btn-register me-3 mb-3">
                        <i class="fas fa-rocket me-2"></i>
                        Daftar Online
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <img 
                    src="/images/header-vector.png" 
                    alt="Student" 
                    class="img-fluid rounded-4" 
                    style="object-fit: cover;"
                >
            </div>
        </div>
    </div>
</section>

{{-- Features Section --}}
<section id="tentang" class="py-5">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold text-primary mb-3">Keunggulan Kami</h2>
                <p class="lead text-muted">Fasilitas terbaik dan kurikulum terdepan untuk masa depan anak bangsa</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Guru Berkualitas</h4>
                    <p class="text-muted">100+ guru bersertifikat dengan pengalaman mengajar rata-rata 15 tahun</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Laboratorium Lengkap</h4>
                    <p class="text-muted">24 laboratorium modern dengan peralatan terkini untuk praktik siswa</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card text-center">
                    <div class="feature-icon">
                        <i class="fas fa-laptop-code"></i>
                    </div>
                    <h4 class="fw-bold mb-3">Kurikulum Digital</h4>
                    <p class="text-muted">Integrasi teknologi informasi dan AI dalam pembelajaran sehari-hari</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Counter Section --}}
<section class="counter-section">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="counter-number" data-target="1250">0</div>
                <h5>Siswa Aktif</h5>
            </div>
            <div class="col-md-3 mb-4">
                <div class="counter-number" data-target="98">0</div>
                <h5>% Ujian Lulus</h5>
            </div>
            <div class="col-md-3 mb-4">
                <div class="counter-number" data-target="250">0</div>
                <h5>Guru Profesional</h5>
            </div>
            <div class="col-md-3 mb-4">
                <div class="counter-number" data-target="15">0</div>
                <h5>Tahun Berdiri</h5>
            </div>
        </div>
    </div>
</section>

{{-- Jadwal Section --}}
{{-- <section id="jadwal" class="py-5 bg-light">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class="display-5 fw-bold text-primary mb-3">Jadwal Pendaftaran</h2>
                <p class="lead text-muted">Jangan lewatkan kesempatan emas ini!</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover shadow-sm">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Tahap</th>
                                <th class="text-center">Periode</th>
                                <th class="text-center">Kegiatan</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-primary">
                                <td>Pendaftaran Online</td>
                                <td>1 Jan - 28 Feb 2026</td>
                                <td>Registrasi & Upload Dokumen</td>
                                <td><span class="badge bg-success">Dibuka</span></td>
                            </tr>
                            <tr class="table-warning">
                                <td>Seleksi Administrasi</td>
                                <td>1-7 Mar 2026</td>
                                <td>Pengumuman Lolos Admin</td>
                                <td><span class="badge bg-warning">Menunggu</span></td>
                            </tr>
                            <tr class="table-info">
                                <td>Tes Tertulis</td>
                                <td>15 Mar 2026</td>
                                <td>Ujian Online</td>
                                <td><span class="badge bg-secondary">Belum</span></td>
                            </tr>
                            <tr class="table-success">
                                <td>Pengumuman Akhir</td>
                                <td>25 Mar 2026</td>
                                <td>Daftar Ulang</td>
                                <td><span class="badge bg-secondary">Belum</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- Registration Form --}}
{{-- <section id="daftar" class="form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="display-5 fw-bold mb-3">Daftar Sekarang</h2>
                    <p class="lead mb-0">Isi formulir di bawah ini untuk memulai pendaftaran</p>
                </div>
                <form id="registrationForm" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="col-md-6">
                        <input type="email" class="form-control" placeholder="Email Aktif" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="NISN" required>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="No. HP" required>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" required>
                            <option value="">Pilih Jalur</option>
                            <option value="afirmasi">Afirmasi</option>
                            <option value="prestasi">Prestasi</option>
                            <option value="zonasi">Zonasi</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <textarea class="form-control" rows="4" placeholder="Alamat Lengkap" required></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-lg btn-warning px-5 py-3 fw-bold">
                            <i class="fas fa-paper-plane me-2"></i>
                            Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> --}}

{{-- Footer --}}
<footer id="kontak" class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-graduation-cap me-2 text-primary"></i>
                    {{ config('app.name', 'SMK NEGERI 1') }}
                </h5>
                <p>Sekolah unggulan dengan fasilitas modern dan kurikulum terbaik untuk masa depan anak bangsa.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white"><i class="fab fa-whatsapp fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">Kontak Kami</h5>
                <div>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Jl. Cilimus</p>
                    <p><i class="fas fa-phone me-2"></i>(021) 12345678</p>
                    <p><i class="fas fa-envelope me-2"></i>ppdb@smp1cilimus.sch.id</p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <h5 class="fw-bold mb-3">Jadwal Penting</h5>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-calendar-day me-2 text-primary"></i>Pendaftaran: 1 Jan 2026</li>
                    <li class="mb-2"><i class="fas fa-calendar-day me-2 text-primary"></i>Seleksi: 15 Mar 2026</li>
                    <li><i class="fas fa-calendar-day me-2 text-primary"></i>Pengumuman: 25 Mar 2026</li>
                </ul>
            </div>
        </div>
        <hr class="my-4">
                    <div class="text-center">
            <p class="mb-0">&copy; 2026 {{ config('app.name', 'SMK NEGERI 1') }}. All rights reserved. | PPDB Online</p>
        </div>
    </div>
</footer>
@endsection

@push("scripts")
<script>
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('mainNavbar');
        if (window.scrollY > 100) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

    // Counter animation
    function animateCounters() {
        const counters = document.querySelectorAll('.counter-number');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-target'));
            const increment = target / 100;
            let current = 0;
            
            const updateCounter = () => {
                if (current < target) {
                    current += increment;
                    counter.textContent = Math.floor(current);
                    setTimeout(updateCounter, 20);
                } else {
                    counter.textContent = target;
                }
            };
            updateCounter();
        });
    }

    // Trigger counter animation when counter section is visible
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounters();
                observer.unobserve(entry.target);
            }
        });
    });

    const counterSection = document.querySelector('.counter-section');
    if (counterSection) {
        observer.observe(counterSection);
    }

    // Form submission
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
        submitBtn.disabled = true;
        
        setTimeout(() => {
            alert('✅ Terima kasih! Pendaftaran Anda telah berhasil dikirim.');
            this.reset();
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 2000);
    });

    // Active navbar link on scroll
    window.addEventListener('scroll', () => {
        let current = '';
        const sections = document.querySelectorAll('section');
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (scrollY >= (sectionTop - 200)) {
                current = section.getAttribute('id');
            }
        });

        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === `#${current}`) {
                link.classList.add('active');
            }
        });
    });
</script>
@endpush