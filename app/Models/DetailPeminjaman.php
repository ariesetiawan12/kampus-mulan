<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjamans';

    protected $fillable = [
        'peminjaman_id',
        'buku_id',
        'status',
    ];


    // ==========================================
    // PEMINJAMAN
    // ==========================================

    public function peminjaman(): BelongsTo
    {
        return $this->belongsTo(
            Peminjaman::class,
            'peminjaman_id',
            'id'
        );
    }


    // ==========================================
    // BUKU
    // ==========================================

    public function buku(): BelongsTo
    {
        return $this->belongsTo(
            Buku::class,
            'buku_id',
            'id'
        );
    }
}