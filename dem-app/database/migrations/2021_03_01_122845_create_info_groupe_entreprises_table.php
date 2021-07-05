<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoGroupeEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_groupe_entreprises', function (Blueprint $table) {
            $table->id();
            $table->integer('duration');
            $table->string('capitalSocial');
            $table->string('apport');
            $table->string('numerical');
            $table->string('nature');
            $table->string('part');
            $table->string('action');
            $table->string('capitalAllocation');
            $table->foreignId('entreprise_id')->constrained('entreprises')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('info_groupe_entreprises');
    }
}
