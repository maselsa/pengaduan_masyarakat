<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('tanggapan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('pengaduan_id');
        $table->unsignedBigInteger('admin_id');
        $table->text('tanggapan');
        $table->timestamps();

        $table->foreign('pengaduan_id')->references('id')->on('pengaduan')->onDelete('cascade');
        $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    public function down()
    {
        Schema::dropIfExists('tanggapan');
    }
};
