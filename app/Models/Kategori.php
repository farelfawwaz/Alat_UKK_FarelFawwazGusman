<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kategori extends Model
{
    protected $table = 'kategori'; // ⬅️ WAJIB karena tabel bukan plural

    protected $fillable = [
        'name',
        'slug',
        'deskripsi'
    ];

    protected static function booted()
    {
        static::creating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->name);
        });
    }

    public function alats()
    {
        return $this->hasMany(Alat::class);
    }
}
