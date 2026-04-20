<?php                                                                                                                                                                     
  use Illuminate\Database\Migrations\Migration;
  use Illuminate\Database\Schema\Blueprint;                                                                                                                                                                                                                                        
  use Illuminate\Support\Facades\Schema;
                                                                                                                                                                                                                                                                                   
  return new class extends Migration {
      public function up(): void {
          Schema::create('listening_history', function (Blueprint $table) {
              $table->id();                                                                                                                                                                                                                                                       
              $table->foreignId('user_id')->constrained()->cascadeOnDelete();
              $table->string('external_id');                                                                                                                                                                                                                                    
              $table->enum('content_type', ['podcast', 'music']);
              $table->string('title');                                                                                                                                                                                                                                          
              $table->string('feed_title')->nullable();
              $table->bigInteger('feed_id')->nullable();                                                                                                                                                                                                                        
              $table->string('image_url')->nullable();
              $table->string('audio_url')->nullable();                                                                                                                                                                                                                          
              $table->float('current_time')->default(0);
              $table->float('duration')->default(0);                                                                                                                                                                                                                            
              $table->boolean('completed')->default(false);
              $table->timestamp('last_played_at')->nullable();                                                                                                                                                                                                                  
              $table->timestamps();
              $table->unique(['user_id', 'external_id', 'content_type']);                                                                                                                                                                                                   
          });                                                                                                                                                                                                                                                                      
      }
      public function down(): void { Schema::dropIfExists('listening_history'); }                                                                                                                                                                                                
  };