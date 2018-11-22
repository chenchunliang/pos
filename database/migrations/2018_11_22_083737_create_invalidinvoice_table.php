<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvalidinvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invalidinvoice', function (Blueprint $table) {
            $table->increments('invalidinvoice_id');
			$table->date('invalidinvoice_invaliddate');
			$table->time('invalidinvoice_invalidtime');
			$table->string('invalidinvoice_invalidreason');
			
			$table->unsignedInteger('salesinvoice_id');
			$table->foreign('salesinvoice_id')->references('salesinvoice_id')->on('salesinvoice');
			
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
        Schema::dropIfExists('invalidinvoice');
    }
}
