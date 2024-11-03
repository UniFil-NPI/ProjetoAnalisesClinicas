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
        Schema::create('patient_exam_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained();
            $table->foreignId('requisition_id')->constrained(
                table: 'exams', indexName: 'id'
            );
            $table->string('exam_type_name');
            $table->double('exam_value');
            $table->timestamp('start_date');
            $table->string('patient_name');
            $table->string('patient_gender');
            $table->string('operator_name');
            $table->timestamp('end_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_exam_results');
    }
};
