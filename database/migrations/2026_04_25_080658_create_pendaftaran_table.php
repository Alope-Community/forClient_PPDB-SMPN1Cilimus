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
            $table->string('uuid')->unique(); // No pendaftaran unik
            
            // === IDENTITAS CALON PESERTA DIDIK (1-17) ===
            $table->string('asal_sd_mi');
            $table->enum('jalur_pendaftaran', [
                'domisili',
                'afirmasi',
                'prestasi_akademik',
                'prestasi_non_akademik',
                'mutasi'
            ]);
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('nisn')->unique();
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir'); // Format teks "01 Januari 2009"
            $table->boolean('pernah_paud')->default(false);
            $table->boolean('pernah_tk')->default(false);
            $table->boolean('tidak_pernah_paud_tk')->default(false);
            $table->string('hobby')->nullable();
            $table->string('cita_cita')->nullable();
            $table->decimal('tinggi_badan', 5, 2);
            $table->decimal('berat_badan', 5, 2);
            $table->decimal('lingkar_kepala', 5, 2);
            $table->integer('anak_ke');
            $table->integer('jumlah_saudara');
            $table->enum('memiliki_kip', ['Ya', 'Tidak']);
            
            // === ALAMAT & KONTAK (18-28) ===
            $table->enum('agama', [
                'Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'
            ]);
            $table->text('alamat_lengkap');
            $table->string('titik_koordinat'); // "-6.873307, 108.494803"
            $table->decimal('jarak_rumah', 8, 2); // Jarak dalam meter
            $table->string('no_hp_siswa');
            $table->string('email_siswa')->nullable();
            $table->json('sosmed')->nullable(); // Array akun sosial media
            
            // === DOKUMEN ===
            $table->string('kartu_kip')->nullable();
            $table->string('screenshot_jarak')->nullable();
            $table->string('kartu_keluarga')->nullable();
            
            // === NILAI RAPORT (29-32) ===
            $table->decimal('nilai_bindo', 8, 2);
            $table->decimal('nilai_matematika', 8, 2);
            $table->decimal('nilai_ipa', 8, 2);
            $table->decimal('jumlah_nilai', 8, 2);
            
            // === PRESTASI NON AKADEMIK (33-37) ===
            $table->string('event_kejuaraan')->nullable();
            $table->string('tingkat_kejuaraan')->nullable(); // Kecamatan, Kabupaten, dll
            $table->string('peringkat_kejuaraan')->nullable(); // Juara 1, 2, 3
            $table->string('penyelenggara')->nullable();
            $table->string('sertifikat_kejuaraan')->nullable();
            
            // === DATA ORANG TUA/WALI (38-50) ===
            $table->string('nama_ayah');
            $table->string('tempat_lahir_ayah');
            $table->string('tanggal_lahir_ayah');
            $table->enum('agama_ayah', [
                'Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'
            ]);
            $table->string('pekerjaan_ayah');
            $table->enum('pendidikan_ayah', [
                'SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2'
            ]);
            
            $table->string('nama_ibu');
            $table->string('tempat_lahir_ibu');
            $table->string('tanggal_lahir_ibu');
            $table->string('pekerjaan_ibu');
            $table->enum('pendidikan_ibu', [
                'SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2'
            ]);
            
            $table->text('alamat_orang_tua');
            $table->string('no_hp_orang_tua');
            
            // === STATUS & TRACKING ===
            $table->enum('status', ['draft', 'pending', 'approved', 'rejected', 'waiting_list'])
                  ->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->integer('peringkat')->nullable(); // Peringkat akhir
            
            $table->timestamps();
            $table->softDeletes();
            
            // === INDEX & CONSTRAINT ===
            $table->index(['nisn', 'status']);
            $table->index('jalur_pendaftaran');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
};