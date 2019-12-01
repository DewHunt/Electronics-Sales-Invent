<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblLiftingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_lifting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_no');
            $table->string('vaouchar_no');
            $table->integer('vendor_id');
            $table->string('purchase_by')->nullable();
            $table->date('submission_date')->nullable();
            $table->date('vouchar_date')->nullable();
            $table->string('total_qty')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('discount')->nullable();
            $table->string('vat')->nullable();
            $table->string('net_amount')->nullable();
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
        Schema::dropIfExists('tbl_lifting');
    }
}
