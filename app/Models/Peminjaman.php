<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'alat_id',
        'user_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'catatan',
    ];

    protected $casts = [
        'tanggal_pinjam' => 'date',
        'tanggal_kembali' => 'date',
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
