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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id')->nullable(false);
            $table->foreign('karyawan_id')->references('id')->on('karyawans');
            $table->unsignedBigInteger('shift_id')->nullable(false);
            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->date('tanggal');
            $table->time('jam_mulai')->nullable();
            $table->time('jam_istirahat')->nullable();;
            $table->time('jam_selesai_istirahat')->nullable();;
            $table->time('jam_izin')->nullable();;
            $table->time('jam_selesai_izin')->nullable();;
            $table->time('jam_pulang')->nullable();
            $table->time('jam_total_produktif')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
