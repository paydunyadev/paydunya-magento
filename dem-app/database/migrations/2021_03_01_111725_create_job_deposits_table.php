<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('duration')->nullable();
            $table->string('numberpath')->nullable();
            $table->boolean('isRecepted')->nullable();
            $table->boolean('isValideFolder')->nullable();
            $table->integer('nesDuration')->nullable();
            $table->dateTime('dateDeposit')->nullable();
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
        Schema::dropIfExists('job_deposits');
    }
}
