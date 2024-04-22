<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

class Podcast extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
        'podcast_id', 'title'
    ];

    public function favoritedBy() {
        return $this->hasMany(Favorite::class);
    }
}
