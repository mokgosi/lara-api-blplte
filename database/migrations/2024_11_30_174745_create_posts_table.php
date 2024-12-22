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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', length: 512);
            $table->string('slug', length: 512)->unique();
            $table->string('thumbnail_url', 512)->nullable();
            $table->string('meta_title', length: 255)->nullable();
            $table->string('meta_description', length: 255)->nullable();
            $table->text('body');
            $table->boolean('is_published')->default(false);
            $table->datetime('published_at')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
