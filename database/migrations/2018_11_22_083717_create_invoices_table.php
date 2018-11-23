<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateinvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('invoices_id');
			$table->string('invoices_startmonth');
			$table->string('invoices_endmonth');
			$table->string('invoices_wordtrack');
			$table->string('invoices_startnumber');
			$table->string('invoices_endnumber');
			$table->string('invoices_currentnumber');
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
        Schema::dropIfExists('invoices');
    }
}
