<?php

use Illuminate\Database\Seeder;
use App\Item;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$item = new Item;
		
		$item->item_name =str_random(10);
		$item->item_specification =str_random(10);
		$item->item_barcode =rand(10000000,99999999);
		$item->item_unit="個";
		$item->item_taxtype =rand(1,2);
		$item->item_image=base64_encode(str_random(20));

        $item->save();
    }
}
