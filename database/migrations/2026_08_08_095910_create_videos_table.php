<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('video_title');
            $table->foreignId('video_artist_id')->constrained('artists')->onDelete('cascade');
            $table->foreignId('video_album_id')->nullable()->constrained('albums')->onDelete('set null');
            $table->foreignId('video_genre_id')->nullable()->constrained('genres')->onDelete('set null');
            $table->foreignId('video_language_id')->nullable()->constrained('languages')->onDelete('set null');
            $table->string('video_year', 4)->nullable();
            $table->text('video_description')->nullable();
            $table->string('video_file_path')->nullable();
            $table->string('video_image_path')->nullable();
            $table->string('video_duration', 20)->nullable();
            $table->enum('video_is_new', ['yes', 'no'])->default('no');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};