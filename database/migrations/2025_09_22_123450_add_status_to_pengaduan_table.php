<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToPengaduanTable extends Migration
{
    public function up() //menambahkan kolom status ke tabel pengaduan dengan default pending.
    {
        Schema::table('pengaduan', function (Blueprint $table) {
        $table->enum('status', ['pending', 'proses', 'selesai', 'tolak'])->default('pending');
       });
    }

    public function down() //menghapus kolom status dari tabel pengaduan saat rollback dijalankan.
    {
        Schema::table('pengaduan', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
    
}