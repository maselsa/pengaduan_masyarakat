<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $table = 'masyarakat';

    protected $fillable = ['nama', 'email'];

    public function pengaduan()
    {
        // Hubungkan ke pengaduan via user_id
        return $this->hasMany(Pengaduan::class, 'user_id', 'id');
    }
}
