<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->string('music_title');
            $table->foreignId('music_artist_id')->constrained('artists')->onDelete('cascade');
            $table->foreignId('music_album_id')->nullable()->constrained('albums')->onDelete('set null');
            $table->foreignId('music_genre_id')->nullable()->constrained('genres')->onDelete('set null');
            $table->foreignId('music_language_id')->nullable()->constrained('languages')->onDelete('set null');
            $table->string('music_year', 4)->nullable();
            $table->text('music_description')->nullable();
            $table->string('music_file_path')->nullable();
            $table->string('music_image_path')->nullable();
            $table->enum('music_is_new', ['yes', 'no'])->default('no');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};