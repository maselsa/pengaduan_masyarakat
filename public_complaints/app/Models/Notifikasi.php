<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $table = 'notifikasi';

    protected $fillable = [
        'user_id', 
        'pesan', 
        'judul',
        'is_read'
    ];

    public function user() //setiap notifikasi dimiliki oleh 1 user
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}


