<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';
    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nip',
        'nama_guru',
        'mapel',
        'jenis_kelamin',
        'foto',
    ];
}