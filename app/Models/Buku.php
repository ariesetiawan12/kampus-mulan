<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    protected $table = 'bukus';

    protected $fillable = [
        'kode_buku',
        'cover',
        'judul',
        'kategori_id',
        'rak_id',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'stok',
        'deskripsi',
        'status',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELASI KATEGORI
    |--------------------------------------------------------------------------
    */

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(
            Kategori::class,
            'kategori_id',
            'id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI RAK
    |--------------------------------------------------------------------------
    */

    public function rak(): BelongsTo
    {
        return $this->belongsTo(
            Rak::class,
            'rak_id',
            'id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | RELASI DETAIL PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    public function detailPeminjamans(): HasMany
    {
        return $this->hasMany(
            DetailPeminjaman::class,
            'buku_id',
            'id'
        );
    }
}