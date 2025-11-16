<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dog_profiles', function (Blueprint $table) {
            $table->boolean('is_marketplace_visible')->default(false);
            $table->decimal('marketplace_price', 10, 2)->nullable();
            $table->enum('marketplace_category', ['puppies', 'adult_dogs', 'breeding', 'adoption'])->nullable();
            $table->text('marketplace_description')->nullable();
            $table->string('contact_number')->nullable();
        });
    }

    public function down()
    {
        Schema::table('dog_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'is_marketplace_visible',
                'marketplace_price',
                'marketplace_category',
                'marketplace_description',
                'contact_number'
            ]);
        });
    }
};
