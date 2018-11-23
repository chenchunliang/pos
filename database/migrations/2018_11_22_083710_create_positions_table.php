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
            $table->increments('positions_id');
			$table->integer('positions_x');
			$table->integer('positions_y');
			
			$table->unsignedInteger('items_id');
			$table->unsignedInteger('catalogs_id');
			
			$table->foreign('items_id')->references('items_id')->on('items');
			$table->foreign('catalogs_id')->references('catalogs_id')->on('catalogs');
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
