<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shops')->insert([
            [
                'owner_id' => 1,
                'name' => 'ここに店名が入ります',
                'information' => 'ここにお店の情報が入ります',
                'filename' => 'sample1.jpg',
                'is_selling' => true,
                'created_at' => '2021\01\01 11:11:11'
            ],
            [
                'owner_id' => 2,
                'name' => 'ここに店名が入ります',
                'infomation' => 'ここにお店の情報が入ります',
                'filename' => 'sample2.jpg',
                'is_selling' => true,
                'created_at' => '2021\01\01 11:11:11'
            ],
        ]);
    }
}
