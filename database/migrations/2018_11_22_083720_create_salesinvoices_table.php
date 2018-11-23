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
            $table->increments('id');
			$table->string('salesinvoice_invoicenumber');
			$table->date('salesinvoice_date');
			$table->time('salesinvoice_time');
			$table->integer('salesinvoice_identifier');
			$table->integer('salesinvoice_randomnumber');
			$table->text('salesinvoice_productarray');
			$table->integer('salesinvoice_tnsalesamount');
			$table->integer('salesinvoice_txsalesamount');
			$table->integer('salesinvoice_taxamount');
			$table->integer('salesinvoice_totalamount');
			$table->integer('salesinvoice_printstate');
			$table->integer('salesinvoice_invalidstate');
			$table->integer('salesinvoice_C0401state');
			$table->integer('salesinvoice_C0501state');
			$table->string('salesinvoice_remark');
			
			$table->unsignedInteger('customer_id');
			$table->foreign('customer_id')->references('id')->on('customers');
			
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
        Schema::dropIfExists('salesinvoices');
    }
}
