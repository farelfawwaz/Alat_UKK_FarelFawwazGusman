<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activitylog extends Model
{

    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'aksi',
        'modul',
        'deskripsi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
