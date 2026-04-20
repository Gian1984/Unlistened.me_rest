<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Bookmark extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'user_id', 'episode_id','title'
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
