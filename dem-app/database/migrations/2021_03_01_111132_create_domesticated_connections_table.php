<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDomesticatedConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domesticated_connections', function (Blueprint $table) {
            $table->id();
            $table->integer('numberWaterPoint');
            $table->integer('numberBathroomSink');
            $table->integer('numberFaucet');
            $table->integer('numberSink');
            $table->integer('numberBathTub');
            $table->integer('numberUrinal');
            $table->integer('numberBidet');
            $table->integer('numberWc');
            $table->integer('numberLavoir');
            $table->string('gardenSurface');
            $table->string('poolCapacity');
            $table->foreignId('water_sde_id')->nullable()->constrained('water_sdes')->onDelete('cascade');
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
        Schema::dropIfExists('domesticated_connections');
    }
}
