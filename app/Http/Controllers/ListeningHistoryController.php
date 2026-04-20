<?php                                                                                                                                                                                          
  namespace App\Http\Controllers;
                                                                                                                                                                                                                                                                                   
  use App\Http\Models\ListeningHistory;                                                                                                                                                                                                                                            
  use Illuminate\Http\Request;
                                                                                                                                                                                                                                                                                   
  class ListeningHistoryController extends Controller {

      public function index(Request $request) {
          $history = ListeningHistory::where('user_id', $request->user()->id)
              ->orderBy('last_played_at', 'desc')                                                                                                                                                                                                                              
              ->limit(50)->get();
          return response()->json(['data' => $history]);                                                                                                                                                                                                                        
      }                                                                                                                                                                                                                                                                            
   
      public function upsert(Request $request) {                                                                                                                                                                                                                                  
          $v = $request->validate([
              'external_id'    => 'required|string',                                                                                                                                                                                                                           
              'content_type'   => 'required|in:podcast,music',
              'title'          => 'required|string',                                                                                                                                                                                                                           
              'feed_title'     => 'nullable|string',
              'feed_id'        => 'nullable|integer',                                                                                                                                                                                                                          
              'image_url'      => 'nullable|string',
              'audio_url'      => 'nullable|string',                                                                                                                                                                                                                           
              'current_time'   => 'nullable|numeric',
              'duration'       => 'nullable|numeric',                                                                                                                                                                                                                          
              'completed'      => 'nullable|boolean',
              'last_played_at' => 'nullable|date',                                                                                                                                                                                                                             
          ]);
          $entry = ListeningHistory::updateOrCreate(                                                                                                                                                                                                                              
              ['user_id' => $request->user()->id, 'external_id' => $v['external_id'], 'content_type' => $v['content_type']],
              array_merge($v, ['user_id' => $request->user()->id, 'last_played_at' => $v['last_played_at'] ?? now()])                                                                                                                                                     
          );                                                                                                                                                                                                                                                                       
          return response()->json(['data' => $entry], 201);                                                                                                                                                                                                                     
      }                                                                                                                                                                                                                                                                            
                  
      public function update(Request $request, $id) {
          $entry = ListeningHistory::where('user_id', $request->user()->id)->findOrFail($id);
          $v = $request->validate([                                                                                                                                                                                                                                              
              'current_time' => 'nullable|numeric',
              'duration'     => 'nullable|numeric',                                                                                                                                                                                                                            
              'completed'    => 'nullable|boolean',
          ]);                                                                                                                                                                                                                                                                      
          $entry->update(array_merge($v, ['last_played_at' => now()]));
          return response()->json(['data' => $entry]);                                                                                                                                                                                                                          
      }
                                                                                                                                                                                                                                                                                   
      public function destroy(Request $request, $id) {
          ListeningHistory::where('user_id', $request->user()->id)->findOrFail($id)->delete();
          return response()->json(['message' => 'Removed']);                                                                                                                                                                                                                   
      }
                                                                                                                                                                                                                                                                                   
      public function clear(Request $request) {
          ListeningHistory::where('user_id', $request->user()->id)->delete();                                                                                                                                                                                                   
          return response()->json(['message' => 'History cleared']);
      }
  }