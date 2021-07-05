<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticularCostomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('particular_costomers', function (Blueprint $table) {
            $table->id();
            $table->boolean('accepteToReceiveInfoSonatel');
            $table->boolean('accepteToReceiveInfoPartnerSonatel');
            $table->string('email_costomer');
            $table->string('tel_costomer');
            $table->string('faxNumber');
            $table->boolean('receiveInvoiceInFormatElectronic');
            $table->string('signature');
            $table->string('dateSignature');
            $table->string('palaceSignature');
            $table->foreignId('wifi_orange_id')->constrained('wifi_oranges')->onDelete('cascade');
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
        Schema::dropIfExists('particular_costomers');
    }
}
