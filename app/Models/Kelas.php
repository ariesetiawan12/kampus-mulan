<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'kode_kelas',
        'nama_kelas',
        'jurusan',
        'tingkat',
        'wali_kelas',
        'status',
    ];

    public function anggota(): HasMany
    {
        return $this->hasMany(Anggota::class, 'kelas_id', 'id');
    }
}