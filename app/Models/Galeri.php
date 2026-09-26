<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeris';
    protected $primaryKey = 'id_galeri';
    public $timestamps = false;

    // INI YANG PALING PENTING AGAR DATA MASUK KE DATABASE:
    protected $fillable = [
        'judul',
        'keterangan',
        'file',
        'kategori',
        'tanggal',
    ];
}