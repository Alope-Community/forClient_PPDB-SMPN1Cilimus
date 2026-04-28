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

    protected $guarded = ["id"];

    protected $casts = [
        'sosmed' => 'array',
        'pernah_paud' => 'boolean',
        'pernah_tk' => 'boolean',
        'tidak_pernah_paud_tk' => 'boolean',
    ];

    protected $appends = ['nama_lengkap_display'];

    public function getNamaLengkapDisplayAttribute()
    {
        return strtoupper($this->nama_lengkap);
    }
}