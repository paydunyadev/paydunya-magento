<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostomerEntreprisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costomer_entreprises', function (Blueprint $table) {
            $table->id();
            $table->string('denominationSocial');
            $table->string('socialSiege');
            $table->string('invoiceAddress');
            $table->string('nameAndQaulityRepresentative');
            $table->string('activityDomaine');
            $table->string('email');
            $table->string('tel');
            $table->string('fixePhone');
            $table->string('numberOfPieceIdentity');
            $table->string('dateDeleveranceIdentityPiece');
            $table->string('ninea');
            $table->string('numberInscriptionRccm');
            $table->foreignId('identity_piece_id')->constrained('identity_pieces')->onDelete('cascade');
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
        Schema::dropIfExists('costomer_entreprises');
    }
}
