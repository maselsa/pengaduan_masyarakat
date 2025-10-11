<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // nama tabel di database
    protected $table = 'categories';

    // kolom yang bisa diisi
    protected $fillable = [
        'name',
        'deskripsi',
    ];

    public function pengaduan() //satu kategori banyak pengaduan
    {
        return $this->hasMany(Pengaduan::class, 'category_id');
    }
}
