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
        Schema::create('user_cigar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cigar_id')->constrained()->cascadeOnDelete();
            $table->integer('rating')->nullable();
            $table->string('review')->nullable();
            $table->string('draw')->nullable();
            $table->string('burn')->nullable();
            $table->string('flavor')->nullable();
            $table->enum('body', ['Mild', 'Medium', 'Full'])->nullable();
            $table->string('location')->nullable();
            $table->date('date')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_cigars');
    }
};
