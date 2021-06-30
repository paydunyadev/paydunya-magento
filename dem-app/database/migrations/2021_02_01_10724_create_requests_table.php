<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->boolean('isDisponible')->default(false);
            $table->boolean('isReceptedByCollectAgent')->default(false);
            $table->boolean('isCorrect')->default(true);
            $table->boolean('isValidByDepositAgent')->default(false);
            $table->boolean('isDone')->default(false);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('canal_communication_id')->nullable()->constrained('canal_communications')->onDelete('cascade');
            $table->foreignId('deposit_file_id')->nullable()->constrained('deposit_files')->onDelete('cascade');
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
        Schema::dropIfExists('requests');
    }
}
