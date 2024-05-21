<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class Faq extends Model
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $fillable = [
         'user_id', 'username','email', 'message_obj', 'message_desc'
    ];


    public function users(){
        return $this->hasMany(User::class);
    }
}
