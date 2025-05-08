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
        Schema::create('dog_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('breed');
            $table->string('age')->nullable();
            $table->string('size');
            $table->string('traits')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dog_profiles');
    }
};
