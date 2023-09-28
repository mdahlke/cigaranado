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
        Schema::create('user_cigar_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_cigar_id');
            $table->string('image');
            $table->string('thumbnail');
            $table->string('url');
            $table->string('name');
            $table->string('path');
            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_cigar_images');
    }
};
