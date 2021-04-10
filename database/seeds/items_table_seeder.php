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
                'body'        =>'パスポート',
                'importance'  =>'1',
            ],
            [
                'body'        =>'査証',
                'importance'  =>'1',
            ],
            [
                'body'        =>'航空券',
                'importance'  =>'1',
            ],
            [
                'body'        =>'現金',
                'importance'  =>'1',
            ],
            [
                'body'        =>'海外旅行保険 保険証',
                'importance'  =>'1',
            ],
            [
                'body'        =>'クレジットカード',
                'importance'  =>'1',
            ],
        ]);
    }
}
