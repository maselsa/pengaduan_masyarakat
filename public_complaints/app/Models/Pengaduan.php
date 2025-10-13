<?php

namespace App\Models;
use App\Models\Tanggapan;
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
        'tanggapan',
        'user_id',
        'masyarakat_id'
    ];

    public function category() //setiap pengaduan punya 1 kategori
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tanggapan() //satu pengaduan bisa punya banyak tanggapan
    {
        return $this->hasMany(Tanggapan::class, 'pengaduan_id');
    }

    public function user() //setiap pengaduan dimiliki oleh 1 user
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function masyarakat() //satu pengaduan dimiliki oleh 1 masyarakat
    {
        return $this->belongsTo(Masyarakat::class, 'masyarakat_id', 'id');
    }

}
