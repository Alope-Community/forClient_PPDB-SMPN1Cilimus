@extends('admin.layouts.app')

@section('title', 'Data Pendaftar')

@section('content')
<div class="container-fluid">

    <!-- HEADER -->
    <div class="mb-4">
        <h3 class="fw-bold">Data Pendaftar</h3>
        <p class="text-muted">Daftar calon peserta didik baru</p>
    </div>

    <!-- SEARCH CARD -->
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.pendaftar.index') }}">
                <div class="row g-2 align-items-center">

                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari nama / NISN..."
                                   value="{{ request('search') }}">
                        </div>
                    </div>

                    <div class="col-md-auto">
                        <button class="btn btn-primary">
                            Cari
                        </button>

                        <a href="{{ route('admin.pendaftar.index') }}" 
                        class="btn btn-outline-secondary">
                            Reset
                        </a>

                        <!-- TOMBOL EXPORT -->
                        <a href="{{ route('admin.pendaftar.export') }}" 
                        class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </a>
                    </div>

                    <div class="col text-end">
                        <small class="text-muted">
                            Total: {{ $pendaftar->total() }} data
                        </small>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Asal Sekolah</th>
                            <th>Jalur</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pendaftar as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration + ($pendaftar->firstItem() - 1) }}
                            </td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $item->nama_lengkap }}
                                </div>
                            </td>

                            <td>{{ $item->nisn }}</td>

                            <td>{{ $item->asal_sd_mi }}</td>

                            <td>
                                @php
                                    $jalur = $item->jalur_pendaftaran;
                                @endphp

                                <span class="badge 
                                    @if($jalur == 'domisili') bg-success
                                    @elseif($jalur == 'afirmasi') bg-danger
                                    @elseif(str_contains($jalur, 'prestasi')) bg-warning text-dark
                                    @elseif($jalur == 'mutasi') bg-info
                                    @else bg-secondary
                                    @endif
                                ">
                                    {{ ucwords(str_replace('_', ' ', $jalur)) }}
                                </span>
                            </td>

                            <td>
                                <a href="{{ route('admin.pendaftar.show', $item->id) }}" 
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-folder-open mb-2"></i><br>
                                Data tidak ditemukan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>

        <!-- PAGINATION -->
        <div class="card-footer bg-white">
            {{ $pendaftar->withQueryString()->links() }}
        </div>
    </div>

</div>
@endsection