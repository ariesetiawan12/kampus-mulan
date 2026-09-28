<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {

            $table->id();

            $table->string('kode_kelas')->unique();

            $table->string('nama_kelas');

            $table->string('jurusan');

            $table->enum('tingkat',[
                'X',
                'XI',
                'XII'
            ]);

            $table->string('wali_kelas')->nullable();

            $table->enum('status',[
                'Aktif',
                'Nonaktif'
            ])->default('Aktif');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};