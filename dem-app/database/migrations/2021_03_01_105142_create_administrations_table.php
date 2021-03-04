<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrations', function (Blueprint $table) {
            $table->id();
            $table->string('generalAdministrator');
            $table->string('deputyGeneralAdminitrator');
            $table->string('tel');
            $table->foreignId('sas_or_sasu_id')->nullable()->constrained('sas_or_sasus')->onDelete('cascade');
            $table->foreignId('sarl_suarl_id')->nullable()->constrained('sarl_suarls')->onDelete('cascade');
            $table->foreignId('sa_id')->nullable()->constrained('sas')->onDelete('cascade');            $table->timestamps();
            $table->foreignId('sci_id')->nullable()->constrained('scis')->onDelete('cascade');            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('administrations');
    }
}
