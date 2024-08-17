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
        Schema::create('contributors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('akun_id')->nullable(false);
            $table->foreign('akun_id')->references('id')->on('akuns');
            $table->unsignedBigInteger('instansi_id')->nullable(false);
            $table->foreign('instansi_id')->references('id')->on('instansis');
            $table->string('nama')->nullable(false);
            $table->string('nip')->nullable(false);
            $table->string('telepon')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributors');
    }
};
