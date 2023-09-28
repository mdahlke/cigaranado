<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCigar extends Model
{
    use HasFactory;

    protected $table = 'user_cigar';

    public function cigar()
    {
        return $this->belongsTo(Cigar::class);
    }

    public function images()
    {
        return $this->hasMany(UserCigarImage::class);
    }
}
