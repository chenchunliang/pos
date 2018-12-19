<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //		
		$user = new User;
		
		$user->user_account = "admin";
		$user->user_name ="管理員";
		$user->user_password =md5("admin");
		$user->user_email ="admin@agric.tw";
        $user->save();
    }
}
