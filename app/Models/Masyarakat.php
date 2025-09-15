<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $table = 'masyarakat';

    protected $fillable = [
        'nama', 
    ];

    public function pengaduan()
{
    return $this->hasMany(Pengaduan::class, 'masyarakat_id');
}

}

