<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255); 
            $table->string('email', 100);
            $table->string('phone')->nullable(); 
            $table->date('date'); 
            $table->string('category', 100); 
            $table->text('description'); 
            $table->string('location')->nullable();
            $table->string('attachment')->nullable(); 
            $table->boolean('anonymous')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};