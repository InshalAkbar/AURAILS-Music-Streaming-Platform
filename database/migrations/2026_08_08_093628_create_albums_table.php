<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('album_name');
            $table->foreignId('album_artist_id')->constrained('artists')->onDelete('cascade');
            $table->string('album_release_year', 4);
            $table->string('album_cover_image')->nullable();
            $table->text('album_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('albums');
    }
};