<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
    'nama',
    'email',
    'no_hp',
    'tanggal',
    'lokasi',
    'category_id',
    'deskripsi',
    'bukti',
    'status',
    'tanggapan_admin',
    'user_id',
    'masyarakat_id'
];

    public function category()
    {
    return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tanggapan()
    {
       return $this->hasOne(Tanggapan::class, 'pengaduan_id');
    }

    public function user()
    {
       return $this->belongsTo(User::class, 'user_id');
    }

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'masyarakat_id');
    }
    public function feedback()
    {
        return $this->hasMany(feedback::class, 'pengaduan_id');
    }
}