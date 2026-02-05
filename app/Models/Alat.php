<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_alat',
        'kode_alat',
        'kategori_id',
        'stok',
        'status',
        'deskripsi'
    ];

    public function getStatusAttribute()
    {
        return $this->stok > 0 ? 'tersedia' : 'habis';
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
