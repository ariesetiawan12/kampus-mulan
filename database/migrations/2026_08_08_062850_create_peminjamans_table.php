<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {

            $table->id();

            // Kode transaksi
            $table->string('kode_peminjaman')->unique();

            // Anggota yang meminjam
            $table->foreignId('anggota_id')
                ->constrained('anggotas')
                ->cascadeOnDelete();

            // Tanggal transaksi
            $table->date('tanggal_pinjam');

            $table->date('tanggal_jatuh_tempo');

            // Diisi ketika buku dikembalikan
            $table->date('tanggal_kembali')->nullable();

            // Status transaksi
            $table->enum('status', [
                'Dipinjam',
                'Dikembalikan',
                'Terlambat'
            ])->default('Dipinjam');

            // Total denda
            $table->decimal('denda', 12, 2)
                ->default(0);

            // Catatan tambahan
            $table->text('keterangan')
                ->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};