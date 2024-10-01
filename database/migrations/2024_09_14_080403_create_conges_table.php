<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('conges', function (Blueprint $table) {
            $table->string('numConge')->primary();
            $table->string('numEmp');
            $table->integer('nbrjr');
            $table->date('dateDemande');
            $table->string('motif');

            // ------------------ Foreig key ------------------
            $table->foreign('numEmp')->references('numEmp')->on('Employes')->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
