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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->foreignId('author_id');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('article_group_id');
            $table->foreign('article_group_id')->references('id')->on('article_groups')->onDelete('cascade');
            $table->boolean('status')->default(false);
            $table->string('picture')->nullable();
            $table->text('content');
            $table->bigInteger('view')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
