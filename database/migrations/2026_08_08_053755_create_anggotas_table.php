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
        Schema::create('anggotas', function (Blueprint $table) {

            $table->id();

            // Kode anggota otomatis
            $table->string('kode_anggota')->unique();

            // NIS siswa
            $table->string('nis')->unique();

            // Nama siswa
            $table->string('nama');

            // Relasi ke tabel kelas
            $table->foreignId('kelas_id')
                ->constrained('kelas')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Jenis kelamin
            $table->enum('jenis_kelamin', ['L', 'P']);

            // Nomor HP
            $table->string('no_hp')->nullable();

            // Alamat
            $table->text('alamat')->nullable();

            // Status anggota
            $table->enum('status', ['Aktif', 'Nonaktif'])
                ->default('Aktif');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};