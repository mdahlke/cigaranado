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
        Schema::table('cigars', function (Blueprint $table) {
            $table->enum('wrapper', [
                'Connecticut Shade', 'Connecticut Broadleaf', 'Corojo', 'Habano', 'Maduro', 'Cameroon', 'Sumatra', 'Ecuador Connecticut', 'San Andrés Maduro', 'Olor Dominicano', 'Pelo de Oro', 'Negrito', 'Criollo', 'Java', 'Corojo 99', 'Habano 2000', 'Habano Oscuro', 'San Andrés Negro', 'Brazilian Arapiraca', 'Mexican San Andrés', 'Nicaraguan Corojo'
            ])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cigars', function (Blueprint $table) {
            $table->string('wrapper')->change();

        });
    }
};
