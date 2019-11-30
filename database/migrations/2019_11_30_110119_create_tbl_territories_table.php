<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblTerritoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_territories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_id');
            $table->string('code');
            $table->string('name');
            $table->string('incharge_name')->nullable();
            $table->text('address')->nullable();
            $table->string('contact')->nullable();
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('tbl_territories');
    }
}
