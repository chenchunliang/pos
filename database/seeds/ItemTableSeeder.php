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
		
		$item->item_name ="米";
		$item->item_specification ="1.5KG";
		$item->item_barcode =rand(10000000,99999999);
		$item->item_unit="包";
		$item->item_taxtype ="1";
		$item->item_image=base64_encode(str_random(20));

        $item->save();
    }
}
