<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     use HasFactory;

    protected $fillable = [
        'categories_id',
        'deskripsi',
    ];
    public function pengaduan()
{
    return $this->hasMany(Pengaduan::class, 'category_id');
}

}
