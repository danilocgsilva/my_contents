<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private CONST TABLE_NAME = 'metadata';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->foreignId('content_id')
                ->constrained('contents', 'id');
            $table->index(['content_id', 'key']);
            $table->index(['valueable_id', 'valueable_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('metadata', function (Blueprint $table) {
            $table->dropForeign(['content_id']);
            $table->dropIndex(['content_id', 'key']);
            $table->dropIndex(['valueable_id', 'valueable_type']);
        });
    }
};
