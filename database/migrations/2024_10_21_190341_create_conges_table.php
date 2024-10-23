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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->string('numEmp');
            $table->string('numSup');
            $table->string('Annee');
            $table->string('Mois');
            $table->date('FaiLe');
            $table->integer('NbrJours');
            $table->integer('CumulAnnuel')->default(0);
            $table->integer('Solde')->default(30);
            $table->date('DateDebut');
            $table->date('DateFin');
            $table->string('Motif');
            $table->string('NomOrganisation');
            $table->string('Validation');
            $table->string('Description');

            // ------------------ Foreig key ------------------
            $table->foreign('numEmp')->references('numEmp')->on('Employes')->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
