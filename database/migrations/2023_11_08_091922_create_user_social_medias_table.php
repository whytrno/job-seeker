<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_social_medias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('facebook_username')->nullable();
            $table->string('instagram_username')->nullable();
            $table->string('twitter_username')->nullable();
            $table->string('linkedin_username')->nullable();
            $table->string('tiktok_username')->nullable();
            $table->string('spoken_language_ids')->nullable();
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_social_medias');
    }
};
