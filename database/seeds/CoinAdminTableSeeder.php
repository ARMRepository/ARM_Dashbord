<?php

use Illuminate\Database\Seeder;

class CoinAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coinadmins')->truncate();
        DB::table('coinadmins')->insert([
            'name' => 'Coin Admin',
            'email' => 'admin@demo.com',
            'password' => bcrypt('123456'),
        ],[
            'name' => 'Coin Admin',
            'email' => 'admin@coinadmin.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
