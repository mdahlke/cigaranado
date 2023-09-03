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
        Schema::create('cigar', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->string('type');
            $table->string('wrapper');
            $table->string('binder');
            $table->string('filler');
            $table->enum ('strength', ['Mild', 'Medium', 'Full']);
            $table->string('origin');
            $table->enum('flavor_profile', ['Mellow', 'Spicy', 'Savory', 'Earthy', 'Nutty', 'Creamy', 'Fruity', 'Floral', 'Herbal', 'Woody', 'Cocoa', 'Coffee', 'Peppery', 'Cedar', 'Leathery', 'Chocolate', 'Caramel', 'Vanilla', 'Citrus', 'Peaty', 'Smoky', 'Tobacco', 'Honey', 'Malty', 'Buttery', 'Grassy', 'Mineral', 'Salty', 'Sour', 'Tart', 'Tangy', 'Zesty', 'Bitter', 'Smokey', 'Syrupy', 'Funky', 'Gamey', 'Mushroom', 'Pungent', 'Skunky', 'Stinky', 'Sweet', 'Tropical', 'Waxy', 'Winey',]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cigars');
    }
};
