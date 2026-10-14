<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('review_user_id')->constrained('users')->onDelete('cascade');
            $table->enum('review_media_type', ['music', 'video']);
            $table->unsignedBigInteger('review_media_id');
            $table->unsignedTinyInteger('review_rating');
            $table->text('review_text');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};