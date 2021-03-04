<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->id();
            $table->string('accronym');
            $table->string('addressEstablishment');
            $table->boolean('ifHaveRegisterTrade');
            $table->string('firstNameRepresentativeLegal');
            $table->string('lastNameRepresentativeLegal');
            $table->string('nationalityRepresentativeLegal');
            $table->string('phoneRepresentativeLegal');
            $table->string('domicilAddressRepresentativeLegal');
            $table->string('emailRepresentativeLegal');
            $table->string('spouseFirstName');
            $table->string('spouseLastName');
            $table->date('weddingDate');
            $table->date('depositDate');
            $table->boolean('isSgn');
            $table->foreignId('entreprise_id')->constrained('entreprises')->onDelete('cascade');
            $table->foreignId('marital_option_id')->constrained('marital_options')->onDelete('cascade');
            $table->foreignId('marital_statuse_id')->constrained('marital_statuses')->onDelete('cascade');
            $table->foreignId('marital_regime_id')->constrained('marital_regimes')->onDelete('cascade');
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
        Schema::dropIfExists('individuals');
    }
}
