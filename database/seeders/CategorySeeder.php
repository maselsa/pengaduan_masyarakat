<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['nama' => 'Kriminal', 'deskripsi' => 'Kasus kriminal']);
        Category::create(['nama' => 'Infrastruktur', 'deskripsi' => 'Jalan, jembatan, dll']);
        Category::create(['nama' => 'Kesehatan', 'deskripsi' => 'Layanan kesehatan']);
    }
}

