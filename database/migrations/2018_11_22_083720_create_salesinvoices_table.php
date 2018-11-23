<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatesalesinvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesinvoices', function (Blueprint $table) {
            $table->increments('salesinvoices_id');
			$table->string('salesinvoices_invoicenumber');
			$table->date('salesinvoices_date');
			$table->time('salesinvoices_time');
			$table->integer('salesinvoices_identifier');
			$table->integer('salesinvoices_randomnumber');
			$table->text('salesinvoices_productarray');
			$table->integer('salesinvoices_tnsalesamount');
			$table->integer('salesinvoices_txsalesamount');
			$table->integer('salesinvoices_taxamount');
			$table->integer('salesinvoices_totalamount');
			$table->integer('salesinvoices_printstate');
			$table->integer('salesinvoices_invalidstate');
			$table->integer('salesinvoices_C0401state');
			$table->integer('salesinvoices_C0501state');
			$table->string('salesinvoices_remark');
			
			$table->unsignedInteger('customers_id');
			$table->foreign('customers_id')->references('customers_id')->on('customers');
			
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
        Schema::dropIfExists('salesinvoices');
    }
}
