<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CigarManufacturer extends Model
{
    use HasFactory;
    
    protected $table = 'cigar_manufacturers';

    // public function cigarBrand()
    // {
    //     return $this->hasMany(CigarBrand::class);
    // }
    public function brands()
    {
        return $this->hasMany(CigarBrand::class);
    }
}
