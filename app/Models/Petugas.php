<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'foto',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}