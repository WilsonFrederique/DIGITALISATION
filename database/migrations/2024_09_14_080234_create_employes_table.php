<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->string('numEmp')->primary();
            $table->string('Nom');
            $table->string('Prenom');
            $table->date('Naissance');
            $table->string('LieuDeNaissance');
            $table->string('Sexe');
            $table->string('Grade');
            $table->string('Fonctions');
            $table->string('Personnel');
            $table->string('Service');
            $table->string('Direction');
            $table->date('DateDeDelivrance');
            $table->string('LieuDeDelivrance');
            $table->string('Commune');
            $table->string('Quartier');
            $table->string('Secteur');
            $table->string('Lot');
            $table->string('Email');
            $table->string('Telephone');
            $table->timestamps();
            $table->string('Situation');

            // Définir le moteur de stockage
            $table->engine = 'InnoDB';
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
