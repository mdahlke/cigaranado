<?php

use App\Models\Cigar;
use App\Models\Wrapper;
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

        Schema::table('cigars', function($table){
            DB::table('cigars')->update(['wrapper' => null]);
            $table->integer('wrapper')->nullable()->change();
        });

        Schema::create('wrappers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $wrappers = [
            'Connecticut Shade',
            'Connecticut Broadleaf',
            'Corojo',
            'Habano',
            'Maduro',
            'Cameroon',
            'Sumatra',
            'Ecuador Connecticut',
            'San Andrés Maduro',
            'Olor Dominicano',
            'Pelo de Oro',
            'Negrito',
            'Criollo',
            'Java',
            'Corojo 99',
            'Habano 2000',
            'Habano Oscuro',
            'San Andrés Negro',
            'Brazilian Arapiraca',
            'Mexican San Andrés',
            'Nicaraguan Corojo',
        ];

        foreach($wrappers as $wrapper){
            DB::table('wrappers')->insert([
                'name' => $wrapper,
            ]);
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('cigars')->update(['wrapper' => null]);

        Schema::table('cigars', function($table){
            $table->string('wrapper')->nullable()->change();
        });

        Schema::dropIfExists('wrappers');
    }
};
