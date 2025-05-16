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
        Schema::table('dog_profiles', function (Blueprint $table) {
            $table->date('birthdate')->nullable()->after('traits');
            $table->float('weight')->nullable()->after('birthdate'); // weight in kg or lbs
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dog_profiles', function (Blueprint $table) {
            $table->dropColumn(['birthdate', 'weight']);
        });
    }
};
