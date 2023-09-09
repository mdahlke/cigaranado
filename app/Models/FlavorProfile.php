<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class FlavorProfile extends Model
{
    use HasFactory;

    protected $table = 'flavor_profiles';

    protected $fillable = [
        'name',
    ];

    public function cigars(): BelongsToMany
    {
        return $this->belongsToMany(Cigar::class, 'cigar_flavor_profiles');
    }
}
