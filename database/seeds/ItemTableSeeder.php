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
		$item->item_barcode ="4713319870054";
		$item->item_unitprice1=250;
		$item->item_unitprice2=185;
		$item->item_unitprice3=205;
		$item->item_unitprice4=250;
		$item->item_unitprice5=250;
		$item->item_unit="包";
		$item->item_taxtype ="1";
		$item->item_image="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADUAAAA3CAIAAAAjTJUsAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGGSURBVGhD7ZjbkcMgDEVTFwVRD9XQjItxBEggHnlgDbaT0fnY8RISnbloY3kf+71RPxnqJ0P9ZKifDPWTcdjPW+M2vO7x9jHCenz9a773e1GSwap7O1AZLn7gSH6szubMMMZL/N4mWGtecL6hKElgEpuzeeFdNwo44pdl4HRjLMa54keLkbhahTkZ4ayfg1rD1uJ+tAHzZX033YIH8mt6C9fu5MdqZIVfyg9fAfo3rPdrQJ9c97r8rkD9ZKifDPWToX4y1E/Gn/nhHT9d0qMRzCfsrl/NLz1r5wPyG0jQbJO2sCkmkSaXhfMLm+LYmNUXzH64ObPYL4Ij4PAM0Zq1ANDkuNgvZYglql8KwS88RQ2wfqkfZGEMhFMViZbswJv8Glb6hbP1WLxtxur5I2xhG4iwY6Ff/OguHOxEVpX8YCl3K6yw5Rkm/z7Qj9KJgVrnuXLll7aF6E71K5fhp4cMS9kXIqf6hWDS/zroaGEFKw+/ewpr/U5H/WSonwz1k6F+Mu7tt+9PVkWdgFbJhCMAAAAASUVORK5CYII=";//商品樣圖

        $item->save();
    }
}
