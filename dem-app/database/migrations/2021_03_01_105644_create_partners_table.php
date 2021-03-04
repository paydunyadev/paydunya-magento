<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('profession');
            $table->string('tel');
            $table->string('email');
            $table->foreignId('sas_or_sasu_id')->nullable()->constrained('sas_or_sasus')->onDelete('cascade');
            $table->foreignId('marital_regime_id')->nullable()->constrained('marital_regimes')->onDelete('cascade');
            $table->foreignId('sa_id')->nullable()->constrained('sas')->onDelete('cascade');
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
        Schema::dropIfExists('partners');
    }
}
