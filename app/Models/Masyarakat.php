<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    use HasFactory;

    protected $table = 'masyarakat';

    protected $fillable = [
        'nama',
        'username',
        'password',
        'telp',
    ];

    public function pengaduan() //setiap masyarakat bisa punya banyak pengaduan
    {
        return $this->hasMany(Pengaduan::class, 'masyarakat_id');
    }
}
