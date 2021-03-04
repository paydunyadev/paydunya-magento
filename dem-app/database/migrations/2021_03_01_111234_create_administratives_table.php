<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administratives', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('recipient');
            $table->string('libelleDistrick');
            $table->string('numberDistrick');
            $table->string('codePostal');
            $table->string('contry');
            $table->string('address');
            $table->string('tel');
            $table->string('email');
            $table->string('placeExpedition');
            $table->string('numberOfCopie');
            $table->string('reason');
            $table->string('reference');
            $table->string('copieOfFolder');
            $table->string('haveAlreadyGetThisDocPre');
            $table->string('haveKeepFolder');
            $table->string('region');
            $table->string('commune');
            $table->string('department');
            $table->foreignId('marital_statuse_id')->constrained('marital_statuses')->onDelete('cascade');
            $table->foreignId('type_administratives')->constrained('type_administratives')->onDelete('cascade');
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
        Schema::dropIfExists('administratives');
    }
}
