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
        Schema::create('gaji_headers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gaji_id')->nullable();
            $table->foreign('gaji_id')->references('id')->on('gaji_karyawans')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->integer('value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gaji_headers');
    }
};
