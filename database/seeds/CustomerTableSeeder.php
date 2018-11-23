<?php

use Illuminate\Database\Seeder;
use App\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$customer = new Customer;
		
		$customer->customer_name ="零售";
		$customer->customer_identifier ="";
		$customer->customer_remark ="零售客戶共用";
		
        $customer->save();
    }
}
