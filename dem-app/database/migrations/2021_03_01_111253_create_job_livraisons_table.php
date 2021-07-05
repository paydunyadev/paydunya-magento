<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_livraisons', function (Blueprint $table) {
            $table->id();
            $table->string('path');
            $table->boolean('valideAttribution');
            $table->dateTime('dateLivraison');
            $table->boolean('isDone');
            $table->foreignId('request_id')->constrained('requests')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('job_livraisons');
    }
}
