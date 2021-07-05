<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_id')->constrained('entreprises')->onDelete('cascade');
            $table->foreignId('board_of_director_id')->constrained('board_of_directors')->onDelete('cascade');
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
        Schema::dropIfExists('sas');
    }
}
