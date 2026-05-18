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
        Schema::create('tracks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('description');
            $table->unsignedInteger('duration')->comment('Duration in seconds');
            $table->unsignedBigInteger('size')->comment('File size in bytes');
            $table->enum('status', [
                'pending',
                'processing',
                'done',
                'failed',
            ])->default('pending');
            $table->foreignUuid('creator_id')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
