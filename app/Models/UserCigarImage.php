<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCigarImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_cigar_id',
        'image',
        'thumbnail',
        'url',
        'name',
        'type',
        'path',
    ];

    public function userCigar()
    {
        return $this->belongsTo(UserCigar::class);
    }
}
