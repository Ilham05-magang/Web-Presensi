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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('akun_id')->nullable(false);
            $table->foreign('akun_id')->references('id')->on('users');
            $table->unsignedBigInteger('kantor_id')->nullable();
            $table->foreign('kantor_id')->references('id')->on('kantors');
            $table->unsignedBigInteger('divisi_id')->nullable();
            $table->foreign('divisi_id')->references('id')->on('divisis');
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->string('nama')->nullable(false);
            $table->string('nip')->nullable();
            $table->string('telepon')->nullable(false);
            $table->string('ttl')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
