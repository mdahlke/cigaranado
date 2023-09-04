<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $user_id
 * @property int $cigar_id
 * @property int $rating
 * @property string $review
 * @property string $draw
 * @property string $burn
 * @property string $flavor
 * @property string $body
 * @property string $location
 * @property string $date
 * @property Image $image
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Cigar extends Model
{
    use HasFactory;
    
    protected $table = 'cigars';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_cigar');
    }

    public function brand()
    {
        return $this->belongsTo(CigarBrand::class, 'cigar_brand_id');
    }

    public function userCigars()
    {
        return $this->hasMany(UserCigar::class);
    }
}
