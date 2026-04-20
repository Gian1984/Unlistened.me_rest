<?php                                                                                                                                                                                                                                                                                                             
  namespace App;                                            

  use Illuminate\Database\Eloquent\Model;

  class MusicFavorite extends Model                                                                                                                                                                                                                                                                                 
  {
      protected $fillable = [                                                                                                                                                                                                                                                                                       
          'user_id', 'jamendo_track_id', 'title', 'artist_name',
          'artist_id', 'album_name', 'album_image', 'audio_url',                                                                                                                                                                                                                                                    
          'duration', 'license_ccurl', 'shareurl',
      ];                                                                                                                                                                                                                                                                                                            
                                                            
      public function user()                                                                                                                                                                                                                                                                                        
      {                                                     
          return $this->belongsTo(\App\Models\User::class);                                                                                                                                                                                                                                                         
      }                                                     
  }
