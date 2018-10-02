<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();
        DB::table('settings')->insert([
            [
                'key' => 'site_title',
                'value' => 'Coin Base'
            ],
            [
                'key' => 'site_logo',
                'value' => '',
            ],
            [
                'key' => 'site_icon',
                'value' => '',
            ],
            [
                'key' => 'site_copyright',
                'value' => '&copy; '.date('Y').' Coin Base'
            ],
            [
                'key' => 'coin_name',
                'value' => 'Crypto Trust Coin'
            ],
            [
                'key' => 'coin_symbol',
                'value' => 'CTC'
            ],
            [
                'key' => 'coin_price',
                'value' => 0.5
            ],
            [
                'key' => 'coin_address',
                'value' => '0xCBA8a38E369f34aC8D7fe4a8B95C37d2D7c39aC3'
            ],
            [
                'key' => 'referral_bonus',
                'value' => 10
            ],
            [
                'key' => 'currency',
                'value' => "$"
            ]
       
        ]);
    }
}
