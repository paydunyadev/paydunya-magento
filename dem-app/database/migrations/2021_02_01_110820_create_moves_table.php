<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moves', function (Blueprint $table) {
            $table->id();
            $table->string('ownerFirstName');
            $table->string('ownerLastName');
            $table->string('representatativeLastName');
            $table->string('representatativeFirstName');
            $table->date('dateBirthDay');
            $table->string('placeOfBirthDay');
            $table->string('nationality');
            $table->string('installationAddress');
            $table->string('billingAddress');
            $table->string('homeTel');
            $table->string('port');
            $table->string('profession');
            $table->string('email');
            $table->string('employerName');
            $table->string('professionalAddress');
            $table->string('oficeTel');
            $table->string('tel');
            $table->string('photoIdentityPiece');
            $table->string('numberIdentityPiece');
            $table->string('neighbourName');
            $table->string('neighbourTakenNumber');
            $table->foreignId('identity_piece_id')->constrained('identity_pieces')->onDelete('cascade');
            $table->foreignId('type_inscription_id')->constrained('type_inscriptions')->onDelete('cascade');
            $table->foreignId('caracteristique_technique_id')->constrained('caracteristique_techniques')->onDelete('cascade');
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
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
        Schema::dropIfExists('moves');
    }
}
