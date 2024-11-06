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
        Schema::create('paternity_tests', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('paternity');
            $table->foreignId('patient_id')->constrained();
            $table->json('participants');
            $table->string('lab');
            $table->string('health_insurance');
            $table->timestamp('exam_date');
            $table->longText('description');
            $table->string('pdf')->nullable();
            $table->string('state')->default('analisando');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paternity_tests');
    }
};
