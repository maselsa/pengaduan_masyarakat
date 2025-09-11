<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'categories';

    // Kolom yang bisa diisi
    protected $fillable = [
        'name',
        'deskripsi',
    ];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'category');
    }
}
