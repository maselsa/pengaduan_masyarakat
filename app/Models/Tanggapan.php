<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';
    
    protected $fillable = [
        'pengaduan_id',
        'user_id',
        'isi',
        'status'
    ];

    public function pengaduan() //setiap tanggapan dimiliki oleh 1 pengaduan
    {
        return $this->belongsTo(Pengaduan::class, 'pengaduan_id', 'id');
    }

    public function user() //setiap tanggapan dimiliki oleh 1 user
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
