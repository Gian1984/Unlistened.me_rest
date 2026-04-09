<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('music_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('jamendo_track_id');
            $table->string('title');
            $table->string('artist_name');
            $table->string('artist_id');
            $table->string('album_name')->nullable();
            $table->string('album_image')->nullable();
            $table->string('audio_url');
            $table->integer('duration')->default(0);
            $table->string('license_ccurl')->nullable();
            $table->string('shareurl')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'jamendo_track_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('music_favorites');
    }
};
