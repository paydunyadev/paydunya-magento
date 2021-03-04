<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherConnectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_connections', function (Blueprint $table) {
            $table->id();
            $table->string('annualComsuption');
            $table->string('debitDaily');
            $table->string('debitSchedule');
            $table->foreignId('water_sdes')->nullable()->constrained('water_sdes')->onDelete('cascade');
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
        Schema::dropIfExists('other_connections');
    }
}
