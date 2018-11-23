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
            $table->increments('id');
			$table->date('invalidinvoice_invaliddate');
			$table->time('invalidinvoice_invalidtime');
			$table->string('invalidinvoice_invalidreason');
			
			$table->unsignedInteger('salesinvoice_id');
			$table->foreign('salesinvoice_id')->references('id')->on('salesinvoices');
			
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
        Schema::dropIfExists('invalidinvoices');
    }
}
