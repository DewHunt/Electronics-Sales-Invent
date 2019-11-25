<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('cover_image');
            $table->text('image');
            $table->tinyInteger('status');
            $table->text('parent');
            $table->string('show_in_home_page');
            $table->text('meta_title');
            $table->text('meta_keyword');
            $table->text('meta_description');
            $table->integer('order_by');
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
        Schema::dropIfExists('tbl_categories');
    }
}
