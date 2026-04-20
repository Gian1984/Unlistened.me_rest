<?php                                                                                                                                                                                                         
  namespace App\Http\Models;                                                                                                                                                                                                                                                       
                                                                                                                                                                                                                                                                                   
  use Illuminate\Database\Eloquent\Model;                                                                                                                                                                                                                                          
                  
  class ListeningHistory extends Model {
      protected $fillable = [
          'user_id','external_id','content_type','title',                                                                                                                                                                                                                  
          'feed_title','feed_id','image_url','audio_url',
          'current_time','duration','completed','last_played_at',                                                                                                                                                                                                          
      ];                                                                                                                                                                                                                                                                           
      protected $casts = [
          'completed'      => 'boolean',                                                                                                                                                                                                                                       
          'current_time'   => 'float',
          'duration'       => 'float',
          'last_played_at' => 'datetime',                                                                                                                                                                                                                                      
      ];
      public function user() { return $this->belongsTo(User::class); }                                                                                                                                                                                                            
  }