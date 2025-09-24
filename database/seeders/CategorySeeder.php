<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create(['name' => 'Kriminal', 'deskripsi' => 'Kasus kriminal']);
        Category::create(['name' => 'Infrastruktur', 'deskripsi' => 'Jalan, jembatan, dll']);
        Category::create(['name' => 'Kesehatan', 'deskripsi' => 'Layanan kesehatan']);
    }
}

