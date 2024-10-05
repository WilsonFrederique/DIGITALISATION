<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendriersTable extends Migration
{
    public function up()
    {
        Schema::create('calendriers', function (Blueprint $table) {
            $table->id();
            $table->string('Titre');
            $table->string('Description');
            $table->date('DateDebu');
            $table->date('DateFin');
            $table->time('TimeDebu');
            $table->time('TimeFin');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('calendriers');
    }
}
