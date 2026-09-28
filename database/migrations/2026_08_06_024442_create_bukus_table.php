<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bukus', function (Blueprint $table) {

            $table->id();

            $table->string('kode_buku')->unique();

            $table->string('cover')->nullable();

            $table->string('judul');

            $table->foreignId('kategori_id')
                  ->constrained('kategoris')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('rak_id')
                  ->constrained('raks')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('penulis');

            $table->string('penerbit');

            $table->year('tahun_terbit');

            $table->string('isbn')->nullable();

            $table->integer('stok')->default(0);

            $table->text('deskripsi')->nullable();

            $table->enum('status',[
                'Tersedia',
                'Dipinjam',
                'Rusak'
            ])->default('Tersedia');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};