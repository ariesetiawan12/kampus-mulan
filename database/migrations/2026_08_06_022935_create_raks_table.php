<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('raks', function (Blueprint $table) {

            $table->id();

            $table->string('kode_rak')->unique();

            $table->string('nama_rak');

            $table->string('lokasi');

            $table->enum('status',[
                'Aktif',
                'Nonaktif'
            ])->default('Aktif');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('raks');
    }
};