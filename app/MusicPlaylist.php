<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicPlaylist extends Model
{
    protected $fillable = ['user_id', 'name', 'description'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function tracks()
    {
        return $this->hasMany(MusicPlaylistTrack::class, 'playlist_id')->orderBy('position');
    }
}
