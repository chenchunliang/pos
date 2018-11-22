<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position', function (Blueprint $table) {
            $table->increments('position_id');
			$table->integer('position_x');
			$table->integer('position_y');
			
			$table->unsignedInteger('item_id');
			$table->unsignedInteger('catalog_id');
			
			$table->foreign('item_id')->references('item_id')->on('item');
			$table->foreign('catalog_id')->references('catalog_id')->on('catalog');
            $table->timestamps();
			
        });
		
		Schema::disableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position');
    }
}
