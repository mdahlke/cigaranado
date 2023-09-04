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
        Schema::create('cigar_brands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cigar_manufacturer_id')->nullable();
            $table->string('name')->required();
            $table->timestamps();
        });

        Schema::table('cigars', function (Blueprint $table) {
            $table->foreignId('cigar_brand_id')->nullable();
            $table->dropColumn('brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cigar_brands');

        Schema::table('cigars', function (Blueprint $table) {
            $table->dropColumn('cigar_brand_id');
            $table->string('brand');
        });
    }
};
