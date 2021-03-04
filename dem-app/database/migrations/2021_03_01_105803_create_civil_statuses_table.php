<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCivilStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civil_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('passportNumber');
            $table->date('dateOfBirth');
            $table->date('dateOfDeleverancePassport');
            $table->string('placeOfBirth');
            $table->string('numberCni');
            $table->string('profession');
            $table->string('nationality');
            $table->string('physicalAddress');
            $table->string('tel');
            $table->string('email');
            $table->foreignId('marital_regime_id')->constrained('marital_regimes')->onDelete('cascade');
            $table->foreignId('marital_statuse_id')->constrained('marital_statuses')->onDelete('cascade');
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
        Schema::dropIfExists('civil_statuses');
    }
}
