<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalPersonConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_person_connections', function (Blueprint $table) {
            $table->id();
            $table->string('letterOfResponsableEntreprise');
            $table->string('originalOfQuota');
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
        Schema::dropIfExists('legal_person_connections');
    }
}
