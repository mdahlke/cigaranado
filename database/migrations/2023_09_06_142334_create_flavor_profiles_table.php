<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flavor_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->timestamps();
        });

        // Insert the 50 cigar flavor profiles into the table
        $flavorProfiles = [
            ['chocolate', 'Sweet'],
            ['cocoa', 'Sweet'],
            ['coffee', 'Sweet'],
            ['caramel', 'Sweet'],
            ['vanilla', 'Sweet'],
            ['honey', 'Sweet'],
            ['maple', 'Sweet'],
            ['molasses', 'Sweet'],
            ['toffee', 'Sweet'],
            ['licorice', 'Sweet'],
            ['brown sugar', 'Sweet'],
            ['marshmallow', 'Sweet'],
            ['graham cracker', 'Sweet'],
            ['toasted coconut', 'Sweet'],
            ['nougat', 'Sweet'],
            ['black pepper', 'Spicy'],
            ['cayenne pepper', 'Spicy'],
            ['red pepper', 'Spicy'],
            ['jalapeño', 'Spicy'],
            ['habanero', 'Spicy'],
            ['chili pepper', 'Spicy'],
            ['cinnamon', 'Spicy'],
            ['nutmeg', 'Spicy'],
            ['cloves', 'Spicy'],
            ['ginger', 'Spicy'],
            ['allspice', 'Spicy'],
            ['cardamom', 'Spicy'],
            ['wood', 'Earthy'],
            ['leather', 'Earthy'],
            ['tobacco', 'Earthy'],
            ['nuts', 'Earthy'],
            ['soil', 'Earthy'],
            ['mushrooms', 'Earthy'],
            ['peat', 'Earthy'],
            ['campfire', 'Earthy'],
            ['roasted coffee beans', 'Earthy'],
            ['bark', 'Earthy'],
            ['hay', 'Earthy'],
            ['straw', 'Earthy'],
            ['citrus', 'Fruity'],
            ['berries', 'Fruity'],
            ['stone fruits', 'Fruity'],
            ['dried fruits', 'Fruity'],
            ['banana', 'Fruity'],
            ['pineapple', 'Fruity'],
            ['mango', 'Fruity'],
            ['roses', 'Floral'],
            ['lavender', 'Floral'],
            ['jasmine', 'Floral'],
            ['chamomile', 'Floral'],
            ['honeysuckle', 'Floral'],
            ['hibiscus', 'Floral'],
            ['violet', 'Floral'],
            ['geranium', 'Floral'],
            ['lilac', 'Floral'],
            ['iris', 'Floral'],
            ['clover', 'Floral'],
            ['cream', 'Other'],
            ['butter', 'Other'],
            ['toast', 'Other'],
            ['roasted nuts', 'Other'],
            ['seaweed', 'Other'],
            ['salt', 'Other'],
            ['brine', 'Other'],
            ['leather', 'Other'],
            ['suede', 'Other'],
            ['musk', 'Other'],
            ['amber', 'Other'],
        ];

        foreach ($flavorProfiles as $flavorProfile) {
            DB::table('flavor_profiles')->insert([
                'name' => $flavorProfile[0],
                'category' => $flavorProfile[1],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flavor_profiles');
    }
};
