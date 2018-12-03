<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateitemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
			$table->string('item_name');
			$table->string('item_specification');
			$table->string('item_barcode');
			$table->integer('item_unitprice1');
			$table->integer('item_unitprice2');
			$table->integer('item_unitprice3');
			$table->integer('item_unitprice4');
			$table->integer('item_unitprice5');
			$table->string('item_unit');
			$table->integer('item_taxtype');
			$table->longText('item_image')->nullable($value = true);
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
        Schema::dropIfExists('items');
    }
}
