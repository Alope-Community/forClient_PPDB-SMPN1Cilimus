<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {

            $table->bigInteger('kk_size_awal')->nullable();
            $table->bigInteger('kk_size_akhir')->nullable();

            $table->bigInteger('kip_size_awal')->nullable();
            $table->bigInteger('kip_size_akhir')->nullable();

            $table->bigInteger('screenshot_size_awal')->nullable();
            $table->bigInteger('screenshot_size_akhir')->nullable();

            $table->bigInteger('sertifikat_size_awal')->nullable();
            $table->bigInteger('sertifikat_size_akhir')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            //
        });
    }
};
