                                                                                                                                                                                                                                                                     
      public function reorder(Request $request) {                                                                                                                                                                                                                                 
          $v = $request->validate([                                                                                                                                                                                                                                              
              'tracks'                     => 'required|array',                                                                                                                                                                                                                
              'tracks.*.jamendo_track_id'  => 'required|string',                                                                                                                                                                                                               
              'tracks.*.position'          => 'required|integer',
          ]);                                                                                                                                                                                                                                                                      
          foreach ($v['tracks'] as $item) {
              MusicFavorite::where('user_id', $request->user()->id)                                                                                                                                                                                                             
                  ->where('jamendo_track_id', $item['jamendo_track_id'])
                  ->update(['position' => $item['position']]);                                                                                                                                                                                                                
          }                                                        
          return response()->json(['message' => 'Order saved']);                                                                                                                                                                                                               
      }                                                                                                                                                                                                                                                                            
  
    public function reorder(Request $request) {
        $v = $request->validate([
            'tracks'                    => 'required|array',
            'tracks.*.jamendo_track_id' => 'required|string',
            'tracks.*.position'         => 'required|integer',
        ]);
        foreach ($v['tracks'] as $item) {
            MusicFavorite::where('user_id', $request->user()->id)
                ->where('jamendo_track_id', $item['jamendo_track_id'])
                ->update(['position' => $item['position']]);
        }
        return response()->json(['message' => 'Order saved']);
    }
}