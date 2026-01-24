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
        Schema::create('leads', function (Blueprint $াবাহ) {
            $াবাহ->id();
            $াবাহ->foreignId('chatbot_id')->constrained()->onDelete('cascade');
            $াবাহ->string('ip_address')->nullable();
            $াবাহ->string('city')->nullable();
            $াবাহ->string('region')->nullable();
            $াবাহ->string('country')->nullable();
            $াবাহ->integer('visit_count')->default(1);
            $াবাহ->timestamp('last_visit_at')->nullable();
            $াবাহ->text('user_agent')->nullable();
            $াবাহ->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
