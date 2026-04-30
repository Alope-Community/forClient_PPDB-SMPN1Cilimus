@extends('admin.layouts.app')

@section('title', 'Detail Pendaftar')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h3 class="fw-bold mb-1">Detail Pendaftar</h3>
            <small class="text-muted">{{ $pendaftaran->nama_lengkap }}</small>
        </div>

        <a href="{{ route('admin.pendaftar.index') }}" class="btn btn-outline-secondary">
            ← Kembali
        </a>
    </div>

    <!-- ALERT -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- STATUS -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.pendaftar.update', $pendaftaran->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row align-items-center">
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="pending" {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $pendaftaran->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $pendaftaran->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="waiting_list" {{ $pendaftaran->status == 'waiting_list' ? 'selected' : '' }}>Waiting List</option>
                        </select>
                    </div>

                    <div class="col-md-auto">
                        <button class="btn btn-primary">Update Status</button>
                    </div>

                    <div class="col text-end">
                        <!-- Badge Status -->
                        @php
                            $status = $pendaftaran->status;
                        @endphp

                        <span class="badge 
                            @if($status == 'approved') bg-success
                            @elseif($status == 'rejected') bg-danger
                            @elseif($status == 'waiting_list') bg-warning text-dark
                            @else bg-secondary
                            @endif
                        ">
                            {{ ucfirst(str_replace('_',' ', $status)) }}
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row g-4">

        <!-- LEFT -->
        <div class="col-lg-6">

            <!-- IDENTITAS -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-light fw-bold">Identitas</div>
                <div class="card-body">
                    <p><b>Nama:</b> {{ $pendaftaran->nama_lengkap }}</p>
                    <p><b>NISN:</b> {{ $pendaftaran->nisn }}</p>
                    <p><b>Jenis Kelamin:</b> {{ $pendaftaran->jenis_kelamin }}</p>
                    <p><b>TTL:</b> {{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir }}</p>
                    <p><b>Agama:</b> {{ $pendaftaran->agama }}</p>
                </div>
            </div>

            <!-- SEKOLAH -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-light fw-bold">Sekolah</div>
                <div class="card-body">
                    <p><b>Asal:</b> {{ $pendaftaran->asal_sd_mi }}</p>
                    <p>
                        <b>Jalur:</b>
                        <span class="badge bg-info">
                            {{ ucwords(str_replace('_',' ',$pendaftaran->jalur_pendaftaran)) }}
                        </span>
                    </p>
                </div>
            </div>

            <!-- NILAI -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light fw-bold">Nilai Raport</div>
                <div class="card-body">
                    <p>B. Indonesia: {{ $pendaftaran->nilai_bindo }}</p>
                    <p>Matematika: {{ $pendaftaran->nilai_matematika }}</p>
                    <p>IPA: {{ $pendaftaran->nilai_ipa }}</p>
                    <hr>
                    <h5>Total: {{ $pendaftaran->jumlah_nilai }}</h5>
                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="col-lg-6">

            <!-- ALAMAT -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-light fw-bold">Alamat</div>
                <div class="card-body">
                    <p>{{ $pendaftaran->alamat_lengkap }}</p>
                    <p><b>No HP:</b> {{ $pendaftaran->no_hp_siswa }}</p>
                </div>
            </div>

            <!-- ORANG TUA -->
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-light fw-bold">Orang Tua</div>
                <div class="card-body">
                    <p><b>Ayah:</b> {{ $pendaftaran->nama_ayah }}</p>
                    <p><b>Ibu:</b> {{ $pendaftaran->nama_ibu }}</p>
                    <p><b>No HP:</b> {{ $pendaftaran->no_hp_orang_tua }}</p>
                </div>
            </div>

            <!-- DOKUMEN -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light fw-bold">Dokumen</div>
                <div class="card-body">

                    <div class="d-grid gap-2">

                        @if($pendaftaran->kartu_keluarga)
                            <a href="{{ Storage::url($pendaftaran->kartu_keluarga) }}" target="_blank"
                               class="btn btn-outline-primary btn-sm">
                                📄 Lihat Kartu Keluarga
                            </a>
                        @endif

                        @if($pendaftaran->screenshot_jarak)
                            <a href="{{ Storage::url($pendaftaran->screenshot_jarak) }}" target="_blank"
                               class="btn btn-outline-success btn-sm">
                                📍 Lihat Jarak
                            </a>
                        @endif

                        @if($pendaftaran->kartu_kip)
                            <a href="{{ Storage::url($pendaftaran->kartu_kip) }}" target="_blank"
                               class="btn btn-outline-warning btn-sm">
                                💳 Lihat KIP
                            </a>
                        @endif

                        @if($pendaftaran->sertifikat_kejuaraan)
                            <a href="{{ Storage::url($pendaftaran->sertifikat_kejuaraan) }}" target="_blank"
                               class="btn btn-outline-info btn-sm">
                                🏆 Sertifikat Prestasi
                            </a>
                        @endif

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
@endsection