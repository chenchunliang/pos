<?php

use Illuminate\Database\Seeder;
use App\Position;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
		$position = new Position;
		
		$position->position_x =rand(0,10);
		$position->position_y =rand(0,10);
		$position->item_id =1;
		$position->catalog_id =1;
		
        $position->save();

    }
}
