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
			$table->string('salesinvoice_identifier')->nullable($value = true);
			$table->integer('salesinvoice_randomnumber');
			$table->text('salesinvoice_productarray');
			$table->integer('salesinvoice_tnsalesamount');
			$table->integer('salesinvoice_txsalesamount');
			$table->integer('salesinvoice_taxamount');
			$table->integer('salesinvoice_totalamount');
			$table->integer('salesinvoice_printstate')->nullable($value = true)->default(0);
			$table->integer('salesinvoice_invalidstate')->nullable($value = true)->default(0);
			$table->integer('salesinvoice_C0401state')->nullable($value = true)->default(0);
			$table->integer('salesinvoice_C0501state')->nullable($value = true)->default(0);
			$table->string('salesinvoice_remark')->nullable($value = true);
			
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
