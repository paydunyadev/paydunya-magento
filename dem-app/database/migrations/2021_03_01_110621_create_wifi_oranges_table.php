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
            $table->boolean('accepteToReceiveInfoSonatel');
            $table->boolean('accepteToReceiveInfoPartnerSonatel');
            $table->string('email');
            $table->string('tel');
            $table->string('faxNumber');
            $table->boolean('receiveInvoiceInFormatElectronic');
            $table->string('signature');
            $table->string('dateSignature');
            $table->string('palaceSignature');
            $table->foreignId('move_id')->constrained('moves')->onDelete('cascade');
            $table->foreignId('offer_type_id')->constrained('offer_types')->onDelete('cascade');
            $table->foreignId('costomer_entreprise_id')->constrained('costomer_entreprises')->onDelete('cascade');
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
