<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('genererqrs', function (Blueprint $table) {
            $table->id();
            $table->string('numEmp');
            $table->string('imageqr');

            // ---------------- Foreigne key ----------------
            $table->foreign('numEmp')->references('numEmp')->on('Employes')->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('genererqrs');
    }
};
