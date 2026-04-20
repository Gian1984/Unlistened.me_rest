<?php                                                     
  namespace App\Http\Controllers;

  use App\MusicPlaylist;
  use App\MusicPlaylistTrack;
  use Illuminate\Http\Request;                                                                                                                                                                                                                                                                                      
   
  class MusicPlaylistController extends Controller                                                                                                                                                                                                                                                                  
  {                                                         
      public function index(Request $request)
      {
          return response()->json(
              MusicPlaylist::where('user_id', $request->user()->id)
                  ->withCount('tracks')                                                                                                                                                                                                                                                                             
                  ->orderBy('created_at', 'desc')
                  ->get()                                                                                                                                                                                                                                                                                           
          );                                                
      }

      public function store(Request $request)                                                                                                                                                                                                                                                                       
      {
          $request->validate(['name' => 'required|string|max:100']);                                                                                                                                                                                                                                                
                                                            
          $playlist = MusicPlaylist::create([                                                                                                                                                                                                                                                                       
              'user_id'     => $request->user()->id,
              'name'        => $request->name,                                                                                                                                                                                                                                                                      
              'description' => $request->description,       
          ]);
                                                                                                                                                                                                                                                                                                                    
          return response()->json($playlist, 201);
      }                                                                                                                                                                                                                                                                                                             
                                                            
      public function show(Request $request, int $id)
      {
          $playlist = MusicPlaylist::where('user_id', $request->user()->id)
              ->with('tracks')                                                                                                                                                                                                                                                                                      
              ->findOrFail($id);
                                                                                                                                                                                                                                                                                                                    
          return response()->json($playlist);               
      }

      public function update(Request $request, int $id)
      {
          $playlist = MusicPlaylist::where('user_id', $request->user()->id)->findOrFail($id);                                                                                                                                                                                                                       
          $playlist->update($request->only(['name', 'description']));
          return response()->json($playlist);                                                                                                                                                                                                                                                                       
      }                                                     
                                                                                                                                                                                                                                                                                                                    
      public function destroy(Request $request, int $id)    
      {
          MusicPlaylist::where('user_id', $request->user()->id)->findOrFail($id)->delete();
          return response()->json(['message' => 'Playlist deleted']);                                                                                                                                                                                                                                               
      }
                                                                                                                                                                                                                                                                                                                    
      public function addTrack(Request $request, int $id)   
      {
          $request->validate([                                                                                                                                                                                                                                                                                      
              'jamendo_track_id' => 'required|string',
              'title'            => 'required|string',                                                                                                                                                                                                                                                              
              'artist_name'      => 'required|string',      
              'artist_id'        => 'required|string',                                                                                                                                                                                                                                                              
              'audio_url'        => 'required|string',
          ]);                                                                                                                                                                                                                                                                                                       
                                                            
          $playlist = MusicPlaylist::where('user_id', $request->user()->id)->findOrFail($id);                                                                                                                                                                                                                       
  
          $position = MusicPlaylistTrack::where('playlist_id', $id)->max('position') + 1;                                                                                                                                                                                                                           
                                                            
          $track = MusicPlaylistTrack::firstOrCreate(                                                                                                                                                                                                                                                               
              ['playlist_id' => $id, 'jamendo_track_id' => $request->jamendo_track_id],
              array_merge(                                                                                                                                                                                                                                                                                          
                  $request->only(['title','artist_name','artist_id','album_image','audio_url','duration','license_ccurl']),
                  ['position' => $position]                                                                                                                                                                                                                                                                         
              )                                             
          );                                                                                                                                                                                                                                                                                                        
                                                            
          return response()->json($track, 201);
      }

      public function removeTrack(Request $request, int $id, string $trackId)                                                                                                                                                                                                                                       
      {
          MusicPlaylist::where('user_id', $request->user()->id)->findOrFail($id);                                                                                                                                                                                                                                   
                                                            
          MusicPlaylistTrack::where('playlist_id', $id)                                                                                                                                                                                                                                                             
              ->where('jamendo_track_id', $trackId)
              ->delete();                                                                                                                                                                                                                                                                                           
                                                            
          return response()->json(['message' => 'Track removed']);                                                                                                                                                                                                                                                  
      }
                                                                                                                                                                                                                                                                                                                    
      public function reorder(Request $request, int $id)    
      {
          MusicPlaylist::where('user_id', $request->user()->id)->findOrFail($id);
                                                                                                                                                                                                                                                                                                                    
          foreach ($request->tracks as $item) {
              MusicPlaylistTrack::where('playlist_id', $id)                                                                                                                                                                                                                                                         
                  ->where('jamendo_track_id', $item['jamendo_track_id'])
                  ->update(['position' => $item['position']]);                                                                                                                                                                                                                                                      
          }
                                                                                                                                                                                                                                                                                                                    
          return response()->json(['message' => 'Order updated']);
      }
  }
