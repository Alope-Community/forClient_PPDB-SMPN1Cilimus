<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            
            // 1. DATA UTAMA CALON SISWA
            $table->string('nama_lengkap');
            $table->string('nisn')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat_lengkap');
            $table->integer('umur');
            $table->string('asal_sekolah');
            $table->enum('jalur_pendaftaran', [
                'zonasi', 
                'afirmasi', 
                'prestasi', 
                'perpindahan'
            ]);
            
            // 2. DOKUMEN WAJIB
            $table->string('ijazah_skl')->nullable();
            $table->string('akta_kelahiran')->nullable();
            $table->string('kartu_keluarga')->nullable();
            $table->string('ktp_orang_tua')->nullable();
            $table->string('sptjm')->nullable();
            $table->string('ijazah_madrasah')->nullable();
            
            // 3. DATA JALUR ZONASI
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('screenshot_jarak')->nullable();
            
            // 4. DATA JALUR AFIRMSI
            $table->string('kartu_bansos_sktm')->nullable();
            $table->string('surat_tanggung_jawab')->nullable();
            $table->string('surat_disabilitas')->nullable();
            
            // 5. DATA JALUR PRESTASI
            $table->string('rapor_5_semester')->nullable();
            $table->string('surat_peringkat')->nullable();
            $table->string('sertifikat_piagam')->nullable();
            $table->string('surat_keterangan_prestasi')->nullable();
            
            // 6. DATA JALUR PERPINDAHAN
            $table->string('surat_pindah_tugas')->nullable();
            $table->string('surat_guru')->nullable();
            
            // STATUS PENDAFTARAN
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected'])->default('draft');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('verified_at')->nullable();
            
            // DATA TAMBAHAN
            $table->string('email')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('uuid')->unique(); // Untuk tracking unik
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
};