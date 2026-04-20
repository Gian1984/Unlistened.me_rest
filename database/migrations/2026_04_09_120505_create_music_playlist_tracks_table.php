<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up(): void
  {                                                                                                                                                                                                                                                                                                                 
      Schema::create('music_playlist_tracks', function (Blueprint $table) {
          $table->id();
          $table->foreignId('playlist_id')->constrained('music_playlists')->cascadeOnDelete();
          $table->string('jamendo_track_id');                                                                                                                                                                                                                                                                       
          $table->string('title');
          $table->string('artist_name');                                                                                                                                                                                                                                                                            
          $table->string('artist_id');                                                                                                                                                                                                                                                                              
          $table->string('album_image')->nullable();
          $table->string('audio_url');                                                                                                                                                                                                                                                                              
          $table->integer('duration')->default(0);          
          $table->string('license_ccurl')->nullable();                                                                                                                                                                                                                                                              
          $table->unsignedInteger('position')->default(0);
          $table->timestamps();                                                                                                                                                                                                                                                                                     
          $table->unique(['playlist_id', 'jamendo_track_id']);
      });                                                                                                                                                                                                                                                                                                           
  }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_playlist_tracks');
    }
};
