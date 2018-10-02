<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class CoinTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coin_types')->truncate();
        DB::table('coin_types')->insert([
            [
                'name' => 'Bitcoin',
                'symbol' => 'BTC',
                'address' => '3A2jLMLNUgeYcDMozhrRRekRTQ5uNXS3zD',
                'qr_code' => asset('img/BTC.png'),
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'name' => 'Ethereum',
                'symbol' => 'ETH',
                'address' => '0x8f233261993fddf98dd913546f3f45380d168a2a',
                'qr_code' => asset('img/ETH.png'),
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'name' => 'Ripple',
                'symbol' => 'XRP',
                'address' => 'rEsaDShsYPmMZopoG3nNjutWJCk1Zn9cbX',
                'qr_code' => asset('img/XRP.png'),
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
