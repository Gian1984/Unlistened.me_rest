<?php                                                                                                                                                                                                                                                                                                             
  namespace App;
                                                                                                                                                                                                                                                                                                                    
  use Illuminate\Database\Eloquent\Model;                   

  class MusicPlaylistTrack extends Model
  {
      protected $fillable = [
          'playlist_id', 'jamendo_track_id', 'title', 'artist_name',
          'artist_id', 'album_image', 'audio_url', 'duration',                                                                                                                                                                                                                                                      
          'license_ccurl', 'position',
      ];                                                                                                                                                                                                                                                                                                            
                                                            
      public function playlist()                                                                                                                                                                                                                                                                                    
      {                                                     
          return $this->belongsTo(MusicPlaylist::class);
      }
  }
