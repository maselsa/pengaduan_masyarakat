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
}