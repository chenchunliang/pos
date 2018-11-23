<?php

use Illuminate\Database\Seeder;
use App\Catalog;

class CatalogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$catalog = new Catalog;
		
		$catalog->catalog_name ="米";
		$catalog->catalog_orders =1;
		$catalog->catalog_display =1;

        $catalog->save();
		
    }
}
