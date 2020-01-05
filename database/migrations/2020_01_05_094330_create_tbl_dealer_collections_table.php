<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblDealerCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dealer_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dealer_id');
            $table->string('payment_no',255);
            $table->datetime('payment_date');
            $table->string('money_receipt_no',255);
            $table->string('money_receipt_type',255);
            $table->integer('payment_amount');
            $table->text('remarks');
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
        Schema::dropIfExists('tbl_dealer_collections');
    }
}
