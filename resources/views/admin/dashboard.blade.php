@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <!-- TITLE -->
    <div class="mb-4">
        <h3 class="fw-bold">Dashboard Admin</h3>
        <p class="text-muted">Ringkasan data pendaftaran</p>
    </div>

    <!-- STAT CARDS -->
    <div class="row g-3 mb-4">

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-white" style="background:#5b0e7f;">
                <div class="card-body">
                    <small>Total Pendaftar</small>
                    <h3 class="fw-bold">{{ $total ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-white bg-success">
                <div class="card-body">
                    <small>Jalur Domisili</small>
                    <h3 class="fw-bold">{{ $domisili ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-white bg-warning">
                <div class="card-body">
                    <small>Jalur Prestasi</small>
                    <h3 class="fw-bold">{{ $prestasi ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 text-white bg-danger">
                <div class="card-body">
                    <small>Jalur Afirmasi</small>
                    <h3 class="fw-bold">{{ $afirmasi ?? 0 }}</h3>
                </div>
            </div>
        </div>

    </div>

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white">
            <h5 class="mb-0">Pendaftar Terbaru</h5>
        </div>

        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Jalur</th>
                        <th>Nilai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftarTerbaru ?? [] as $p)
                    <tr>
                        <td>{{ $p->nama_lengkap }}</td>
                        <td>{{ $p->nisn }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ ucfirst(str_replace('_',' ', $p->jalur_pendaftaran)) }}
                            </span>
                        </td>
                        <td>{{ $p->jumlah_nilai ?? '-' }}</td>
                        <td>
                            <span class="badge bg-secondary">{{ $p->status }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Belum ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection