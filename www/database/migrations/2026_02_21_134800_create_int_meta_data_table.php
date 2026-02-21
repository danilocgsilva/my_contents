<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('int_metadata', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('int_metadata');
    }
};
