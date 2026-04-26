<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Pendaftaran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "pendaftaran";

    protected $fillable = [
        'nama_lengkap', 'nisn', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin',
        'alamat_lengkap', 'umur', 'asal_sekolah', 'jalur_pendaftaran',
        'ijazah_skl', 'akta_kelahiran', 'kartu_keluarga', 'ktp_orang_tua',
        'sptjm', 'ijazah_madrasah', 'latitude', 'longitude', 'screenshot_jarak',
        'kartu_bansos_sktm', 'surat_tanggung_jawab', 'surat_disabilitas',
        'rapor_5_semester', 'surat_peringkat', 'sertifikat_piagam',
        'surat_keterangan_prestasi', 'surat_pindah_tugas', 'surat_guru',
        'status', 'catatan_admin', 'email', 'no_hp', 'uuid'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'verified_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    // Scopes
    public function scopeZonasi($query)
    {
        return $query->where('jalur_pendaftaran', 'zonasi');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->nama_lengkap;
    }

    public function getAgeAttribute()
    {
        return $this->umur;
    }
}