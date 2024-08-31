<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('phone_number')->nullable();
            $table->string('post_code');
            $table->string('street');
            $table->string('building_number');
            $table->string('secondary_address')->nullable();
            $table->string('neighborhood');
            $table->string('city');
            $table->string('state');
            $table->timestamp('birth_date');
            $table->string('health_insurance')->nullable();
            $table->string('biological_sex');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
