<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWifiOrangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wifi_oranges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('move_id')->constrained('moves')->onDelete('cascade');
            $table->foreignId('offer_type_id')->constrained('offer_types')->onDelete('cascade');
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
        Schema::dropIfExists('wifi_oranges');
    }
}
