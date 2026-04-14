<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metadata_metadata', function (Blueprint $table) {
            $table->foreignId('parent_id')->constrained('metadata', 'id')->cascadeOnDelete();
            $table->foreignId('child_id')->constrained('metadata', 'id')->cascadeOnDelete();
            $table->primary(['parent_id', 'child_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metadata_metadata');
    }
};
