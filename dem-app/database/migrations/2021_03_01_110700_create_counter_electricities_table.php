<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounterElectricitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counter_electricities', function (Blueprint $table) {
            $table->id();
            $table->string('oldAddress');
            $table->string('oldPolice');
            $table->string('haveCompteBanque');
            $table->string('banqueName');
            $table->string('banqueCompteNumber');
            $table->string('invoice');
            $table->string('brighFirePlaceNumber');
            $table->string('fridgeNumber');
            $table->string('tvNumber');
            $table->string('freezerNumber');
            $table->string('waterHeaterNumber');
            $table->string('fanNumber');
            $table->string('airConditionerNumber');
            $table->string('ironNumber');
            $table->string('washingMachineNumber');
            $table->string('compteNumber');
            $table->string('moterAndVariousNumber');
            $table->string('computerNumber');
            $table->string('costomerSignature');
            $table->foreignId('move_id')->constrained('moves')->onDelete('cascade');
            $table->foreignId('type_local_id')->constrained('type_locals')->onDelete('cascade');
            $table->foreignId('type_conter_id')->constrained('type_conters')->onDelete('cascade');
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
        Schema::dropIfExists('counter_electricities');
    }
}
