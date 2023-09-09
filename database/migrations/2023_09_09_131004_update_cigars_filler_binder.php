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
        $cigars = \App\Models\Cigar::all();
        
        Schema::table('cigars', function(Blueprint $table){
            $table->string('filler')->nullable()->change();
            $table->string('binder')->nullable()->change();
        });

        foreach($cigars as $cigar){
            $binder = \App\Models\Wrapper::where('name', $cigar->binder )->first();
            $filler = \App\Models\Wrapper::where('name', $cigar->filler)->first();

            $cigar->binder = $binder ? $binder->id : null;
            $cigar->filler = $filler ? $filler->id : null;

            $cigar->save();
        }

        Schema::table('cigars', function(Blueprint $table){
            $table->foreignId('filler')->nullable()->change();
            $table->foreignId('binder')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cigars', function(Blueprint $table){
            $table->string('filler')->nullable()->change();
            $table->string('binder')->nullable()->change();
        });

        $cigars = \App\Models\Cigar::all();
        
        foreach($cigars as $cigar){
            $binder = \App\Models\Wrapper::find($cigar->binder);
            $filler = \App\Models\Wrapper::find($cigar->filler);

            $cigar->binder = $binder ? $binder->name : null;
            $cigar->filler = $filler ? $filler->name : null;

            $cigar->save();
        }
    }
};
