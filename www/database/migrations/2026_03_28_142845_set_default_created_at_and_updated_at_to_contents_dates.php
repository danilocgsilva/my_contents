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
        Schema::table('contents', function (Blueprint $table) {
            $table->timestamp('created_at')->nullable()->useCurrent()->change();
            $table->timestamp('updated_at')->nullable()->useCurrent()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->timestamp('created_at')->default(null);
            $table->timestamp('updated_at')->default(null);
        });
    }
};
