<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'kode_peminjaman',
        'anggota_id',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'tanggal_kembali',
        'status',
        'denda',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_jatuh_tempo' => 'date',
        'tanggal_kembali' => 'date',
        'denda' => 'decimal:2',
    ];


    // ==========================================
    // ANGGOTA
    // ==========================================

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(
            Anggota::class,
            'anggota_id',
            'id'
        );
    }


    // ==========================================
    // DETAIL PEMINJAMAN
    // ==========================================

    public function detailPeminjamans(): HasMany
    {
        return $this->hasMany(
            DetailPeminjaman::class,
            'peminjaman_id',
            'id'
        );
    }
}