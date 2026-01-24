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
        Schema::create('knowledge_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chatbot_id')->constrained()->onDelete('cascade');
            $table->string('type'); // file, text, url
            $table->string('title');
            $table->longText('content')->nullable(); // for raw text inputs
            $table->string('file_path')->nullable(); // for uploaded files
            $table->string('status')->default('pending'); // pending, processing, processed, failed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge_sources');
    }
};
