<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alat extends Model
{
    use HasFactory;

    protected $fillable =[
        'nama_alat',
        'kode_alat',
        'kategori',
        'stok',
        'status',
        'deskripsi'
    ];
}
