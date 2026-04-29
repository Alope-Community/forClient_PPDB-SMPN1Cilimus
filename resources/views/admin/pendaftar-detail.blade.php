@extends('admin.layouts.app')

@section('title', 'Detail Pendaftar')

@section('content')
    <h3>Detail Pendaftar</h3>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- STATUS UPDATE --}}
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('admin.pendaftar.update', $pendaftaran->id) }}" method="POST">
                @method("PUT")
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <select name="status" class="form-control">
                            <option value="pending" {{ $pendaftaran->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $pendaftaran->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $pendaftaran->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="waiting_list" {{ $pendaftaran->status == 'waiting_list' ? 'selected' : '' }}>Waiting List</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- DATA --}}
    <div class="card">
        <div class="card-body">

            <h5>Identitas</h5>
            <p>Nama: {{ $pendaftaran->nama_lengkap }}</p>
            <p>NISN: {{ $pendaftaran->nisn }}</p>
            <p>Jenis Kelamin: {{ $pendaftaran->jenis_kelamin }}</p>
            <p>Tempat, Tanggal Lahir: {{ $pendaftaran->tempat_lahir }}, {{ $pendaftaran->tanggal_lahir }}</p>
            <p>Agama: {{ $pendaftaran->agama }}</p>

            <hr>

            <h5>Sekolah</h5>
            <p>Asal Sekolah: {{ $pendaftaran->asal_sd_mi }}</p>
            <p>Jalur: {{ ucwords(str_replace('_',' ',$pendaftaran->jalur_pendaftaran)) }}</p>

            <hr>

            <h5>Alamat</h5>
            <p>{{ $pendaftaran->alamat_lengkap }}</p>
            <p>No HP: {{ $pendaftaran->no_hp_siswa }}</p>

            <hr>

            <h5>Nilai</h5>
            <p>B. Indo: {{ $pendaftaran->nilai_bindo }}</p>
            <p>MTK: {{ $pendaftaran->nilai_matematika }}</p>
            <p>IPA: {{ $pendaftaran->nilai_ipa }}</p>
            <p>Total: {{ $pendaftaran->jumlah_nilai }}</p>

            <hr>

            <h5>Orang Tua</h5>
            <p>Ayah: {{ $pendaftaran->nama_ayah }}</p>
            <p>Ibu: {{ $pendaftaran->nama_ibu }}</p>
            <p>No HP: {{ $pendaftaran->no_hp_orang_tua }}</p>

            <hr>

            <h5>Dokumen</h5>
            <p>
                KK:
                @if($pendaftaran->kartu_keluarga)
                    <a href="{{ Storage::url($pendaftaran->kartu_keluarga) }}" target="_blank">Lihat</a>
                @endif
            </p>

            <p>
                Screenshot Jarak:
                @if($pendaftaran->screenshot_jarak)
                    <a href="{{ Storage::url($pendaftaran->screenshot_jarak) }}" target="_blank">Lihat</a>
                @endif
            </p>

            <p>
                KIP:
                @if($pendaftaran->kartu_kip)
                    <a href="{{ Storage::url($pendaftaran->kartu_kip) }}" target="_blank">Lihat</a>
                @endif
            </p>

            <hr>

            <a href="{{ route('admin.pendaftar.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
@endsection