<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('music', function (Blueprint $table) {
            $table->string('music_youtube_id')->nullable()->after('music_file_path');
        });
    }

    public function down(): void
    {
        Schema::table('music', function (Blueprint $table) {
            $table->dropColumn('music_youtube_id');
        });
    }
};