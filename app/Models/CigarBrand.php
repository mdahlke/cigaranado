<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CigarBrand extends Model
{
    use HasFactory;

    public function cigars()
    {
        return $this->hasMany(Cigar::class);
    }

    /**
     * Cigar Brand belongs to one cigar manufacturer
     */
    // public function cigarManufacturer()
    // {
    //     return $this->belongsTo(CigarManufacturer::class);
    // }

    public function manufacturer()
    {
        return $this->belongsTo(CigarManufacturer::class, 'cigar_manufacturer_id');
    }
}
