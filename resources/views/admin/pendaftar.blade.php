@extends('admin.layouts.app')

@section('title', 'Pendaftar')

@section('content')
    <h3>Data Pendaftar</h3>

    {{-- SEARCH --}}
    <form method="GET" action="{{ route('admin.pendaftar.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control"
                       placeholder="Cari nama / NISN..."
                       value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Asal Sekolah</th>
                <th>Jalur</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pendaftar as $item)
                <tr>
                    <td>{{ $loop->iteration + ($pendaftar->firstItem() - 1) }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->asal_sd_mi }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $item->jalur_pendaftaran)) }}</td>
                    <td>
                        <a href="{{ route('admin.pendaftar.show', $item->id) }}" 
                           class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $pendaftar->links() }}
@endsection