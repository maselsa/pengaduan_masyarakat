<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = 'tanggapan';

    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'isi',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}