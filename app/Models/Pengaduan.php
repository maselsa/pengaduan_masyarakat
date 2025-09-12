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
    'category',
    'deskripsi',
    'bukti',
];

public function category()
{
    return $this->belongsTo(Category::class, 'category', 'id');

}
public function tanggapan()
{
    return $this->hasOne(Tanggapan::class, 'pengaduan_id');
}
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}