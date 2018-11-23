<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatepositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('position_x');
			$table->integer('position_y');
			
			$table->unsignedInteger('item_id');
			$table->unsignedInteger('catalog_id');
			
			$table->foreign('item_id')->references('id')->on('items');
			$table->foreign('catalog_id')->references('id')->on('catalogs');
            $table->timestamps();
			$table->softDeletes();
			
        });
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
