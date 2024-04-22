<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'user_id', 'podcast_id','title'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If you store reference to a 'Podcast' or other item, ensure that relationship is defined here
    public function podcast()
    {
        return $this->belongsTo(Podcast::class);
    }
}
