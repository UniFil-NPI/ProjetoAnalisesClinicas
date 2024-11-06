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
        Schema::create('allele_freqs', function (Blueprint $table) {
            $table->id();
            $table->string('Alelo');
            $table->double('D3S1358');
            $table->double('VWA');
            $table->double('FGA');
            $table->double('D8S1179');
            $table->double('D21S11');
            $table->double('D18S51');
            $table->double('D5S818');
            $table->double('D13S317');
            $table->double('D7S820');
            $table->double('D16S539');
            $table->double('THO1');
            $table->double('TPOX');
            $table->double('CSF1PO');
            $table->double('D2S1338');
            $table->double('D19S433');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allele_freqs');
    }
};
