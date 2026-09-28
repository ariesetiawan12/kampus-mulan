<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    protected $table = 'anggotas';

    protected $fillable = [
        'kode_anggota',
        'nis',
        'nama',
        'kelas_id',
        'jenis_kelamin',
        'no_hp',
        'alamat',
        'status',
    ];

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
    public function peminjamans(): HasMany
{
    return $this->hasMany(
        Peminjaman::class,
        'anggota_id',
        'id'
    );
}
}