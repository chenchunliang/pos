<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvalidinvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invalidinvoices', function (Blueprint $table) {
            $table->increments('invalidinvoices_id');
			$table->date('invalidinvoices_invaliddate');
			$table->time('invalidinvoices_invalidtime');
			$table->string('invalidinvoices_invalidreason');
			
			$table->unsignedInteger('salesinvoices_id');
			$table->foreign('salesinvoices_id')->references('salesinvoices_id')->on('salesinvoices');
			
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
        Schema::dropIfExists('invalidinvoices');
    }
}
