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
        Schema::create('interns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('akun_id')->nullable(false);
            $table->foreign('akun_id')->references('id')->on('akuns');
            $table->unsignedBigInteger('kantor_id')->nullable(false);
            $table->foreign('kantor_id')->references('id')->on('kantors');
            $table->unsignedBigInteger('instansi_id')->nullable(false);
            $table->foreign('instansi_id')->references('id')->on('tingkats');
            $table->unsignedBigInteger('divisi_id')->nullable(false);
            $table->foreign('divisi_id')->references('id')->on('divisis');
            $table->unsignedBigInteger('shift_id')->nullable(false);
            $table->foreign('shift_id')->references('id')->on('shifts');
            $table->string('nama')->nullable(false);
            $table->string('nim')->nullable(false);
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
        Schema::dropIfExists('interns');
    }
};
