<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('notifikasi', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('user_id');
           $table->string('judul')->nullable(); 
           $table->string('pesan');
           $table->boolean('is_read')->default(0);
           $table->timestamps();

           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
       });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
