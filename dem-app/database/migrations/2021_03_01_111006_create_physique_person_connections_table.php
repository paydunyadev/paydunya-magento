<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhysiquePersonConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physique_person_connections', function (Blueprint $table) {
            $table->id();
            $table->string('ownerAttestation');
            $table->string('authorisation');
            $table->foreignId('water_sdes')->nullable()->constrained('water_sdes')->onDelete('cascade');
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
        Schema::dropIfExists('physique_person_connections');
    }
}
