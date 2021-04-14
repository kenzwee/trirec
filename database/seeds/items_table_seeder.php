<?php

use Illuminate\Database\Seeder;

class items_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            [
                'user_id'     => '1',
                'goods'        =>'パスポート',
                'importance'  =>'1',
            ],
            [
                'user_id'     => '1',
                'goods'        =>'査証',
                'importance'  =>'1',
            ],
            [
                'user_id'     => '1',
                'goods'        =>'航空券',
                'importance'  =>'1',
            ],
            [
                'user_id'     => '1',
                'goods'        =>'現金',
                'importance'  =>'1',
            ],
            [
                'user_id'     => '1',
                'goods'        =>'海外旅行保険 保険証',
                'importance'  =>'1',
            ],
            [
                'user_id'     => '1',
                'goods'        =>'クレジットカード',
                'importance'  =>'1',
            ],
        ]);
    }
}