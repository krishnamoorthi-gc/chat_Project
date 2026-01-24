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
        Schema::table('leads', function (Blueprint $table) {
            if (!Schema::hasColumn('leads', 'name')) {
                $table->string('name')->nullable();
            }
            if (!Schema::hasColumn('leads', 'email')) {
                $table->string('email')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
             if (Schema::hasColumn('leads', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('leads', 'email')) {
                $table->dropColumn('email');
            }
        });
    }
};
